<?php
if(isset($urlpar[1])){
	if(is_numeric($urlpar[1])){
		$dno = $urlpar[1];
		if(isset($urlpar[2])){
			switch($urlpar[2]){
			case 'apply': 
				include_once('views/tenders/apply.php');
				break;
			default:
				header('Location: /tenders/'.$urlpar[1]);
			}
		}else{
			switch ($_SERVER['REQUEST_METHOD']) {
				case 'POST':
					if(isset($_POST['name'])){
						if(isset($_SESSION['id'])){
							include_once('models/tender_user.php');
							$tu = new TenderUser();
							$tu->insert($dno,$_SESSION['id']);
						}
					}
				case 'GET':
				default:
					include_once('models/tenders.php');
					$ten = new Tender($dno);
					include_once('views/tenders/details.php');
					break;
			}
		}
	}else{
		switch($urlpar[1]){
			case 'new':
				include_once('models/users.php');
				$user = new User($_SESSION['id']);
				if($user->type=='admin'){
					switch($_SERVER['REQUEST_METHOD']){
						case 'POST':
							include 'models/tenders.php';
							if((new Tender)->insert($_POST)) echo 1;
							else echo 0;
							break;
						case 'GET':
						default:
							include 'models/tenders.php';
							include_once('views/tenders/new.php');
							break;
					}
				}else header('Location: /');
				break;
			case 'approve':
				include_once('models/users.php');
				$user = new User($_SESSION['id']);
				if($user->type=='admin'){
					include_once('views/tenders/approve.php');
				}else header('Location: /');
				break;
			default:
				header('Location: /404');
		}
	}
}else{
	include 'models/tenders.php';
	$ten = new Tender();
	$r = $ten->getAll();
	include_once('views/tenders/list.php');
}
?>
