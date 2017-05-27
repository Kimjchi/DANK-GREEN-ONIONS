<?php
header('Content-Type=text/csv');
header('Content-Disposition: attachment; filename="Export_cursus.csv');
if(isset($_POST['export']))

{
	$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','');
	$BDD->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
	$BDD->setAttribute(PDO:: ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);


$requete = $BDD->prepare('SELECT * FROM appartient');
$requete-> execute();
$cursus = $requete->fetchALL();
//print_r($cursus);

//manque categorie, credit, idk comment faire un csv pour plusieurs tables


?>"sem_seq","sem_label","sigle","affectation","utt","profil","resultat"<?php
foreach ($cursus as $c) {
	echo "\n".'"'.$c->sem_seq.'";"'.$c->sem_label.'";"'.$c->sigle.'";"'.$c->affectation.'";"'.$c->utt.'";"'.$c->profil.'";"'.$c->resultat.'"';
}}?>





