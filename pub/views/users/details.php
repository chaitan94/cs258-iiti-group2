<!DOCTYPE html>
<html>
<head>
	<title>Details | User #<?=$dno?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<?php include_once('views/nav.php'); ?>
<div class="not-nav">
<main>
	<h3>Details for <?=$user->name?></h3>
	<!-- <a href="/users/<?=$dno?>/edit"> -->
	<!-- <input class="pure-button" type="button" value="Apply"></a> -->
	<h3>Applied for:</h3>
	<?php
	foreach($user->getTenders() as $v){
		echo '<a href="/tenders/'.$v->tenderid.'">'.$v->title.'</a><br>';
	};
	?>
</main>
</div>
</body>
</html>
