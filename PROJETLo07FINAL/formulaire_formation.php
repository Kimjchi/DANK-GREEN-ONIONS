<!DOCTYPE html>
<html>
<head>
  <title>Formulaire</title>
  <meta charset="utf-8">
</head>
<body>
<!-- DEBUT DU FORMULAIRE -->

<form action="modification_cursus.php" method="POST" id="FormIdent" name="FormIdent" onsubmit="return validForm();">

<?php

include 'fonctions_agregat.php';

echo "<h3>Modification du cursus : ".$_POST['label']."</h3></br>" ;

//function pour faire un form avec du texte
function formtext($label,$name,$value){
  echo " <label>".$label."</label> <input type=text name='".$name."' value='".$value."'>";
}
//function pour faire la liste déroulante
function formselect($liste,$nomselect,$label){
  echo " <label>".$label."</label> ";
  echo "<SELECT name='".$nomselect."'>";
foreach ($liste as $key) {
  echo "<option name=".$key.">".$key;['label'];
}
echo "</select>";
}


$numero_semestre = array(1,2,3,4,5,6,7,8);
formselect($numero_semestre,'numero_semestre', 'Numéro du semestre');

//form pour le label du semestre
formtext("Label semestre", "sem_label","ex : ISI1");

$affectation = array('TCBR','TC','FCBR');
formselect($affectation,'affectation', 'Affectation');

$profil =array('Oui','Non');
formselect($profil,'profil', 'Profil');

$presence_utt = array('Oui','Non');
formselect($presence_utt,'utt', 'utt');

$resultat = array('A','B','C','D','E','F','ADM');
formselect($resultat,'resultat','Résultat');


echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
echo "<input type='hidden' name='label' value=".$_POST['label'].">";

$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$nom_uv = array();
$i=0;
$reponse = $BDD->query('SELECT (`sigle`) FROM `element_de_formation`');
while ($uv = $reponse->fetch())
{
  $nom_uv[]=$uv[0];
  $i++;
}

$reponse->closeCursor();

?>
</br>
<div class="panel-group" id="accordion1">
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#collapseOne1">
             <h4 class="panel-title">L'UV existe déjà dans la base de données</h4>
        </div>
        <div id="collapseOne1" class="panel-collapse collapse">
            <div class="panel-body">
              <?php
                formselect($nom_uv, 'uv_existe', "Nom de l'UV");
              ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#collapseTwo1">
             <h4 class="panel-title">Je souhaite créer une UV dans la base de données</h4>
        </div>
        <div id="collapseTwo1" class="panel-collapse collapse">
            <div class="panel-body">
            <?php
              formtext("Nom UV", "nom_uv","");

              $credit = array(6,4,30);
              formselect($credit,'credit', "Crédits");

              $categorie = array('CS','TM','EC','ME','CT','NPML','HP','SE');
              formselect($categorie,'categorie', "Catégorie");
            ?>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-danger collapse" role="alert" id="alertSem">
  <strong>Attention !</strong> Le label du semestre doit être en majuscule.
</div>
<div class="alert alert-danger collapse" role="alert" id="alertUv">
  <strong>Attention !</strong> Le nom de l'UV doit être en majuscule.
</div>

<input type="submit" class="btn btn-default" value="Valider">
<br>
<br>
<hr>


</form>
</body>
</html>