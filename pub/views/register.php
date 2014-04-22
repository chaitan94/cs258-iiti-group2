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
	<form id="reg" class="pure-form pure-form-aligned">
		<legend>Register</legend><br>
		<fieldset>
			<div class="pure-control-group"><label>Name</label><input name="name" type="text" required></div>
			<div class="pure-control-group"><label>E-mail</label><input name="email" type="email" required></div>
			<div class="pure-control-group"><label>Password</label><input name="pass" type="password" required></div>
			<div class="pure-control-group"><label>Confirm Password</label><input name="confirmpass" type="password" required></div>
			<div class="pure-control-group"><label>Phone number</label><input name="phone" type="text" required></div>
			<div class="pure-control-group">
				<label></label>
				<select name="type" class="pure-input">
					<option value="contractor">Contractor</option>
					<option value="admin">Admin</option>
				</select>
			</div>
			<div class="pure-controls"><input class="pure-button pure-button-primary" type="submit"></div>
		</fieldset>
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
		dataType:'json',
		success:function(d){
			if(!d.success) alert(d.msg);
			else window.open('/','_self');
		}
	});
	return false;
});
</script>
</body>
</html>
