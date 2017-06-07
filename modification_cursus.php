
<!DOCTYPE html>
<html>
<head>
  <title>Cursus utt</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="css/bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" language="Javascript">


    function validForm(){
      var valide = true;
      var semValue = document.FormIdent.sem_label.value;
      var uvValue = document.FormIdent.nom_uv.value;
      $("#alertSem").hide();
      $("#alertUv").hide();
      //mise en majuscule
      var semUpper = semValue.toUpperCase();
      if(semUpper != semValue){
        $("#alertSem").show();
        valide = false;
      }
      var uvUpper = uvValue.toUpperCase();
      if(uvUpper != uvValue){
        $("#alertUv").show();
        valide = false;
      }

      return valide;
    }
  </script>
  

</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">DANK-GREEN-ONIONS</a>
    </div>
    
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="etudiants.php">Etudiants</a></li>
        <li class="active"><a href="cursus.php">Cursus</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  
  </div>
</div>

<div class="container">
  
  <div class="text-center">
    <h1>Dank website</h1>
    <h2>Modification du cursus</h2>
    <p class="lead">



      
<!-- DEBUT DU FORMULAIRE -->

<form action="modification_cursus.php" method="POST" id="FormIdent" name="FormIdent" onsubmit="return validForm();">

<?php

echo "<h3>Modification du cursus : ".$_POST['label']."</h3></br>" ;

//function pour faire un form avec du texte
function formtext($label,$name,$value){
  echo " <label>".$label."</label> <input type=text name='".$name."' value='".$value."'>";
}
//function pour faire la liste déroulante
function formselect($liste,$nomselect,$label){
  echo " <label>".$label."</label> ";
  echo "<SELECT name='".$nomselect."'>";
foreach ($liste as $key) {
  echo "<option name=".$key.">".$key;['label'];
}
echo "</select>";
}


$numero_semestre = array(1,2,3,4,5,6,7,8);
formselect($numero_semestre,'numero_semestre', 'Numéro du semestre');

//form pour le label du semestre
formtext("Label semestre", "sem_label","ex : ISI1");


formtext("Semestre", "sem_annee", "P16");

$affectation = array('TCBR','BR','FCBR');
formselect($affectation,'affectation', 'Affectation');

$profil =array('Oui','Non');
formselect($profil,'profil', 'Profil');

$presence_utt = array('Oui','Non');
formselect($presence_utt,'utt', 'utt');

$resultat = array('A','B','C','D','E','F','ADM');
formselect($resultat,'resultat','Résultat');


echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
echo "<input type='hidden' name='label' value=".$_POST['label'].">";

$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$nom_uv = array();
$i=0;
$reponse = $BDD->query('SELECT (`sigle`) FROM `element_de_formation`');
while ($uv = $reponse->fetch())
{
  $nom_uv[]=$uv[0];
  $i++;
}

$reponse->closeCursor();

?>
</br>
<div class="panel-group" id="accordion1">
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#collapseOne1">
             <h4 class="panel-title">L'UV existe déjà dans la base de données</h4>
        </div>
        <div id="collapseOne1" class="panel-collapse collapse">
            <div class="panel-body">
              <?php
                formselect($nom_uv, 'uv_existe', "Nom de l'UV");
              ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#collapseTwo1">
             <h4 class="panel-title">Je souhaite créer une UV dans la base de données</h4>
        </div>
        <div id="collapseTwo1" class="panel-collapse collapse">
            <div class="panel-body">
            <?php
              formtext("Nom UV", "nom_uv","");

              $credit = array(6,4,0,30);
              formselect($credit,'credit', "Crédits");

              $categorie = array('CS','TM','EC','ME','CT','NPML','HP');
              formselect($categorie,'categorie', "Catégorie");
            ?>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-danger collapse" role="alert" id="alertSem">
  <strong>Attention !</strong> Le label du semestre doit être en majuscule.
</div>
<div class="alert alert-danger collapse" role="alert" id="alertUv">
  <strong>Attention !</strong> Le nom de l'UV doit être en majuscule.
</div>

<input type="submit" value="Valider">
<br>


</form>


<?php  

