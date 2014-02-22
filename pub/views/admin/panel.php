<!DOCTYPE html>
<html>
<head>
	<title>Admin | User #<?=$_SESSION['id']?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<?php include_once('views/nav.php'); ?>
<div class="not-nav">
<main>
	<h3><?=$user->name?></h3>
	<h4>Admin Panel</h4>
	<hr/>
	<br>
	<a href="/tender/new" class="pure-button pure-button-primary">Upload new tender</a><br><br>
	<a href="/tender/new" class="pure-button pure-button-primary">View and approve new tender applications</a><br>
</main>
</div>
</body>
</html>
