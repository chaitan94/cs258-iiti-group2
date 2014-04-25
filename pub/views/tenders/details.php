<!DOCTYPE html>
<html>
<head>
<?php
include_once('views/nav.php');
?>
	<title>Details | Tender #<?=$ten->id?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<link rel="stylesheet" type="text/css" href="/css/tender.css">
</head>
<body>
<div class="not-nav">
<main>
	<h3>Details for <?=$ten->title?></h3>
	<div class="pure-g">
		<div class="pure-u-1-2">
			<div class="tenderdoc">
				<table class="pure-table">
					<thead>
					</thead>
					<tbody>
					<tr><td>Brief</td><td><?=$ten->brief?></td></tr>
					<tr class="pure-table-odd"><td>EMD</td><td><?=$ten->emd?></td></tr>
					<tr><td>Start</td><td><?=$ten->starttime?>, <?=$ten->startdate?></td></tr>
					<tr class="pure-table-odd"><td>Close</td><td><?=$ten->closetime?>, <?=$ten->closedate?></td></tr>
						<tr><th colspan="2">Tender Documents</th></tr>
						<tr><td>NIT</td><td>
						<?php 
							if(file_exists("data/tenders/$ten->id/NIT.pdf")){
								echo "<a href='/data/tenders/$ten->id/NIT.pdf' download><input type='button' class='pure-button' value='Download'></a>";
							}else echo "unavailable"; 
						?>
						</td></tr>
						<tr><td>Tender Document</td><td>
						<?php 
							if(file_exists("data/tenders/$ten->id/tenderdoc.pdf")){
								echo "<a href='/data/tenders/$ten->id/tenderdoc.pdf' download><input type='button' class='pure-button' value='Download'></a>";
							}else echo "unavailable"; 
						?>
						</td></tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="pure-u-1-2">
			<div class="tenderdoc">
			<?php
				if(file_exists("data/tenders/$ten->id/soq.json")){
					$soq = fopen("data/tenders/$ten->id/soq.json","r");
					$soqdata = json_decode(fread($soq,200));
			?>
				<table class="pure-table">
					<thead>
						<tr><th colspan="3">SOQ</th></tr>
					</thead>
					<tbody>
					<?php 
						foreach ($soqdata as $key => $value) {
							echo "<tr><td>$value->specification</td><td>$value->quantity</td><td>$value->emd</td></tr>";
						}
					?>
					</tbody>
				</table>
			<?php }else echo "SOQ unavailable"; ?>
			</div>
		</div>
	</div>
	<?php
		if(isset($_SESSION['id'])){
			if($ten->isAppliedBy($_SESSION['id'])){
	?>
	<input class="pure-button" type="submit" value="Already applied" disabled><!--Doesn't work yet-->
	<?php 	}else{ ?>
	<a href="/tenders/<?=$ten->id?>/apply">
	<input class="pure-button" type="button" value="Apply"></a>
	<?php 	} ?>
	<?php
		}else{
	?><input class="pure-button" type="button" value="Login to Apply" disabled>
	<?php
		}
	?>
	<h3>Applicants:</h3>
	<?php
	$applicants = $ten->getApplicants();
	if($applicants){
		foreach($applicants as $v){
			echo '<a href="/users/'.$v->userid.'">'.$v->name.'</a><br>';
		};
	}else echo 'None.'; 
	?>
</main>
</div>
</body>
</html>