//$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_POST['numero_semestre'], $_POST['sem_label'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat'])) {


  //On regarde si on a le même label de semestre dans le cursus choisi
  $sem = array();
  $reponse4 = $BDD->prepare('SELECT `sem_label` FROM `formation` WHERE `idCursus` = ?');
  $reponse4->execute(array($_POST['idCursus']));
  while ($sem_liste = $reponse4->fetch())
  {
    $sem[]=$sem_liste['sem_label'];
  }
  $identique=FALSE;
  foreach ($sem as $element) {
    //Si le sem existe déjà dans le cursus, on lie l'uv choisi à la table qui existe déjà 
    if ($element == $_POST['sem_label']) {
      $identique = TRUE;
      $reponse5 = $BDD->prepare('SELECT `idFormation` FROM `formation` WHERE `idCursus` = ? AND `sem_label` = ?;');
      $reponse5->execute(array($_POST['idCursus'],$_POST['sem_label']));
      while ($idFormation_existe = $reponse5->fetch())
      {
        $idFormation=$idFormation_existe['idFormation'];
      }
      $reponse5->closeCursor();
    }
    //Sinon, on crée une formation et on récupère l'ID de celle-ci
    
  }
  $reponse4->closeCursor();

  if(!$identique){
      $requete2 = $BDD->prepare('INSERT INTO `formation`(`sem_annee`, `idCursus`, `sem_label`) VALUES (?,?,?)');
      $requete2->execute(array($_POST['sem_annee'], $_POST['idCursus'], $_POST['sem_label']));

      $reponse2 = $BDD->query('SELECT MAX(`idFormation`) FROM `formation`');
      while ($formation = $reponse2->fetch())
      {
        $idFormation=$formation['MAX(`idFormation`)'];
      }
      $reponse2->closeCursor();
      $requete2->closeCursor();
  }


  

  //On crée l'UV dans la base de donnée
  if (!empty($_POST['nom_uv'])){
    $requete3 = $BDD->prepare('INSERT INTO `element_de_formation`(`sigle`, `categorie`, `credit`) VALUES (?,?,?)');
    $requete3->execute(array($_POST['nom_uv'], $_POST['categorie'], $_POST['credit']));




    //On met dans la table appartient

    $requete = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
    $requete->execute(array($_POST['numero_semestre'], $_POST['nom_uv'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat'], $idFormation));

    $requete3->closeCursor();
  }
  //Ou on met l'uv existante dans la table appartient
  else{
    //On met dans la table appartient

    $requete = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
    $requete->execute(array($_POST['numero_semestre'], $_POST['uv_existe'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat'], $idFormation));
  }








  // Termine le traitement de la requête

  $requete->closeCursor();
  



}


//Affichage du cursus
$idFormation2=array();
$annee=array();
$sem_label=array();

$reponse9 = $BDD->prepare('SELECT `idFormation`, `sem_annee`, `sem_label` FROM `formation` WHERE `idCursus`= ? ORDER BY `sem_annee`');
$reponse9->execute(array($_POST['idCursus']));
      while ($formation10 = $reponse9->fetch())
      {
        $idFormation2[]=$formation10['idFormation'];
        $annee[]=$formation10['sem_annee'];
        $sem_label[]=$formation10['sem_label'];
      }
      $reponse9->closeCursor();




?>

  <table class="table table-striped">
    <thead>
      <td></td><td> CS </td><td> TM </td><td> ST </td><td> EC </td><td >ME </td><td> CT </td><td> HP </td><td> NPML </td>
    </thead>
    <tbody>
    <?php
      $i = 0;
      foreach ($idFormation2 as $element) {

        $uv_cs=array();
        $uv_tm=array();
        $uv_st=array();
        $uv_ec=array();
        $uv_me=array();
        $uv_ct=array();
        $uv_hp=array();
        $npml_admis = FALSE;

        $reponse3 = $BDD->prepare('SELECT * FROM `appartient` a,`element_de_formation` e WHERE `idFormation`= ? AND a.`sigle` = e.`sigle` ORDER BY `categorie`');
        $reponse3->execute(array($element));
              while ($appartient2 = $reponse3->fetch())
              {
                switch($appartient2['categorie']){
                  case "CS":
                    $uv_cs[$appartient2['sigle']]=$appartient2['resultat'];
                    break;
                  case "TM":
                    $uv_tm[$appartient2['sigle']]=$appartient2['resultat'];
                    break;
                  case "ST":
                    $uv_st[$appartient2['sigle']]=$appartient2['resultat'];
                    break;
                  case "EC":
                    $uv_ec[$appartient2['sigle']]=$appartient2['resultat'];
                    break;
                  case "ME":
                    $uv_me[$appartient2['sigle']]=$appartient2['resultat'];
                    break;
                  case "CT":
                    $uv_ct[$appartient2['sigle']]=$appartient2['resultat'];
                    break;
                  case "HP":
                    $uv_hp[$appartient2['sigle']]=$appartient2['resultat'];
                    break;
                  case "NPML":
                    if ($appartient2['resultat']=="ADM") {
                      $npml_admis=TRUE;
                    }
                    break;
                }
              }
              $reponse3->closeCursor();

        echo "<tr>";
        echo "<td>".$annee[$i]."<br>".$sem_label[$i]."</td>";
        echo "<td>";
          foreach ($uv_cs as $key => $value) {
            echo $key." ".$value."<br>";
          }
        echo"</td>";
        echo "<td>";
          foreach ($uv_tm as $key => $value) {
            echo $key." ".$value."<br>";
          }
        echo"</td>";
        echo "<td>";
          foreach ($uv_st as $key => $value) {
            echo $key." ".$value."<br>";
          }
        echo"</td>";
        echo "<td>";
          foreach ($uv_ec as $key => $value) {
            echo $key." ".$value."<br>";
          }
        echo"</td>";
        echo "<td>";
          foreach ($uv_me as $key => $value) {
            echo $key." ".$value."<br>";
          }
        echo"</td>";
        echo "<td>";
          foreach ($uv_ct as $key => $value) {
            echo $key." ".$value."<br>";
          }
        echo"</td>";
        echo "<td>";
          foreach ($uv_hp as $key => $value) {
            echo $key." ".$value."<br>";
          }
        echo"</td>";
        echo "<td>";
          if($npml_admis){
            echo "BULE ADM";
          }
        echo"</td>";


        echo "</tr>";

        $i++;
      }

    ?>
    </tbody>
  </table>



    </p>
  </div>
  
</div><!-- /.container -->
</body>

<div class="text-center">
<form method="post" action="exportcursus.php">
<?php
echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
?>
  <input type="submit" name="export" value="Exporter le cursus de l'étudiant en CSV">
</form>

</div>


<div class="text-center">
<h2>Importation de Cursus</h2>
<h3>Veuillez charger un fichier au format .csv</h3>
  <form method="POST" enctype="multipart/form-data" action="import.php">

    <div class="col-lg-7 col-lg-offset-7"><input  type="file" name="userfile" value="table"></div><br>
    <input class="btn btn-primary" type="submit" name="submit" value="Importer">




  </form>
</div>




</html>

