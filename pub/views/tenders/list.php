<!DOCTYPE html>
<html>
<head>
	<title>Tender List</title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<link rel="stylesheet" type="text/css" href="/css/tender.css">
</head>
<body>
<?php
	include 'views/nav.php';
?>
<div class="not-nav">
<main>
	<h1>Tenders list</h1>
	<div class="tender-search-bar"><form><span>Search:</span><input type="text" name="s"><input type="submit" value="Go"></form></div>
<?php if($searching){ ?>
	<div class="tender-search-bar"><span><u>Showing results for:</u> <?=$_GET['s']?></span><a href='/tenders'><input type="button" value="View all"></a></div>
<?php } ?>
	<table style="width:100%;" class="pure-table tenderlist">
	<thead>
		<tr><th style="width:4%;">#</th><th style="width:40%;">Title</th><th style="width:40%;">EMD</th><th style="width:16%;"></th></tr>
	</thead>
	<tbody>
	<?php
	foreach ($r as $key => $value) {
		echo "<tr><td>$value->id</td><td>$value->title</td><td>$value->emd</td><td><a href='/tenders/$value->id'><input class='pure-button' type='button' value='Details'></a></td></tr>";
	}
	?>
	</tbody>
	</table>
	<?php if(!$searching){ ?>
	<div class="tender-search-bar"><span>Go to page:</span>
		<?php 
		$n = ceil($count/$countperpage);
		for ($i=1; $i <= $n; $i++) { 
			echo '<a href="/tenders?p='.$i.'">'.$i.'</a> ';
		}
		?>
	</div>
	<?php } ?>
</main>
</div>
</body>
</html>
