<?php
include_once('models/users.php');
$user = new User($_SESSION['id']);
if($user->type=='admin'){
	include_once('views/admin/panel.php');
}else header('Location: /');
?>
