<!DOCTYPE html>
<html>
<head>
	<title>E Procurement</title>
	<link rel="stylesheet" type="text/css" href="css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body>
<?php
include 'views/nav.php';
include 'models/tenders.php';
$ten = new Tender($dno);
?>
<h3>Details for <?=$ten->name?></h3>
</body>
</html>