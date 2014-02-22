<?php
include_once('models/users.php');
$user = new User($_SESSION['id']);
if($user->type=='admin'){
?>
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
	<h3>Admin Panel</h3>
	<hr/>
	<a href="/tender/new" class="pure-button">Upload new tender</a>
</main>
</div>
</body>
</html>
<?php } ?>
