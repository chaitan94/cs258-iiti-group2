<!DOCTYPE html>
<html>
<head>
<?php include 'views/nav.php';
include 'models/tenders.php'; $i=0;?>
	<title>Approve | Tender</title>
<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
<link rel="stylesheet" type="text/css" href="/css/base.css">
<link rel="stylesheet" type="text/css" href="/css/tender-approve.css">
<script type="text/javascript">

function func(no,id)
{
	if(no==0)
		{
		document.getElementById('show'+id).style.display='inline'; 
		document.getElementById('hide'+id).style.display='none';
		document.getElementById('list'+id).style.display='inline';
		}
	else
		{
		document.getElementById('hide'+id).style.display='inline';
		document.getElementById('show'+id).style.display='none';
		document.getElementById('list'+id).style.display='none';
		}
		
}


</script>
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
		<div class="row">
		Closing date: <?=$value->closedate?><br>
		Closing time: <?=$value->closetime?><br>
		<?php 
			$item = new Tender($value->id);
			$tender_applicants = $item->getApplicants();
			$no_applicants = sizeof($tender_applicants);
			if($no_applicants){
		?>	<br>
			<p  class="hide" id="hide<?=$i?>"  onclick="func(0,<?=$i?>);"><button class="pure-button pure-button-primary">View <?=$no_applicants?> Applications</button></p>
			<p class="show" id="show<?=$i?>"  onclick="func(1,<?=$i?>);"><button class="pure-button pure-button-primary">Hide <?=$no_applicants?> Applications</button></p>
			<div id="list<?=$i?>" style="display:none"
			>
				<table class="pure-table">
					<thead><tr><th>User</th><th>Marks gained</th><th></th></tr></thead>
					<tbody>
				<?php
				for($i = 0; $i < $no_applicants; $i++){
					echo '<tr><td><a href="/user/'.$tender_applicants[$i]->userid.'">'.$tender_applicants[$i]->name.'</a></td><td>'.$tender_applicants[$i]->score.'</td><td><a href="/tenders/applications/'.$tender_applicants[$i]->id.'"><button>View Application</button></a></td></tr>';
				} ?>
					</tbody>
				</table>
			</div>
			<?php }else echo '0 Applications.'; ?>
		</div>
	</div>
<?php } ?>
</div>
</main>
</div>
</body>
</html>
