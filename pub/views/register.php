<!DOCTYPE html>
<html>
<head>
	<title>E Procurement</title>
	<link rel="stylesheet" type="text/css" href="css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body>
<?php include 'nav.php'; ?>
Register<br>
<form id="reg">
	<input name="user" type="text"><br>
	<!-- <input name="email" type="text"><br>
	<input name="gender" type="text"><br> -->
	<input name="pass" type="password"><br>
	<input type="submit">
</form>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$("#reg").submit(function(e){
	$.ajax({
		url:'/register/new',
		type:'POST',
		data:$(this).serializeArray(),
		success:function(d){if(d)alert(d);}
	});
	return false;
});
</script>
</body>
</html>