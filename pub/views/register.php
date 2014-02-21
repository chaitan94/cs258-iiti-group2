<!DOCTYPE html>
<html>
<head>
	<title>E Procurement</title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="not-nav">
<main>
	<form id="reg" class="pure-form">
		<legend>Register</legend><br>
		<label class="pure-radio">
			<input type="radio" name="category" value="contractor" checked>Contractor</input>
			<input type="radio" name="category" value="admin">Admin</input>
		</label>
		<br>
		<!-- <input name="email" type="text"><br>
		<input name="gender" type="text"><br> -->
		<input name="user" type="text"><br><br>
		<input name="pass" type="password"><br><br>
		<input class="pure-button pure-button-primary" type="submit">
	</form>
</main>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$("#reg").submit(function(e){
	$.ajax({
		url:'/users',
		type:'POST',
		data:$(this).serializeArray(),
		success:function(d){if(d)alert(d);}
	});
	return false;
});
</script>
</body>
</html>