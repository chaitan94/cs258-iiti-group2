<!DOCTYPE html>
<html>
<head>
<style type="text/css">
.row {
	vertical-align: top;
	height: auto !important;
}
.list {
	display: none;
}
.show {
	display: none;
}
.hide:target+.show {
	display: inline;
}
.hide:target {
	display: none;
}
.hide:target  ~ .list {
	display: inline;
}
.link {
	color: #321212;
}
@media print {
	.hide,.show {
		display: none;
	}
}
</style>

<?php include 'views/nav.php';
include 'models/tenders.php'; $i=0;?>
	<title>Approve | Tender</title>
<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<div class="not-nav">
<main>
<ul>	
<?php $tender= new Tender();
$r= $tender->getTendersByOwner($_SESSION['id']);?>
<?php foreach ($r as $key => $value):?>
<p>
	<p>
		<li><a href='#' ><?php echo 'Tender Document for '.$value->title;$i++;?></a></li>
		<?php echo '&nbsp&nbspClosing date:';?> 
	</p>
	<div class="row">
		<a href="<?php echo'#hide'.$i?>" class="hide" id="<?php echo'hide'.$i?>"><font class="link">View applications</font></a>
		<a href="<?php echo'#show'.$i?>" class="show" id="<?php echo'show'.$i?>"><font class="link">Hide Aplications</font></a>
		<div class="list">
			<ul>
			<?php $item = new Tender($value->id);
			$tender_applicants = $item->getApplicants();
			$no_applicants = count($tender_applicants);

			while($no_applicants > 0){
				echo '<li><a href="/user/'.$tender_applicants[$no_applicants-1]->userid.'">'.$tender_applicants[$no_applicants-1]->name.'</a> - <a href="/tenders/applications/'.$tender_applicants[$no_applicants-1]->id.'">View Application</a></li>';
				$no_applicants--;
			} ?>
			</ul><br>
		</div>
	</div>
</p>
<?php endforeach;?>
</ul>
</main>
</div>
</body>
</html>

