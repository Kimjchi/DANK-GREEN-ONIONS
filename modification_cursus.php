


<!DOCTYPE html>
<html>
<head>
  <title>Cursus utt</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="css/bootstrap/js/bootstrap.min.js"></script>
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

<form action="modification_cursus.php" method="POST">

<?php

echo "<h3>Modification du cursus : ".$_POST['label']."</h3></br>" ;

//function pour faire un form avec du texte
function formtext($label,$name,$value){
  echo " <label>".$label."</label> <input type=text name='".$name."' value='".$value."'>";
}
//function pour faire la liste déroulante
function formselect($liste,$nomselect){
  echo " <label>".$nomselect."</label> ";
  echo "<SELECT name='".$nomselect."'>";
foreach ($liste as $key) {
  echo "<option name=".$key.">".$key;['label'];
}
echo "</select>";
}


$numero_semestre = array(1,2,3,4,5,6,7,8);
formselect($numero_semestre,'numero_semestre');

//form pour le label du semestre
formtext("Label semestre", "sem_label","ex : ISI1");


formtext("Semestre", "sem_annee", "P16");

$affectation = array('TCBR','BR','FCBR');
formselect($affectation,'affectation');

$profil =array('Oui','Non');
formselect($profil,'profil');

$presence_utt = array('Oui','Non');
formselect($presence_utt,'utt');

$resultat = array('A','B','C','D','E','F','ADM');
formselect($resultat,'resultat');


echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
echo "<input type='hidden' name='label' value=".$_POST['label'].">";

?>
</br>
<div class="panel-group" id="accordion1">
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#collapseOne1">
             <h4 class="panel-title">L'UV existe déjà dans la base de données</h4>
        </div>
        <div id="collapseOne1" class="panel-collapse collapse">
            <div class="panel-body">...</div>
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
              formselect($credit,'credit');

              $categorie = array('CS','TM','EC','ME','CT','NPML','HP');
              formselect($categorie,'categorie');
            ?>
            </div>
        </div>
    </div>
</div>

<input type="submit" value="Valider">


</form>


<?php  

$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_POST['numero_semestre'], $_POST['sem_label'], $_POST['nom_uv'], $_POST['categorie'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['credit'], $_POST['resultat'])) {

//On met la formation dans le cursus
$idCursus=$_POST['idCursus'];

$requete2 = $BDD->prepare('INSERT INTO `formation`(`sem_annee`, `idCursus`) VALUES (?,?)');
$requete2->execute(array($_POST['sem_annee'], $idCursus));

//On crée l'UV dans la base de donnée
$requete3 = $BDD->prepare('INSERT INTO `element de formation`(`sigle`, `categorie`, `credit`) VALUES (?,?,?)');
$requete3->execute(array($_POST['nom_uv'], $_POST['categorie'], $_POST['credit']));


//On met dans la table appartient
$reponse2 = $BDD->query('SELECT MAX(`idFormation`) FROM `formation`');
while ($formation = $reponse2->fetch())
{
  $idFormation=$formation['MAX(`idFormation`)'];
}

$requete = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sem_label`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?,?)');
$requete->execute(array($_POST['numero_semestre'], $_POST['sem_label'], $_POST['nom_uv'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat'], $idFormation));





// Termine le traitement de la requête
//$reponse1->closeCursor();
$reponse2->closeCursor();

$requete->closeCursor();
$requete2->closeCursor();
$requete3->closeCursor();


}




?>





    </p>
  </div>
  
</div><!-- /.container -->
</body>
</html>

