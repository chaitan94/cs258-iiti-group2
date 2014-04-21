<!DOCTYPE html>
<html>
<head>
<?php
include 'views/nav.php';
include 'models/tenders.php';
$ten = new Tender($dno);
?>
	<title>Apply | Tender #<?=$dno?></title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
<div class="not-nav">
<main>
	<form class="pure-form pure-form-aligned" method="POST" action="/tenders/<?=$dno?>">
	<legend>Application for Tender #<?=$ten->id?>: <?=$ten->title?></legend>
		<a href="/tenders/<?=$dno?>">
			<input class="pure-button" type="button" value="Back To Details">
		</a>
		<fieldset>
			<legend>SOQ</legend>
			<table class="pure-table">
			<thead><tr><th>Specification</th><th>Quantity</th><th>EMD</th><th>Bid</th></tr></thead>
			<tbody>
			<?php 
			if($soq = $ten->getSOQ()){
				foreach ($soq as $key => $value) {
					echo "<tr><td>$value->specification</td><td>$value->quantity</td><td>$value->emd</td><td><input type='text' name='soq$key' required></td></tr>";
				};
			}else{
				echo "SOQ unavailable";
			}
			?>
			</tbody>
			</table>
		</fieldset>
		<fieldset>
			<legend>Questionnaire</legend>
			<div id="questionnaire">
			<?php
			if($questionnaire = $ten->getQuestionnaire()){
				foreach ($questionnaire as $key => $value) {
					echo "<div class='question'><h4>$value->question</h4>";
					foreach ($value->options as $k => $v) {
						echo "<input type='radio' name='q$key' value='$k' required> $v->option<br>";
					}
					echo "</div>";
				}
			}else{
				echo "Questionnaire unavailable";
			}
			?>
			</div>
		</fieldset>
		<fieldset>
			<div class="pure-controls"><input type="submit" class="pure-button pure-button-primary"></div>
		</fieldset>
	</form>
</main>
</div>
</body>
</html>
