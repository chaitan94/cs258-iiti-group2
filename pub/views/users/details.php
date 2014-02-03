<!DOCTYPE html>
<html>
<head>
<?php
include_once('views/nav.php');
include_once('models/users.php');
$user = new User($dno);
?>
	<title>Details | User #<?=$dno?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<h3>Details for <?=$user->name?></h3>
<!-- <a href="/users/<?=$dno?>/edit"> -->
<!-- <input class="pure-button" type="button" value="Apply"></a> -->
<h3>Applied for:</h3>
<?php
foreach($user->getTenders() as $v){
	echo '<a href="/tenders/'.$v['tenderid'].'">'.$v['name'].'</a><br>';
};
?>
</body>
</html>