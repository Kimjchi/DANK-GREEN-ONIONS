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
        <li class="active"><a href="etudiants.php">Etudiants</a></li>
        <li><a href="cursus.php">Cursus</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  
  </div>
</div>

<div class="container">
  
  <div class="text-center">
    <h1>Dank website</h1>
    <h2>Etudiants inscrits</h2>
    <p class="lead">
    	



<?php

$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_POST['numero'], $_POST['nom'], $_POST['prenom'], $_POST['admission'], $_POST['filiere'])) {
	


$requete = $BDD->prepare('INSERT INTO `etudiant`(`numero`, `nom`, `prenom`, `admission`, `filiere`) VALUES (?,?,?,?,?)');
$requete->execute(array($_POST['numero'], $_POST['nom'], $_POST['prenom'], $_POST['admission'], $_POST['filiere']));
$requete->closeCursor();
}





$reponse = $BDD->query('SELECT * FROM etudiant');
while ($etudiant = $reponse->fetch())
{
echo '<p>' . $etudiant['numero'] . ' - ' . $etudiant['nom'] . " " . $etudiant['prenom'] . " ". $etudiant['admission'] . ' - ' . $etudiant['filiere'] . '</p>';

}
$reponse->closeCursor(); // Termine le traitement de la requête

?>



    </p>
  </div>
  
</div><!-- /.container -->
</body>
</html>