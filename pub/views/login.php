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
	<form id="login" class="pure-form pure-form-aligned">
		<legend>Login</legend>
		<fieldset>
			<div class="pure-control-group"><label>E-mail</label><input name="email" placeholder="E-mail" type="text"></div>
			<div class="pure-control-group"><label>Password</label><input name="pass" placeholder="Password" type="password"></div>
			<div class="pure-controls"><input class="pure-button pure-button-primary" type="submit"></div>
		</fieldset>
	</form>
</main>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$("#login").submit(function(e){
	$.ajax({
		url:'/login/verify',
		type:'POST',
		data:$(this).serializeArray(),
		success:function(d){
			if(d){
				if(d=='1') window.open('/','_self');
				else if(d=='0') alert('Username/Password wrong');
				else if(d=='-1') alert('E-mail not registered');
			}
		}
	});
	return false;
});
</script>
</body>
</html>