
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



    


<?php  
include 'formulaire_formation.php';
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
      $requete2 = $BDD->prepare('INSERT INTO `formation`(`idCursus`, `sem_label`) VALUES (?,?)');
      $requete2->execute(array($_POST['idCursus'], $_POST['sem_label']));

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
include 'affichage_cursus.php';
include 'agregat_cursus.php';
include 'reglement.php';
?>



    </p>
  </div>
  
</div><!-- /.container -->
</body>

<div class="text-center">
<form method="post" action="exportcursus.php">
<?php
echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
echo "<input type='hidden' name='label' value=".$_POST['label'].">";
?>
  <input type="submit" name="export" value="Exporter le cursus de l'étudiant en CSV">
</form>

</div>


<div class="text-center">
<h2>Importation de Cursus</h2>
<h3>Veuillez charger un fichier au format .csv</h3>
  <form method="POST" enctype="multipart/form-data" action="import.php">
    <div class="col-lg-7 col-lg-offset-7"><input  type="file" name="userfile" value="table"></div><br>
    <?php  
      echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
      echo "<input type='hidden' name='label' value=".$_POST['label'].">";
    ?>

    <input class="btn btn-primary" type="submit" name="submit" value="Importer">




  </form>
</div>




</html>

