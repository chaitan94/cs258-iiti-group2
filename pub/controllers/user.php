<?php
if(isset($urlpar[1])){
	if(is_numeric($urlpar[1])){
		$dno = $urlpar[1];
		include_once('views/users/details.php');
	}
}else{
	switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			if(isset($_POST['user'])&&isset($_POST['pass'])){
				include('models/users.php');
				$db = new User();
				$db->insert($_POST['user'],$_POST['pass']);
				echo $_POST['user']." registered.";
			}else header('Location: /register');
			break;
		case 'PUT':
			break;
		case 'DELETE':
			break;
		case 'GET':
		default:
			include('models/users.php');
			$db = new User();
			// $st=$db->query("CREATE TABLE tenders(id INT NOT NULL,name TEXT);");
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
	}
}
?>