<?php
if(isset($urlpar[1])){
	switch($urlpar[1]){
	case 'verify':
		if(isset($_POST['email'])&&isset($_POST['pass'])){
			include('models/users.php');
			$db = new User();
			echo $db->verify($_POST['email'],$_POST['pass']);
		}else header('Location: /login');
		break;
	default: header('Location: /login');
	}
}else{
	unset($_SESSION['id']);
	include('views/login.php');
}
?>
