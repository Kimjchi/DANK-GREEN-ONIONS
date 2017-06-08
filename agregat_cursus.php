<!DOCTYPE html>
<html>
<head>
	<title>Agrégat du cursus</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$reponse300 = $BDD->prepare('SELECT admission FROM `cursus` c,`etudiant` e WHERE `idCursus`= ? AND c.`numero` = e.`numero`');
		$reponse300->execute(array($_POST['idCursus']));
		while ($appartient200 = $reponse300->fetch())
		{
			$admission=$appartient200['admission'];
		}
		$reponse300->closeCursor();
	?>
	<br>
	<div class="page-header">
	<h3>Totaux</h3>
	</div>
	<table class="table table-bordered table-striped">
	  <thead>
        <td></td><td> CS </td><td> TM </td><td> ST </td><td> EC </td><td >ME </td><td> CT </td><td> HP </td><td> NPML </td>
      </thead>
      <tbody>
      	<?php 
      		if ($admission=='TC') {
      			echo "<tr>";
      			echo "<td>TC</td>";
      			echo "<td>".compteCreditsRegle('CS','TC',$_POST['idCursus'])."</td>";
      			echo "<td>".compteCreditsRegle('TM','TC',$_POST['idCursus'])."</td>";
      			echo "</tr>";
      		}
      		echo "<tr>";
      		echo "<td>TCBR</td>";
      		echo "<td>".(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus']))."</td>";
      		echo "</tr>";
      		echo "<tr>";
      		echo "<td>FIL</td>";
      		echo "<td>".(compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))."</td>";
      		echo "</tr>";
      		echo "<tr>";
      		echo "<td>TCBR+FIL</td>";
      		echo "<td>".(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus']))."</td>";
      		echo "<td>".(compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))."</td>";
      		echo "</tr>";
      		echo "<td>Global</td>";
      		echo "<td>".(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('CS','TC',$_POST['idCursus']))."</td>";
      		echo "<td>".(compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TC',$_POST['idCursus']))."</td>";
      		echo "<td>".(compteCreditsRegle('ST','TCBR',$_POST['idCursus'])+compteCreditsRegle('ST','FCBR',$_POST['idCursus'])+compteCreditsRegle('ST','TC',$_POST['idCursus']))."</td>";
      		echo "<td>".(compteCreditsRegle('EC','TCBR',$_POST['idCursus'])+compteCreditsRegle('EC','FCBR',$_POST['idCursus'])+compteCreditsRegle('EC','TC',$_POST['idCursus']))."</td>";
      		echo "<td>".(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])+compteCreditsRegle('ME','TC',$_POST['idCursus']))."</td>";
      		echo "<td>".(compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])+compteCreditsRegle('CT','TC',$_POST['idCursus']))."</td>";
      		echo "<td>".(compteCreditsRegle('HP','TCBR',$_POST['idCursus'])+compteCreditsRegle('HP','FCBR',$_POST['idCursus'])+compteCreditsRegle('HP','TC',$_POST['idCursus']))."</td>";
      		echo "</tr>";
      	?>

      </tbody>
	</table>
</body>
</html>