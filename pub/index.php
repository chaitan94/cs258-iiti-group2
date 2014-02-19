<?php
if(substr($_SERVER['REQUEST_URI'],-1)=='/'){
	header('Location: '.substr($_SERVER['REQUEST_URI'],0,-1));
}
$urlpar = $_SERVER['REQUEST_URI'];
if($acurl = stripos($urlpar,'?'))$urlpar = substr($urlpar,0,$acurl);
$urlpar = explode('/',substr($urlpar,1));
set_include_path(get_include_path() . PATH_SEPARATOR .realpath('./'));
session_start();
switch ($urlpar[0]) {
case '':
case '/':
	include('views/home.php');
	break;
case 'logout':
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
	echo file_get_contents("http://google.com");
	break;
case '404':
	echo "404";
	break;
default:
	header('Location: /404');
	break;
}
?>