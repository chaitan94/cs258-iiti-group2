<!DOCTYPE html>
<html>
<head>
<?php
include_once('views/nav.php');
?>
	<title>Details | Tender #<?=$dno?></title>
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
if($soq = $apl->getSOQResponse()){
	foreach ($soq as $key => $value) {
		echo $value;
	};
}else{
	echo "SOQ unavailable";
}
?>
<h4>Questionnaire Response:</h4>
<?php } ?>
</main>
</div>
</body>
</html>
