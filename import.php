<!DOCTYPE html>
<html>
<head>
    <title>Import</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="css/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$filename = $_FILES["userfile"]['tmp_name']; 
$csv = file_get_contents($filename);
$csv_lines = preg_split('/\\r\\n|\\r|\\n/', $csv);








// on explode les elements du csv en variables

foreach ($csv_lines as $element) {
    list($sem_seq, $sem_label , $sigle, $categorie, $credit, $affectation, $utt, $profil, $resultat)= explode(",", $element);

    //On regarde si on a le même label de semestre dans le cursus choisi
    $sem = array();
    $reponse4 = $BDD->prepare('SELECT `sem_label` FROM `formation` WHERE `idCursus` = ?');
    $reponse4->execute(array($_POST['idCursus']));
    while ($sem_liste = $reponse4->fetch())
    {
        $sem[]=$sem_liste['sem_label'];
    }

    $sigle_bdd = array(); //on crée un array pour mettre les datas dedans
    $reponse = $BDD->query('SELECT sigle FROM element_de_formation');
    while ($element_de_formation_bdd=$reponse->fetch()) {
        $sigle_bdd[]=$element_de_formation_bdd['sigle'];
    }

    $identique=FALSE;
    foreach ($sem as $element) {
    //Si le sem existe déjà dans le cursus, on lie l'uv choisi à la table qui existe déjà 
        if ($element == $sem_label) {
          $identique = TRUE;
        }
    }
    if ($identique) {
        $reponse5 = $BDD->prepare('SELECT `idFormation` FROM `formation` WHERE `idCursus` = ? AND `sem_label` = ?;');
        $reponse5->execute(array($_POST['idCursus'],$sem_label));
        while ($idFormation_existe = $reponse5->fetch())
        {
           $idFormation=$idFormation_existe['idFormation'];
        }
        $reponse5->closeCursor();
    }
    //Sinon on crée une nouvelle formation
    else {

        $requete2 = $BDD->prepare('INSERT INTO `formation`(`idCursus`, `sem_label`) VALUES (?,?)');
        $requete2->execute(array($_POST['idCursus'], $sem_label)); //idcursus est la car il est hidden

        $reponse2 = $BDD->query('SELECT MAX(`idFormation`) FROM `formation`');
            while ($formation = $reponse2->fetch()){
                $idFormation=$formation['MAX(`idFormation`)'];
              }
        $reponse2->closeCursor();
        $requete2->closeCursor();
    }
    $present = false ;


    foreach ($sigle_bdd as $element2) {
    if ($sigle==$element2) {
        $present = true;
        }
    }
      if ($present){ //si le sigle existe  déja dans la bdd

        //On met dans la table appartient

            $requete3 = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
            $requete3->execute(array($sem_seq, strval($sigle) , strval($affectation), strval($utt), strval($profil), strval($resultat), $idFormation));

            $requete3->closeCursor();

        }

    else { //on ajoute l'uv dans la bdd

        $requete3 = $BDD->prepare('INSERT INTO `element_de_formation`(`sigle`, `categorie`, `credit`) VALUES (?,?,?)');
        $requete3->execute(array(strval($sigle), strval($categorie), $credit));

        $requete3 = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
        $requete3->execute(array($sem_seq, strval($sigle) , strval($affectation), strval($utt), strval($profil), strval($resultat), $idFormation));
        $requete3->closeCursor();

        }
}




?>
<div class="alert alert-success" role="alert"><strong>L'importation est réussite ! </strong></div>

<form action="modification_cursus.php" method="POST">
    <?php 
    echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
    echo "<input type='hidden' name='label' value=".$_POST['label'].">";
    echo '<input class="btn btn-primary" type="submit" value="Retourner sur le cursus">';
    ?>
</form>



</body>
</html>