<!DOCTYPE html>
<html>
<head>
<?php include 'views/nav.php';
include 'models/tenders.php'; $i=0;?>
	<title>Approve | Tender</title>
<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
<link rel="stylesheet" type="text/css" href="/css/base.css">
<link rel="stylesheet" type="text/css" href="/css/tender-approve.css">
</head>
<body>
<div class="not-nav">
<main>
<div class="tender-applications">
<?php
$tender= new Tender();
$r= $tender->getTendersByOwner($_SESSION['id']);
foreach ($r as $key => $value){ 
	$i++;
?> 
	<div class="tender-application">
		<a href="#"><div class="title">Tender #<?=$value->id?>: <?=$value->title?></div></a>
		Closing date:
		<div class="row">
		<?php 
			$item = new Tender($value->id);
			$tender_applicants = $item->getApplicants();
			$no_applicants = count($tender_applicants);
		?>
			<a href="#hide<?=$i?>" class="hide" id="hide<?=$i?>"><font class="link">View applications (<?=$no_applicants?>)</font></a>
			<a href="#show<?=$i?>" class="show" id="show<?=$i?>"><font class="link">Hide Aplications</font></a>
			<div class="list">
				<ul>

				<?php
				while($no_applicants > 0){
					echo '<li><a href="/user/'.$tender_applicants[$no_applicants-1]->userid.'">'.$tender_applicants[$no_applicants-1]->name.'</a> - <a href="/tenders/applications/'.$tender_applicants[$no_applicants-1]->id.'">View Application</a></li>';
					$no_applicants--;
				} ?>
				</ul><br>
			</div>
		</div>
	</div>
<?php } ?>
</div>
</main>
</div>
</body>
</html>

