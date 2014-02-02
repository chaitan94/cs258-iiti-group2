<?php
if(isset($urlpar[1])){
	if(is_numeric($urlpar[1])){
		$dno = $urlpar[1];
		if(isset($urlpar[2])){
			switch($urlpar[2]){
			case 'apply': 
				include 'views/tenders/apply.php';
				break;
			default:
				header('Location: /tenders/'.$urlpar[1]);
			}
		}else{
			switch ($_SERVER['REQUEST_METHOD']) {
				case 'POST':
					if(isset($_POST['name'])){
						session_start();
						if(isset($_SESSION['id'])){
							echo $_SESSION['id'];
						}
					}
					break;
				case 'GET':
				default:
					include 'views/tenders/details.php';
					break;
			}
		}
	}else{
		switch($urlpar[1]){
			default:
			include('views/tenders/list.php');
		}
	}
}else{
	include('views/tenders/list.php');
}
?>