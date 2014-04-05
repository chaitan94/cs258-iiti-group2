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
                    $completemsg=0;
					switch($_SERVER['REQUEST_METHOD']){
						case 'POST':
							include_once('models/tenders.php');
							if((new Tender)->insert($_POST,$_FILES)) $completemsg = 1;
							else $completemsg = -1;
						case 'GET':
						default:
							include_once('models/tenders.php');
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
			case 'applications':
				include_once('models/tender_user.php');
				if(is_numeric($urlpar[2])){
					$apl = new TenderUser($urlpar[2]);
					if($apl->id){
						include_once('views/tenders/applications/details.php');
					}else header('Location: /');
				}else header('Location: /');
				break;
			default:
				header('Location: /404');
		}
	}
}else{
	include 'models/tenders.php';
	$ten = new Tender();
	$searching=false;
	$r;
	if(isset($_GET['s'])){
		$searching = true;
		$terms = explode(' ',$_GET['s']);
		$r = $ten->getSearchResults($terms);
	} else {
		$page = 1;
		$countperpage = 10;
		$count = $ten->getCount();
		if(isset($_GET['p'])){ $page = $_GET['p']; }
		$r = $ten->getRecent($countperpage,($page-1)*$countperpage);
	}
	include_once('views/tenders/list.php');
}
?>
