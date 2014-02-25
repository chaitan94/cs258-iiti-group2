<!DOCTYPE html>
<html>
<head>
	<title>Tender List</title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<?php
	include 'views/nav.php';
?>
<div class="not-nav">
<main>
	<table cellpadding="15">
	<?php
	foreach ($r as $key => $value) {
		echo '<tr><td>'.$value->title.'</td><td><a href="/tenders/'.$value->id.'"><input class="pure-button" type="button" value="Details"></a></td></tr>';
	}
	?>
	</table>
</main>
</div>
</body>
</html>