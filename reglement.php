<!DOCTYPE html>
<html>
<head>
	<title>Règlements</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	//Règlement actuel
	function R_ACTUEL_BR(){
		$reussite = 0;

		//R01
		if ((compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus']))>=54) {
		 	echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS+TM de TCBR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus'])).'/54</div>';
		 	$reussite++;
		} 
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS+TM de TCBR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus'])).'/54</div>';
		}

		//R02
		if ((compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))>=30) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS+TM de FCBR </strong>'.(compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/30</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS+TM de FCBR </strong>'.(compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/30</div>';
		}

		//R03
		if ((compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus']))>=30) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS de BR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])).'/30</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS de BR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])).'/30</div>';
		}

		//R04
		if ((compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))>=30) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en TM de BR </strong>'.(compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/30</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en TM de BR </strong>'.(compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/30</div>';
		}

		//R05
		if (compteCreditsRegle('ST','TCBR',$_POST['idCursus'])>=30) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ST de TCBR </strong>'.compteCreditsRegle('ST','TCBR',$_POST['idCursus']).'/30</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ST de TCBR </strong>'.compteCreditsRegle('ST','TCBR',$_POST['idCursus']).'/30</div>';
		}

		//R06
		if (compteCreditsRegle('ST','FCBR',$_POST['idCursus'])>=30) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ST de FCBR </strong>'.compteCreditsRegle('ST','FCBR',$_POST['idCursus']).'/30</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ST de FCBR </strong>'.compteCreditsRegle('ST','FCBR',$_POST['idCursus']).'/30</div>';
		}

		//R07
		if ((compteCreditsRegle('EC','TCBR',$_POST['idCursus'])+compteCreditsRegle('EC','FCBR',$_POST['idCursus']))>=12) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en EC de BR </strong>'.(compteCreditsRegle('EC','TCBR',$_POST['idCursus'])+compteCreditsRegle('EC','FCBR',$_POST['idCursus'])).'/12</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en EC de BR </strong>'.(compteCreditsRegle('EC','TCBR',$_POST['idCursus'])+compteCreditsRegle('EC','FCBR',$_POST['idCursus'])).'/12</div>';
		}

		//R08
		if ((compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus']))>=4) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ME de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])).'/4</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ME de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])).'/4</div>';	
		}

		//R09
		if ((compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus']))>=4) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CT de BR </strong>'.(compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/4</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CT de BR </strong>'.(compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/4</div>';
		}

		//R10
		if ((compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus']))>=16) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ME+CT de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/16</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ME+CT de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/16</div>';	
		}

		//R11
		if ((compteCreditsUTT('CS','TCBR',$_POST['idCursus'])+compteCreditsUTT('TM','TCBR',$_POST['idCursus'])+compteCreditsUTT('CS','FCBR',$_POST['idCursus'])+compteCreditsUTT('TM','FCBR',$_POST['idCursus']))>=60) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS+TM de BR à l'."'UTT</strong>".(compteCreditsUTT('CS','TCBR',$_POST['idCursus'])+compteCreditsUTT('TM','TCBR',$_POST['idCursus'])+compteCreditsUTT('CS','FCBR',$_POST['idCursus'])+compteCreditsUTT('TM','FCBR',$_POST['idCursus'])).'/60</div>';
			$reussite++;
		}		
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS+TM de BR à l'."'UTT</strong>".(compteCreditsUTT('CS','TCBR',$_POST['idCursus'])+compteCreditsUTT('TM','TCBR',$_POST['idCursus'])+compteCreditsUTT('CS','FCBR',$_POST['idCursus'])+compteCreditsUTT('TM','FCBR',$_POST['idCursus'])).'/60</div>';
		}

		//R12
		if (UVexiste('SE',$_POST['idCursus'])) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez validé votre SE</strong></div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Vous devez encore validé votre SE</strong></div>';
			
		}

		//R13
		if (UVexiste('NPML',$_POST['idCursus'])) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez validé votre NPML</strong></div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Vous devez encore validé votre NPML</strong></div>';
		}

		//R14
		if (compteCreditsCursus($_POST['idCursus'])>=180) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits dans votre cursus </strong>'.compteCreditsCursus($_POST['idCursus']).'/180</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits dans votre cursus </strong>'.compteCreditsCursus($_POST['idCursus']).'/180</div>';
		}

		$reussite = round(($reussite/14)*100);

		echo '<div class="page-header">
    			<h4>Progression du cursus</h4>      
  			  </div>';

		echo '<div class="progress">';
		echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$reussite.'" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: '.$reussite.'%;">';
		echo $reussite.'%';
		echo '</div>';
		echo '</div>';		
	}
		

	//Règlement futur
	function R_FUTUR_BR(){
		$reussite=0;

		//R01
		if ((compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus']))>=42) {
		 	echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS+TM de TCBR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus'])).'/42</div>';
		 	$reussite++;
		} 
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS+TM de TCBR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus'])).'/42</div>';
		}

		//R02
		if ((compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))>=18) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS+TM de FCBR </strong>'.(compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/18</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS+TM de FCBR </strong>'.(compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/18</div>';
		}

		//R03
		if ((compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus']))>=24) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS de BR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])).'/24</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS de BR </strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])).'/24</div>';
		}

		//R04
		if ((compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))>=24) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en TM de BR </strong>'.(compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/24</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en TM de BR </strong>'.(compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/24</div>';
		}

		//R05
		if ((compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus']))>=84) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS+TM de BR</strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/84</div>';
			$reussite++;
		}		
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS+TM de BR</strong>'.(compteCreditsRegle('CS','TCBR',$_POST['idCursus'])+compteCreditsRegle('TM','TCBR',$_POST['idCursus'])+compteCreditsRegle('CS','FCBR',$_POST['idCursus'])+compteCreditsRegle('TM','FCBR',$_POST['idCursus'])).'/84</div>';
		}

		//R06
		if (compteCreditsRegle('ST','TCBR',$_POST['idCursus'])>=30) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ST de TCBR </strong>'.compteCreditsRegle('ST','TCBR',$_POST['idCursus']).'/30</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ST de TCBR </strong>'.compteCreditsRegle('ST','TCBR',$_POST['idCursus']).'/30</div>';
		}

		//R07
		if (compteCreditsRegle('ST','FCBR',$_POST['idCursus'])>=30) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ST de FCBR </strong>'.compteCreditsRegle('ST','FCBR',$_POST['idCursus']).'/30</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ST de FCBR </strong>'.compteCreditsRegle('ST','FCBR',$_POST['idCursus']).'/30</div>';
		}

		//R08
		if ((compteCreditsRegle('EC','TCBR',$_POST['idCursus'])+compteCreditsRegle('EC','FCBR',$_POST['idCursus']))>=12) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en EC de BR </strong>'.(compteCreditsRegle('EC','TCBR',$_POST['idCursus'])+compteCreditsRegle('EC','FCBR',$_POST['idCursus'])).'/12</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en EC de BR </strong>'.(compteCreditsRegle('EC','TCBR',$_POST['idCursus'])+compteCreditsRegle('EC','FCBR',$_POST['idCursus'])).'/12</div>';
		}

		//R09
		if ((compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus']))>=4) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ME de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])).'/4</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ME de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])).'/4</div>';	
		}

		//R10
		if ((compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus']))>=4) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CT de BR </strong>'.(compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/4</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CT de BR </strong>'.(compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/4</div>';
		}

		//R11
		if ((compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus']))>=16) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en ME+CT de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/16</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en ME+CT de BR </strong>'.(compteCreditsRegle('ME','TCBR',$_POST['idCursus'])+compteCreditsRegle('CT','TCBR',$_POST['idCursus'])+compteCreditsRegle('ME','FCBR',$_POST['idCursus'])+compteCreditsRegle('CT','FCBR',$_POST['idCursus'])).'/16</div>';	
		}

		//R12
		if ((compteCreditsUTT('CS','TCBR',$_POST['idCursus'])+compteCreditsUTT('TM','TCBR',$_POST['idCursus'])+compteCreditsUTT('CS','FCBR',$_POST['idCursus'])+compteCreditsUTT('TM','FCBR',$_POST['idCursus']))>=60) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits en CS+TM de BR à l'."'UTT</strong>".(compteCreditsUTT('CS','TCBR',$_POST['idCursus'])+compteCreditsUTT('TM','TCBR',$_POST['idCursus'])+compteCreditsUTT('CS','FCBR',$_POST['idCursus'])+compteCreditsUTT('TM','FCBR',$_POST['idCursus'])).'/60</div>';
			$reussite++;
		}		
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits en CS+TM de BR à l'."'UTT</strong>".(compteCreditsUTT('CS','TCBR',$_POST['idCursus'])+compteCreditsUTT('TM','TCBR',$_POST['idCursus'])+compteCreditsUTT('CS','FCBR',$_POST['idCursus'])+compteCreditsUTT('TM','FCBR',$_POST['idCursus'])).'/60</div>';
		}

		//R13
		if (UVexiste('SE',$_POST['idCursus'])) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez validé votre SE</strong></div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Vous devez encore validé votre SE</strong></div>';
		}

		//R14
		if (UVexiste('NPML',$_POST['idCursus'])) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez validé votre NPML</strong></div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Vous devez encore validé votre NPML</strong></div>';
		}


		//R15
		if (compteCreditsCursus($_POST['idCursus'])>=180) {
			echo '<div class="alert alert-success" role="alert"><strong>Bravo ! Vous avez assez de crédits dans votre cursus </strong>'.compteCreditsCursus($_POST['idCursus']).'/180</div>';
			$reussite++;
		}
		else{
			echo '<div class="alert alert-warning" role="alert"><strong>Il manque des crédits dans votre cursus </strong>'.compteCreditsCursus($_POST['idCursus']).'/180</div>';
		}

		$reussite = round(($reussite/15)*100);

		echo '<div class="page-header">
    			<h4>Progression du cursus</h4>      
  			  </div>';

		echo '<div class="progress">';
		echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$reussite.'" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: '.$reussite.'%;">';
		echo $reussite.'%';
		echo '</div>';
		echo '</div>';	
	}
	?>

	<!-- On affiche le règlement dans 2 panels qui peuvent apparaître et disparaître -->
	<div class="panel-group" id="accordion2">
	    <div class="panel panel-default">
	        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseOne2">
	             <h4 class="panel-title">Règlement actuel</h4>
	        </div>
	        <div id="collapseOne2" class="panel-collapse collapse">
	            <div class="panel-body">
	              <?php
	                R_ACTUEL_BR();
	              ?>

	            </div>
	        </div>
	    </div>
	    <div class="panel panel-default">
	        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseTwo2">
	             <h4 class="panel-title">Règlement futur</h4>
	        </div>
	        <div id="collapseTwo2" class="panel-collapse collapse">
	            <div class="panel-body">
	            <?php
	              R_FUTUR_BR();
	            ?>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>