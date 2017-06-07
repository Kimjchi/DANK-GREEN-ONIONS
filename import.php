<?php
$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$filename = $_FILES["userfile"]['tmp_name'];
$csv = file_get_contents($filename);
$csv_lines = preg_split('/\\r\\n|\\r|\\n/', $csv);
print_r($csv_lines);


foreach ($csv_lines as $element) {
list($sem_seq, $sem_label , $sigle, $categorie, $credit, $affectation, $utt, $profil, $resultat, $idFormation)= explode(",", $element);
echo $sem_seq;
$requete1 = $BDD->prepare("INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`) VALUES (?,?,?,?,?,?,?)");

$requete1->execute(array($sem_seq, $sigle , $affectation, $utt, $profil, $resultat, $idFormation));

$requete2 = $BDD->prepare("INSERT INTO `element_de_formation`(`sigle`, `categorie`, `credit`) VALUES (?,?,?)");
$requete1->execute(array($sigle, $categorie, $resultat));


}

?>


