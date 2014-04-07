<!DOCTYPE html>
<html>
<head>
<?php include 'views/nav.php'; ?>
	<title>New | Tender</title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<link rel="stylesheet" type="text/css" href="/css/steps.css">
</head>
<body>
<div class="not-nav">
<main>
	<ul class="steps">
		<li data-id="1" class="selected">General Details</li>
		<li data-id="2">Schedule of Quantity</li>
		<li data-id="3">Essential requirements</li>
	</ul>
	<noscript><b><span style="color:red;">Javascript must be enabled in your browser!</span></b></noscript>
	<form id="newtenform" class="pure-form pure-form-aligned" method="POST" action="/tenders/new" enctype="multipart/form-data" novalidate>
        <?php
        if($completemsg==0){
        ?>
        <div class="step" data-id="1">
			<legend>New tender</legend>
			<fieldset>
				<div class="pure-control-group"><label>Title</label><input name="title" type="text" required></div>
				<div class="pure-control-group"><label>Brief</label><input name="brief" type="text" required></div>
				<div class="pure-control-group"><label>Category</label><input name="category" type="text" required></div>
				<div class="pure-control-group"><label>EMD</label><input name="emd" type="text" required></div>
			</fieldset>
			<fieldset>
				<div class="pure-control-group"><label>Start date</label><input name="startdate" type="date" required></div>
				<div class="pure-control-group"><label>Start time</label><input name="starttime" type="time" value="00:00" required></div>
			</fieldset>
			<fieldset>
				<div class="pure-control-group"><label>Closing date</label><input name="closedate" type="date" required></div>
				<div class="pure-control-group"><label>Closing time</label><input name="closetime" type="time" value="00:00" required></div>
			</fieldset>
			<fieldset>
				<div class="pure-control-group"><label>NIT</label><input name="NIT" type="file" required></div>
				<div class="pure-control-group"><label>Tender Document</label><input name="tenderdoc" type="file" required></div>
				<div class="pure-controls"><input class="pure-button pure-button-primary" type="button" value="Continue" onclick="openstep(2);"></div>
			</fieldset>
		</div>
		<div class="step" data-id="2">
			<legend>Details of the items</legend>
			<fieldset>
				<div class="soq-items">
					<div class="soq-item">
						<legend>Item #1</legend>
						<div class="pure-control-group"><label>Item with Specifications</label><textarea type="text" rows="8" cols="50" required></textarea></div>
						<div class="pure-control-group"><label>Quantity</label><input type="text" required></div>
						<div class="pure-control-group"><label>EMD in INR</label><input type="text" required></div>
					</div>
				</div>
				<input type="hidden" name="itemsjson" id="itemsjson">
				<div class="pure-controls"><input type="button" value="Add another item" class="add-item"></div>
			</fieldset>
			<fieldset>
				<div class="pure-controls"><input class="pure-button pure-button-primary" type="button" value="Continue" onclick="openstep(3);"></div>
			</fieldset>
		</div>
		<div class="step" data-id="3">
			<legend>Questionnaire</legend>
			<fieldset>
				<div class="questionnaire">
				</div>
				<div class="pure-controls"><input type="button" class="add-question" value="Add another question"></div>
				<div class="pure-controls"><input class="pure-button pure-button-primary" type="submit" value="Confirm and proceed to create form"></div>
				<aside id="formmsg"><p></p></aside>
				<input type="hidden" name="questionnairejson" id="questionnairejson">
			</fieldset>
		</div>
        <?php
        }elseif($completemsg==1){
        ?>
		<div class="step" data-id="0">
			<center><div style="margin:50px auto;font-weight:bold;">New tender uploaded successfully!</div></center>
		</div>
        <?php
        }elseif($completemsg==-1){
        ?>
		<div class="step" data-id="0">
			<center><div style="margin:50px auto;color:#900;font-weight:bold;">Error uploading tender!</div></center>
		</div>
        <?php } ?>
	</form>
</main>
</div>
<?php if($completemsg==0){ ?>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/steps.js"></script>
<?php } ?>
</body>
</html>
