<!DOCTYPE html>
<html>
<head>
<?php
include_once('views/nav.php');
?>
	<title>Details | Tender #<?=$apl->id?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<link rel="stylesheet" type="text/css" href="/css/tender.css">
</head>
<body>
<div class="not-nav">
<main>
	<h3>Details for Tender Application #<?=$apl->id?></h3>
<?php
	$user = $apl->getUserDetails(); 
	$tender = $apl->getTenderDetails();
?>
	Applicant: <?=$user->name?><br>
	Tender Title: <?=$tender->title?><br>
<?php if($unrestricted){ ?>
	<h3>Detailed details: [Visible only to you and admins]</h3>
	<h4>SOQ Response:</h4>
	<?php 
	if($soq = $ten->getSOQ()){
		if($soqres = $apl->getSOQResponse()){
			$n = sizeof($soqres);
			echo '<table class="pure-table"><thead><tr><th>Specification</th><th>Bid</th></tr></thead><tbody>';
			for($i = 0; $i < $n; $i++) {
				echo '<tr><td>'.$soq[$i]->specification.'</td><td>'.$soqres[$i].'</td></tr>';
			};
			echo '</tbody></table>';
		}else{
			echo "SOQ Response unavailable";
		}
	}else{
		echo "SOQ unavailable";
	}
	?>
	<h4>Questionnaire Response:</h4>
	<?php 
	if($soq = $ten->getQuestionnaire()){
		if($soqres = $apl->getQuestionnaireResponse()){
			$n = sizeof($soqres);
			echo '<table class="pure-table"><thead><tr><th>Question</th><th>Answer</th><th>Marks gained</th></tr></thead><tbody>';
			for($i = 0; $i < $n; $i++) {
				$optionselected = $soq[$i]->options[$soqres[$i]];
				echo '<tr><td>'.$soq[$i]->question.'</td><td>'.$optionselected->option.'</td><td>'.$optionselected->marks.'</td></tr>';
			};
			echo '</tbody></table>';
			echo 'Total marks: '.$apl->score;
		}else{
			echo "Questionnaire Response unavailable";
		}
	}else{
		echo "Questionnaire unavailable";
	}
} ?>
</main>
</div>
</body>
</html>
