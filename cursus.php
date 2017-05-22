<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


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
    <h2>With this dank website you will know if u can graduate</h2>
    <p class="lead">



    	
<!-- DEBUT DU FORMULAIRE -->

<form action="cursus.php" method="POST">

<?php

echo "Remplissage du cursus : " ;

//function pour faire un form avec du texte
function formtext($liste){
foreach ($liste as $key) {
	echo " <label>".$key."</label> <input type=text name='".$key."'>";
}
}
//function pour faire la liste déroulante
function formselect($liste,$nomselect){
	echo " <label>".$nomselect."</label> ";
	echo "<SELECT name='".$nomselect."'>";
foreach ($liste as $key) {
	echo "<option name=".$key.">".$key;
}
echo "</select>";
}


$numero_semestre = array(1,2,3,4,5,6,7,8);
formselect($numero_semestre,'numero_semestre');

//form pour le label du semestre
echo " <label>Label Semestre</label> <input type=text name='sem_label' value='ex : ISI1'>";


//form pour le nom de l'uv
echo " <label>Nom UV</label> <input type=text name='nom_uv'>";





$categorie = array('CS','TM','EC','ME','CT','NPML','HP');
formselect($categorie,'categorie');

$affectation = array('TCBR','BR','FCBR');
formselect($affectation,'affectation');

$profil =array('Oui','Non');
formselect($profil,'profil');

$presence_utt = array('Oui','Non');
formselect($presence_utt,'utt');

$credit = array(6,4,0,30);
formselect($credit,'credit');

$resultat = array('A','B','C','D','E','F','ADM');
formselect($resultat,'resultat');



?>
<input type="submit" value="Valider">


</form>


<?php  

$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_POST['numero_semestre'], $_POST['sem_label'], $_POST['nom_uv'], $_POST['categorie'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['credit'], $_POST['resultat'])) {
	


$requete = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sem_label`, `sigle`, `affectation`, `utt`, `profil`, `resultat`)  VALUES (?,?,?,?,?,?,?,)');
$requete->execute(array($_POST['numero_semestre'], $_POST['sem_label'], $_POST['nom_uv'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat']));

}

// test pour savoir si les variables sont toutes présentes

echo "num_semestre : " .$_POST['numero_semestre']. "sem_label : " .$_POST['sem_label']. "nom_uv : ".$_POST['nom_uv']. "categorie : ".$_POST['categorie']. "affectation : ".$_POST['affectation']. "presence utt : " .$_POST['utt']. "profil" .$_POST['profil']. "credit: " .$_POST['credit']. "resultat : " .$_POST['resultat'];


$reponse1 = $BDD->query('SELECT * FROM appartient');
while ($appartient = $reponse1->fetch())
{
echo '<p> Semestre n°' . $appartient['sem_seq'] . ' - ' . $appartient['sem_label'] . " UV: " . $appartient['sigle'] . " Affectation: ". $appartient['affectation'] . " - Présence à l\'utt " . $appartient['utt'] . "Profil: " .$_POST['profil']. " </p>";

}
$reponse1->closeCursor(); // Termine le traitement de la requête










?>





    </p>
  </div>
  
</div><!-- /.container -->
</body>
</html>


</body>
</html>