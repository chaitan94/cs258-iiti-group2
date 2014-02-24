<!DOCTYPE html>
<html>
<head>
<?php
include 'views/nav.php';
?>
	<title>New | Tender</title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<div class="not-nav">
<main>
	<form class="pure-form pure-form-aligned">
		<legend>New tender</legend>
		<fieldset>
			<div class="pure-control-group"><label>Tender pdf</label><input type="file"></div>
			<div class="pure-control-group"><label>Tender Name</label><input type="text"></div>
			<div class="pure-control-group"><label>Closing date</label><input type="date"></div>
			<div class="pure-control-group"><label>Closing time</label><input type="time" value="00:00"></div>
			<div class="pure-control-group"><label>Category</label><input type="text"></div>
			<div class="pure-control-group"><label>Brief</label><input type="text"></div>
			<div class="pure-controls"><input class="pure-button pure-button-primary" type="submit" value="Confirm and proceed to create form"></div>
		</fieldset>
	</form>
</main>
</div>
</body>
</html>
