<?php
// Remove trailing slash from end of URL 
if(substr($_SERVER['REQUEST_URI'],-1)=='/'){
	header('Location: '.substr($_SERVER['REQUEST_URI'],0,-1));
}

// To store parameters from URL
$urlpar = $_SERVER['REQUEST_URI'];

// Strip the part of url after ?, if any
if($acurl = stripos($urlpar,'?')) $urlpar = substr($urlpar,0,$acurl);

// Split URL with slashes
$urlpar = explode('/',substr($urlpar,1));
set_include_path(get_include_path() . PATH_SEPARATOR .realpath('./'));
session_start();

// Switch according to first parameter in URL
switch ($urlpar[0]) {
case '':
case '/':
	include_once('views/home.php');
	break;
case 'logout':
	session_destroy();
	if(isset($_GET['redirect_uri']))
		header('Location: '.urldecode($_GET['redirect_uri']));
	else header('Location: /');
	break;
case 'login':
	include_once('controllers/login.php');
	break;
case 'contact':
	include_once('controllers/contact.php');
	break;
case 'register':
	if(isset($_SESSION['id'])) header('Location: /');
	else include_once('views/register.php');
	break;
case 'tender':
case 'tenders':
	include_once('controllers/tender.php');
	break;
case 'user':
case 'users':
	include_once('controllers/user.php');
	break;
case 'admin':
	include_once('controllers/admin.php');
	break;
// Use this for testing purposes
// Put any of your test codes in dbg folder.
// It wont be commited to github as the folder is in gitignore
case 'debug':
	include_once('dbg/index.php');
	break;
case '404':
	echo "404";
	break;
default:
	header('Location: /404');
	break;
}
?>
