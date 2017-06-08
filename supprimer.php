<?php
$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $BDD->prepare('DELETE FROM `appartient` WHERE idFormation=? AND sigle=?');
$requete->execute(array($_POST['idFormation'],$_POST['supprimer']));










?>