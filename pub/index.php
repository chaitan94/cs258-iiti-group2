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
	include_once('views/home.php');
	break;
case 'logout':
	if(isset($_SESSION['id'])) unset($_SESSION['id']);
	header('Location: /');
	break;
case 'login':
	include_once('controllers/login.php');
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
case 'debug':
// phpinfo();
	$bkc = 'bkc';
	echo md5($bkc).'<br>';
	echo md5(md5($bkc)).'<br>';
	include_once('vendor/ircmaxell/password-compat/lib/password.php');
	echo password_hash($bkc,PASSWORD_BCRYPT).'<br>';
	echo password_hash(password_hash($bkc,PASSWORD_BCRYPT),PASSWORD_BCRYPT).'<br>';
	// if(password_verify('bkc','$2y$10$.kWwyBroGkIMRhZOvS8Zp.HgjJixOBcy0b2qdH4R3UW0mzWT5Refm')){
	if(password_verify('bkc','$2y$10$5rohTvJbi/SQJjwrwPA2g.2JmHWzXLxbjrXX.1lntTRe4j2XvUAwm')){
		echo ':D';
	}else{
		echo ':(';
	}
	// include_once('models/database.php');
	// $db = new DB();
	// $st = $db->prepare("SELECT id,pass,name FROM users;");
	// $st->execute();
	// while($row=$st->fetch(PDO::FETCH_ASSOC)){
	// 	echo $row['id'].'<br>';
	// 	// $st2 = $db->prepare("UPDATE users SET pass='".$row['name']."' WHERE id='".$row['id']."';");
	// 	$st2 = $db->prepare("UPDATE users SET pass='".password_hash($row['pass'],PASSWORD_BCRYPT)."' WHERE id='".$row['id']."';");
	// 	$st2->execute();
	// }
	// $r = mcrypt_generic(2, $bkc);
	// echo $r;
	// echo '<br>';
	// echo mdecrypt_generic(2, $r);
	break;
case '404':
	echo "404";
	break;
default:
	header('Location: /404');
	break;
}
?>
