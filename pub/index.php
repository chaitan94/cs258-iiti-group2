<?php
if(substr($_SERVER['REQUEST_URI'],-1)=='/'){
	header('Location: '.substr($_SERVER['REQUEST_URI'],0,-1));
}
$urlpar = explode('/',substr($_SERVER['REQUEST_URI'],1));
switch ($urlpar[0]) {
case '':
case '/':
	include('views/home.php');
	break;
case 'logout':
	session_start();
	if(isset($_SESSION['id'])) unset($_SESSION['id']);
	header('Location: /');
	break;
case 'login':
	include('controllers/login.php');
	break;
case 'register':
	include('views/register.php');
	break;
case 'tender':
case 'tenders':
	include('controllers/tender.php');
	break;
case 'user':
case 'users':
	include('controllers/user.php');
	break;
case 'src':
	echo file_get_contents("http://127.0.0.6");
	break;
default:
	header('Location: /');
	break;
}
?>