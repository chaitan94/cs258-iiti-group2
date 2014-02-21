<?php
if(isset($urlpar[1])){
	if(is_numeric($urlpar[1])){
		$dno = $urlpar[1];
		include_once('views/users/details.php');
	}
}else{
	switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			if(isset($_POST['name'])&&isset($_POST['confirmpass'])&&isset($_POST['pass'])&&isset($_POST['email'])&&isset($_POST['type'])&&isset($_POST['phone'])){
				include('models/users.php');
				if($_POST['pass']==$_POST['confirmpass']){
					$db = new User();
					$db->insert($_POST);
					echo $_POST['email']." registered.";
				}else
					echo 'Passwords do not match!';
			}else echo 'All details necessary';
			break;
		case 'GET':
		default:
			include('models/users.php');
			$db = new User();
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