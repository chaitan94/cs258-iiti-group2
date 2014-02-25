<!DOCTYPE html>
<html>
<head>
<?php
include_once('views/nav.php');
?>
	<title>Details | Tender #<?=$dno?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<div class="not-nav">
<main>
	<h3>Details for <?=$ten->title?></h3>
	<?php
		if(isset($_SESSION['id'])){
			if($ten->isAppliedBy($_SESSION['id'])){
	?>
	<input class="pure-button" type="submit" value="Remove Application"><!--Doesn't work yet-->
	<?php 	}else{ ?>
	<a href="/tenders/<?=$dno?>/apply">
	<input class="pure-button" type="button" value="Apply"></a>
	<?php 	} ?>
	<?php
		}else{
	?><input class="pure-button" type="button" value="Login to Apply" disabled>
	<?php
		}
	?>
	<h3>Applicants:</h3>
	<?php
	// var_dump($ten->getApplicants())
	foreach($ten->getApplicants() as $v){
		echo '<a href="/users/'.$v->userid.'">'.$v->name.'</a><br>';
	};
	?>
</main>
</div>
</body>
</html>