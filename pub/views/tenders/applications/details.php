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
</main>
</div>
</body>
</html>
