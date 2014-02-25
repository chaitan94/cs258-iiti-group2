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
	<form method="post" action="/tenders/new" class="pure-form pure-form-aligned">
		<legend>New tender</legend>
		<fieldset>
			<div class="pure-control-group"><label>Title</label><input name="title" type="text" required></div>
			<div class="pure-control-group"><label>Brief</label><input name="brief" type="text" required></div>
			<div class="pure-control-group"><label>Start date</label><input name="startdate" type="date" required></div>
			<div class="pure-control-group"><label>Start time</label><input name="starttime" type="time" value="00:00" required></div>
			<div class="pure-control-group"><label>Closing date</label><input name="closedate" type="date" required></div>
			<div class="pure-control-group"><label>Closing time</label><input name="closetime" type="time" value="00:00" required></div>
			<div class="pure-control-group"><label>Category</label><input name="category" type="text" required></div>
			<div class="pure-control-group"><label>NIT</label><input name="NIT" type="file" required></div>
			<div class="pure-control-group"><label>Tender Document</label><input name="tenderdoc" type="file" required></div>
			<div class="pure-controls"><input class="pure-button pure-button-primary" type="submit" value="Confirm and proceed to create form"></div>
		</fieldset>
	</form>
</main>
</div>
</body>
</html>
