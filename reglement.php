<!DOCTYPE html>
<html>
<head>
	<title>Règlements</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		//Règlement actuel
		$r01 = false;
		if ((compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus']))>=54) {
		 	$r01 = true;
		} 

		$r02 = false;
		if ((compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))>=30) {
			$r02 = true;
		}

		$r03 = false;
		if (compteCreditsRegle('CS','BR',$_POST['idCursus'])>=30) {
			$r03 = true;
		}

		$r04 = false;
		if (compteCreditsRegle('TM','BR',$_POST['idCursus'])>=30) {
			$r04 = true;
		}

		$r05 = false;
		if (compteCreditsRegle('ST','TCBR',$_POST['idCursus'])>=30) {
			$r05 = true;
		}

		$r06 = false;
		if (compteCreditsRegle('ST','FCBR',$_POST['idCursus'])>=30) {
			$r06 = true;
		}

		$r07 = false;
		if (compteCreditsRegle('EC','BR',$_POST['idCursus'])>=12) {
			$r07 = true;
		}

		$r08 = false;
		if (compteCreditsRegle('ME','BR',$_POST['idCursus'])>=4) {
			$r08 = true;
		}

		$r09 = false;
		if (compteCreditsRegle('CT','BR',$_POST['idCursus'])>=4) {
			$r09 = true;
		}

		$r10 = false;
		if ((compteCreditsRegle('ME','BR',$_POST['idCursus'])+compteCreditsRegle('CT','BR',$_POST['idCursus']))>=16) {
			$r10 = true;
		}

		$r11 = false;
		if ((compteCreditsUTT('CS','BR',$_POST['idCursus'])+compteCreditsUTT('TM','BR',$_POST['idCursus']))>=60) {
			$r11 = true;
		}		

		$r12 = false;
		if (UVexiste('SE',$_POST['idCursus'])) {
			$r12 = true;
		}

		$r13 = false;
		if (UVexiste('NPML',$_POST['idCursus'])) {
			$r13 = true;
		}

		$r14 = false;
		if (compteCreditsCursus($_POST['idCursus'])) {
			$r14 = true;
		}
	?>
</body>
</html>