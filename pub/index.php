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
case 'login':
case 'register':
	include('controllers/'.$urlpar[0].'.php');
	break;
case 'logout':
	session_start();
	if(isset($_SESSION['user'])) unset($_SESSION['user']);
	header('Location: /');
	break;
case 'tender':
	include('controllers/tender.php');
	break;
case 'tenders':
	include('views/tenders/list.php');
	break;
case 'src':
	include('models/users.php');
	$db = new User();
	// $st=$db->query("CREATE TABLE tenders(id INT NOT NULL,name TEXT);");
	// $st->execute();
	// $st=$db->prepare("INSERT INTO tenders(name) VALUES('Tender no 5');");
	// $st->execute();
	// $st=$db->prepare("INSERT INTO tenders(name) VALUES('Tender no 6');");
	// $st->execute();
	// $st=$db->prepare("INSERT INTO tenders(name) VALUES('Tender numbah 7');");
	// $st->execute();
	// $st=$db->prepare("INSERT INTO tenders(name) VALUES('Another tender (8)');");
	// $st->execute();
	$st=$db->prepare("SELECT * FROM users;");
	$st->execute();
	$res=$st->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($res);
	foreach ($res as $key => $value) {
		foreach ($value as $key => $va) {
			echo $va.' ';
		}
		echo '<br>';
	}
	break;
default:
	header('Location: /');
	break;
}
?>