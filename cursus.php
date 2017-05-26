


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

echo "<h3>Remplissage du cursus :</h3></br> " ;

//function pour faire un form avec du texte
function formtext($label,$name,$value){
	echo " <label>".$label."</label> <input type=text name='".$name."' value='".$value."'>";
}
//function pour faire la liste déroulante
function formselect($liste){
	echo " <label>Etudiant</label> ";
	echo "<SELECT name='numero'>";
foreach ($liste as $key => $value) {
	echo "<option value=".$key.">".$value;
}
echo "</select>";
}





formtext("Label du cursus","label","");

$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$etu = array();
$reponse = $BDD->query('SELECT * FROM `etudiant`');
while ($etudiant = $reponse->fetch())
{
  $etu[$etudiant['numero']] = $etudiant['numero'].' - '.$etudiant['nom'].' '.$etudiant['prenom'];
}

$reponse->closeCursor();

?>
</br>
</br>
<a class="btn btn-primary" href="index.php">Je souhaite créer l'étudiant dans la base de données</a>
</br></br>
<button class="btn btn-primary" type="button" data-target="#MonCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="MonCollapse">L'étudiant existe déjà dans la base de données</button>
 
<!-- le contenu masqué -->
 
<section id="MonCollapse" class="collapse">
<div><?php
  formselect($etu);
  ?>
  </div>
</section>
</br></br>

<input type="submit" value="Valider">


</form>
</br>


<?php  

if (isset($_POST['label'], $_POST['numero'])){

  //On créer le cursus	
  $requete1 = $BDD->prepare('INSERT INTO `cursus`(`label`, `numero`) VALUES (?,?)');
  $requete1->execute(array($_POST['label'], $_POST['numero']));



  $requete1->closeCursor();

}

  $reponse2 = $BDD->query('SELECT * FROM `cursus`');
  while ($cursus = $reponse2->fetch())
  {
    echo "<form action='modification_cursus.php' method='POST'> ";
    echo "<input type='hidden' name='idCursus' value=".$cursus['idCursus'].">";
    echo "<input type='hidden' name='label' value=".$cursus['label'].">";
    echo '<input class="btn btn-default" type="submit" value="Label du cursus : ' . $cursus['label'] . " - Numéro de l'étudiant :" . $cursus['numero'] .'">';
    echo "</form>";
  }

  $reponse2->closeCursor(); // Termine le traitement de la requête


  
  






?>





    </p>
  </div>
  
</div><!-- /.container -->
</body>
</html>

