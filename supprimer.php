<!DOCTYPE html>
<html>
<head>
	<title>Suppression</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="css/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $BDD->prepare('DELETE FROM `appartient` WHERE idFormation=? AND sigle=?');
$requete->execute(array($_POST['idFormation'],$_POST['supprimer']));

?>

<div class="alert alert-success" role="alert"><strong>La suppression est réussite ! </strong></div>

<form action="modification_cursus.php" method="POST">
    <?php 
    echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
    echo "<input type='hidden' name='label' value=".$_POST['label'].">";
    echo '<input class="btn btn-primary" type="submit" value="Retourner sur le cursus">';
    ?>
</form>
</body>
</html>