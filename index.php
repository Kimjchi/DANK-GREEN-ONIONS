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
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="etudiants.php">Etudiants</a></li>
        <li><a href="cursus.php">Cursus</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  
  </div>
</div>

<div class="container">
  
  <div class="text-center">
    <h1>Dank website</h1>
    <h2>With this dank website you will know if u can graduate</h2>
    <p class="lead">
    	

<form action="etudiants.php" method="POST">

<?php

echo "Information de l'étudiant : " ;

//function pour faire un form avec du texte
function formtext($liste){
foreach ($liste as $key) {
	echo " <label>".$key."</label> <input type=text name='".$key."'>";
}
}
//function pour faire la liste déroulante
function formselect($liste,$nomselect){
	echo " <label>".$nomselect."</label> ";
	echo "<SELECT name=".$nomselect.">";
foreach ($liste as $key) {
	echo "<option name=".$key.">".$key;
}
echo "</select>";
}



$liste1 = array('numero','nom','prenom');
formtext($liste1);


$admission = array('TC','BR');
formselect($admission,'admission');

$filiere = array('?','MPL','MSI','MRI','LIB.');
formselect($filiere,'filiere');






?>

<input type="submit" value="Valider">

</form>

<br>
Pour remplir le cursus d'un étudiants déjà inscrits, cliquez <a href="cursus.php">ici.</a>

    </p>
  </div>

</div><!-- /.container -->
</body>
</html>