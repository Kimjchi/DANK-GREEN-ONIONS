<?php
$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$filename = $_FILES["userfile"]['tmp_name']; 
$csv = file_get_contents($filename);
$csv_lines = preg_split('/\\r\\n|\\r|\\n/', $csv);
print_r($csv_lines);

// on explode les elements du csv en variables

foreach ($csv_lines as $element) {
list($sem_seq, $sem_label , $sigle, $categorie, $credit, $affectation, $utt, $profil, $resultat)= explode(",", $element);
echo $sem_seq;
}


$sigle_bdd = array(); //on crée un array pour mettre les datas dedans
$reponse = $BDD->query('SELECT sigle FROM element_de_formation');
while ($element_de_formation_bdd=$reponse->fetch()) {
	$sigle_bdd[]=$element_de_formation_bdd['sigle'];
}

// on crée une nouvelle formation

$requete2 = $BDD->prepare('INSERT INTO `formation`(`idCursus`, `sem_label`) VALUES (?,?)');
$requete2->execute(array($_POST['idCursus'], $sem_label)); //idcursus est la car il est hidden

$reponse2 = $BDD->query('SELECT MAX(`idFormation`) FROM `formation`');
    while ($formation = $reponse2->fetch()){
        $idFormation=$formation['MAX(`idFormation`)'];
      }
$reponse2->closeCursor();
$requete2->closeCursor();
$present = false ;


foreach ($sigle_bdd as $element2) {
if ($sigle==$element2) {
	$present = true;
	}
}
  if ($present){ //si le sigle existe  déja dans la bdd

    //On met dans la table appartient

    	$requete3 = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
    	$requete3->execute(array($sem_seq, $sigle , $affectation, $utt, $profil, $resultat, $idFormation));

    	$requete3->closeCursor();
	}

else { //on ajoute l'uv dans la bdd

    $requete3 = $BDD->prepare('INSERT INTO `element_de_formation`(`sigle`, `categorie`, `credit`) VALUES (?,?,?)');
    $requete3->execute(array($sigle, $categorie, $credit));

    $requete3 = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
    $requete3->execute(array($sem_seq, $sigle , $affectation, $utt, $profil, $resultat, $idFormation));
    $requete3->closeCursor();

	}






?>


