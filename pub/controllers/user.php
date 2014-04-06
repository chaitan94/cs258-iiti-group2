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
				$response = new stdClass();
				$response->success=false;
				if($_POST['pass']==$_POST['confirmpass']){
					$db = new User();
					$status = $db->insert($_POST);
					if($status==0) $response->msg = 'Error while registering!';
					else if($status==-1) $response->msg = $_POST['email'].' already registered.';
					else if($status<0) $response->msg = 'Something went wrong!';
					else{
						$response->success = true;
						$_SESSION['id']=$status;
					}
				}else $response->msg = 'Passwords do not match!';
			}else $response->msg = 'All details necessary';
			echo(json_encode($response));
			break;
	}
}
?>
