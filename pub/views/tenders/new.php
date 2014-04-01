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
	<form id="newtenform" class="pure-form pure-form-aligned" method="POST" action="/tenders/new" enctype="multipart/form-data">
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
				<div class="pure-controls"><input type="button" value="Add another item" onclick="add_item();"></div>
				<div class="pure-controls"><input type="submit" value="Save details for the current item" name="submit"></div>
			</fieldset>
			<fieldset>
				<div class="pure-controls"><input class="pure-button pure-button-primary" type="button" value="Continue" onclick="openstep(3);"></div>
			</fieldset>
		</div>
		<div class="step" data-id="3">
			<legend>New tender</legend>
			<fieldset>
				<div class="pure-controls"><input class="pure-button pure-button-primary" type="submit" value="Confirm and proceed to create form"></div>
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
<script type="text/javascript">
var curstep = 1;
var item_no = 1;
var add_item = function(){
	item_no++;
	$(".soq-items").append('<div class="soq-item"><legend>Item #'+item_no+'</legend>\
					<div class="pure-control-group"><label>Item with Specifications</label><textarea type="text" rows="8" cols="50" required></textarea></div>\
					<div class="pure-control-group"><label>Quantity</label><input type="text" required></div>\
					<div class="pure-control-group"><label>EMD in INR</label><input type="text" required></div>\
					<div class="pure-controls"><input type="button" class="soq-remove" value="Remove this item";"></div>\
				</div>');
	$('.soq-remove').click(function(){
		item_no--;
		var p = $(this).parent().parent();
		p.slideUp(300,function(){
			p.remove();
			var items = $('.soq-item');
			for (var i = 0; i < items.length; i++) {
				$(items[i]).children('legend').html('Item #'+(i+1));
			};
		});
	});
}
var openstep = function(n){
	$(".step").fadeOut(200).promise().done(function(){
		$(".step[data-id="+n+"]").fadeIn(200);
	});
	$(".steps li").removeClass('selected');
	$(".steps li[data-id="+n+"]").addClass('selected');
}
$(".steps li").click(function(){
	openstep($(this).data("id"));
});
openstep(1);
$("#newtenform").submit(function(e){
	for (var i = $("#newtenform *[required]").length - 1; i >= 0; i--) {
		if(!$($("#newtenform *[required]")[i]).val()){
			alert("Please Enter all details.");
			return false;
		}
	};
});
</script>
<? } ?>
</body>
</html>
