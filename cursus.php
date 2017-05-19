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
      <a class="navbar-brand" href="#">DANK-GREEN-ONIONS</a>
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

<form action="cible.php" method="POST">

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
	echo "<SELECT name=".$nomselect.">";
foreach ($liste as $key) {
	echo "<option name=".$key.">".$key;
}
echo "</select>";
}


$numero_semestre = array(1,2,3,4,5,6,7,8);
formselect($numero_semestre,'numero semestre');

//form pour le label du semestre
echo " <label>Label Semestre</label> <input type=text name='sem_label' value='ex : ISI1'>";


//form pour le nom de l'uv
echo " <label>Nom UV</label> <input type=text name='nom_uv'>";





$categorie = array('CS','TM','EC','ME','CT','NPML','HP');
formselect($categorie,'categorie');

$affectation = array('TCBR','BR','FCBR');
formselect($affectation,'affectation');

$presence_utt = array('Oui','Non');
formselect($presence_utt,'presence a l\'utt');

$credit = array(6,4,0,30);
formselect($credit,'credit');

$resultat = array('A','B','C','D','E','F','ADM');
formselect($resultat,'resultat');



?>
<input type="submit" value="Valider">


</form>



    </p>
  </div>
  
</div><!-- /.container -->
</body>
</html>


</body>
</html>