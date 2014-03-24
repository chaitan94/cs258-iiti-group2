<?php
if(isset($urlpar[1])){
	if(is_numeric($urlpar[1])){
		include_once('models/users.php');
		$u = new User($urlpar[1]);
		if($u->id) include_once('views/users/details.php');
		else header('Location: /');
	}
}else{
	switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			if(isset($_POST['name'])&&isset($_POST['confirmpass'])&&isset($_POST['pass'])&&isset($_POST['email'])&&isset($_POST['type'])&&isset($_POST['phone'])){
				include('models/users.php');
				if($_POST['pass']==$_POST['confirmpass']){
					$db = new User();
					$status = $db->insert($_POST);
					if($status==1) echo $_POST['email']." registered.";
					else if($status==-1) echo $_POST['email']." already registered.";
					else echo "Error while registering!";
				}else
					echo 'Passwords do not match!';
			}else echo 'All details necessary';
			break;
		case 'GET':
		default:
			include('models/users.php');
			$db = new User();
			$st=$db->db->prepare("SELECT * FROM users;");
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
