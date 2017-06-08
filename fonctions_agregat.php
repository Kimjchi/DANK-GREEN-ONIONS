<!DOCTYPE html>
<html>
<head>
  <title>Fonctions des agrégats</title>
  <meta charset="utf-8">
</head>
<body>
<?php
  function compteCredits($categorie, $formation){
  $resultat=array();
  $credit=array();
  $BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
  $reponse30 = $BDD->prepare('SELECT resultat, credit FROM `appartient` a,`element_de_formation` e WHERE `idFormation`= ? AND a.`sigle` = e.`sigle` AND `categorie`= ?');
  $reponse30->execute(array($formation,$categorie));
  while ($appartient20 = $reponse30->fetch())
  {
    $resultat[]=$appartient20['resultat'];
    $credit[]=$appartient20['credit'];
  }
  $reponse30->closeCursor();
  $total=0;
  $i=0;
  foreach ($resultat as $element) {
    if ($element!='F') {
      $total+=$credit[$i];
      
    }
    $i++;
  }

  return $total;
}

function compteCreditsRegle($categorie, $affectation){

}
?>
</body>
</html>