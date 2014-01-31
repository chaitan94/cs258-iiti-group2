<?php
if(isset($urlpar[1])){
	switch($urlpar[1]){
	case 'new':
		if(isset($_POST['user'])&&isset($_POST['pass'])){
			include('models/users.php');
			$db = new User();
			$db->insert($_POST['user'],$_POST['pass']);
			echo $_POST['user']." registered.";
		}else header('Location: /register');
		break;
	default: header('Location: /register');
	}
}else{
	include('views/register.php');
}
?>