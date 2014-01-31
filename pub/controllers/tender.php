<?php
if(isset($urlpar[1])){
	$dno = $urlpar[1];
	include 'views/tenders/details.php';
}else{
	header('Location: /tenders');
}
?>