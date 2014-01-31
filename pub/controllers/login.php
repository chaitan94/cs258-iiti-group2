<?php
if(isset($urlpar[1])){
	switch($urlpar[1]){
	case 'verify':
		if(isset($_POST['user'])&&isset($_POST['pass'])){
			include('models/users.php');
			$db = new User();
			echo $db->verify($_POST['user'],$_POST['pass']);
		}else header('Location: /login');
		break;
	default: header('Location: /login');
	}
}else{
	include('views/login.php');
}
?>