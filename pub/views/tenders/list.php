<!DOCTYPE html>
<html>
<head>
	<title>Tender List</title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<link rel="stylesheet" type="text/css" href="/css/tender.css">
</head>
<body>
<?php
	include 'views/nav.php';
?>
<div class="not-nav">
<main>
	<table style="width:100%;" class="pure-table tenderlist">
	<thead>
		<tr><th style="width:40%;">Title</th><th style="width:40%;">EMD</th><th style="width:20%;"></th></tr>
	</thead>
	<tbody>
	<?php
	foreach ($r as $key => $value) {
		echo '<tr><td>'.$value->title.'</td><td>'.$value->emd.'</td><td><a href="/tenders/'.$value->id.'"><input class="pure-button" type="button" value="Details"></a></td></tr>';
	}
	?>
	</tbody>
	</table>
</main>
</div>
</body>
</html>