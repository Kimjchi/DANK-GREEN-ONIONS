<!DOCTYPE html>
<html>
<head>
	<title>Affichage du cursus</title>
	<meta charset="utf-8">
</head>
<body>
  <?php
  $idFormation2=array();
  $sem_label=array();

  $reponse9 = $BDD->prepare('SELECT `idFormation`, `sem_label` FROM `formation` WHERE `idCursus`= ? ORDER BY `sem_label`');
  $reponse9->execute(array($_POST['idCursus']));
        while ($formation10 = $reponse9->fetch())
        {
          $idFormation2[]=$formation10['idFormation'];
          $sem_label[]=$formation10['sem_label'];
        }
        $reponse9->closeCursor();

  ?>


    <table class="table table-striped">
      <thead>
        <td></td><td> CS </td><td> TM </td><td> ST </td><td> EC </td><td >ME </td><td> CT </td><td> HP </td><td> NPML </td> <td>Supprimer une UV du semestre</td>
      </thead>
      <tbody>
      <?php
        $i = 0;
        foreach ($idFormation2 as $element) {

          $uv_cs=array();
          $uv_tm=array();
          $uv_st=array();
          $uv_ec=array();
          $uv_me=array();
          $uv_ct=array();
          $uv_hp=array();
          $npml_admis = FALSE;
          $uv_semestre=array();
          $reponse3 = $BDD->prepare('SELECT * FROM `appartient` a,`element_de_formation` e WHERE `idFormation`= ? AND a.`sigle` = e.`sigle` ORDER BY `categorie`');
          $reponse3->execute(array($element));
                while ($appartient2 = $reponse3->fetch())
                {
                  switch($appartient2['categorie']){
                    case "CS":
                      $uv_cs[$appartient2['sigle']]=$appartient2['resultat'];
                      break;
                    case "TM":
                      $uv_tm[$appartient2['sigle']]=$appartient2['resultat'];
                      break;
                    case "ST":
                      $uv_st[$appartient2['sigle']]=$appartient2['resultat'];
                      break;
                    case "EC":
                      $uv_ec[$appartient2['sigle']]=$appartient2['resultat'];
                      break;
                    case "ME":
                      $uv_me[$appartient2['sigle']]=$appartient2['resultat'];
                      break;
                    case "CT":
                      $uv_ct[$appartient2['sigle']]=$appartient2['resultat'];
                      break;
                    case "HP":
                      $uv_hp[$appartient2['sigle']]=$appartient2['resultat'];
                      break;
                    case "NPML":
                      if ($appartient2['resultat']=="ADM") {
                        $npml_admis=TRUE;
                      }
                      break;
                  }
                  $uv_semestre[]=$appartient2['sigle'];
                }
                $reponse3->closeCursor();

//print_r($uv_semestre);


          echo "<tr>";
          echo "<td>".$sem_label[$i]."</td>";
          echo "<td>";
            foreach ($uv_cs as $key => $value) {
              echo $key." ".$value."<br>";
            }
          echo"</td>";
          echo "<td>";
            foreach ($uv_tm as $key => $value) {
              echo $key." ".$value."<br>";
            }
          echo"</td>";
          echo "<td>";
            foreach ($uv_st as $key => $value) {
              echo $key." ".$value."<br>";
            }
          echo"</td>";
          echo "<td>";
            foreach ($uv_ec as $key => $value) {
              echo $key." ".$value."<br>";
            }
          echo"</td>";
          echo "<td>";
            foreach ($uv_me as $key => $value) {
              echo $key." ".$value."<br>";
            }
          echo"</td>";
          echo "<td>";
            foreach ($uv_ct as $key => $value) {
              echo $key." ".$value."<br>";
            }
          echo"</td>";
          echo "<td>";
            foreach ($uv_hp as $key => $value) {
              echo $key." ".$value."<br>";
            }
          echo"</td>";
          echo "<td>";
          echo " ";
            if($npml_admis){
              echo "BULE ADM";
            }
          echo"</td>";


          echo "</tr>";

          echo "<tr>";

          echo "<td>";
          echo "Total semestre";
          echo "</td>";

          echo "<td>";
          echo compteCredits('CS',$element);
          echo "</td>";

          echo "<td>";
          echo compteCredits('TM',$element);
          echo "</td>";

          echo "<td>";
          echo compteCredits('ST',$element);
          echo "</td>";

          echo "<td>";
          echo compteCredits('EC',$element);
          echo "</td>";

          echo "<td>";
          echo compteCredits('ME',$element);
          echo "</td>";

          echo "<td>";
          echo compteCredits('CT',$element);
          echo "</td>";

          echo "<td>";
          echo compteCredits('HP',$element);
          echo "</td>";

//liste déroulante uv pour supprimer uv
echo "<td>";
echo "</td><td> ";         
echo "<form method=post action='supprimer.php'>";
echo "<SELECT name='supprimer'>";
foreach ($uv_semestre as $uv) {
echo "<option name='uv_supprimer'>".$uv;
}
echo "</select>";
echo "<input type='hidden' name='idFormation' value=".$element.">";
echo "<input type=submit value=Supprimer> ";
echo "</form>";
echo "</td>"; 


          echo "</tr>";

          $i++;
        }

      ?>
      </tbody>
    </table>
</body>
</html>