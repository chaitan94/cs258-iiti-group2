<!DOCTYPE html>
<html>
<head>
	<title>Details | User #<?=$u->id?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<?php include_once('views/nav.php'); ?>
<div class="not-nav">
<main>
	<h3>Details for <?=$u->name?></h3>
	<h3>Applied for:</h3>
	<table style="width:100%;" class="pure-table">
	<thead>
		<tr><th>Tender No</th><th>Tender Title</th><th></th><th></th></tr>
	</thead>
	<tbody>
	<?php
	foreach($u->getTenders() as $v){
		echo "<tr><td>$v->tenderid</td><td>$v->title</td><td><a href='/tenders/applications/$v->id'><input type='button' value='View application details'></a></td><td><a href='/tenders/$v->tenderid'><input type='button' value='View tender details'></a></td></tr>";
	}
	?>
	</tbody>
	</table>
</main>
</div>
</body>
</html>
