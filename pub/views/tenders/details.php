<!DOCTYPE html>
<html>
<head>
<?php
include 'views/nav.php';
include 'models/tenders.php';
$ten = new Tender($dno);
?>
	<title>Details | Tender #<?=$dno?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<h3>Details for <?=$ten->name?></h3>
<a href="/tenders/<?=$dno?>/apply">
<input class="pure-button" type="button" value="Apply"></a>
</body>
</html>