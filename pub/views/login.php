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
Login<br>
<form id="login">
	<input name="user" type="text"><br>
	<input name="pass" type="password"><br>
	<input type="submit">
</form>
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
				else if(d=='-1') alert('User not registered');
			}
		}
	});
	return false;
});
</script>
</body>
</html>