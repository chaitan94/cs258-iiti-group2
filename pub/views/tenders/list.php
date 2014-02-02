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
include 'models/tenders.php';
$ten = new Tender();
$r = $ten->getAll();
echo '<table cellpadding="15">';
foreach ($r as $key => $value) {
	echo '<tr><td>';
	echo $value['name'];
	echo '</td><td><a href="/tenders/'.$value['id'].'"><input class="pure-button" type="button" value="Details"></a></td></tr>';
}
echo '</table>';
?>
</body>
</html>