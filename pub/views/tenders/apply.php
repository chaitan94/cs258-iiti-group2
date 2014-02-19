<!DOCTYPE html>
<html>
<head>
<?php
include 'views/nav.php';
include 'models/tenders.php';
$ten = new Tender($dno);
?>
	<title>Apply | Tender #<?=$dno?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<div class="not-nav">
<main>
	<h3>Application for <?=$ten->name?></h3>
	<a href="/tenders/<?=$dno?>">
		<input class="pure-button" type="button" value="Back To Details">
	</a>
	<form method="POST" action="/tenders/<?=$dno?>" class="pure-form">
		<input type="text" placeholder="Name" name="name"><br>
		<input type="submit" class="pure-button pure-button-primary"><br>
	</form>
</main>
</div>
</body>
</html>