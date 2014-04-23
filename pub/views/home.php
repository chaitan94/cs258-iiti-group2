<!DOCTYPE html>
<html>
<head>
	<title>E Procurement</title>
	<link rel="stylesheet" type="text/css" href="/css/pure.min.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<link rel="stylesheet" type="text/css" href="/css/home.css">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="not-nav">
<header>
	<div class="banner">
		<h1>E-POCUREMENT SYSTEM</h1>
		<p>FASTER AND SIMPLER PROCUREMENT</p>
	</div>
</header>
<main>
<div class="pure-g">
<div class="pure-u-1">
	<div style="padding: 50px 0 10px 0; text-align:center;">
	Bidding on a tender is very simple
	</div>
</div>
</div>
<div class="pure-g" style="padding: 10px 0 20px 0; text-align:center;">
<div class="pure-u-1-3">
	<div class="homebox">
	Find the tender you want<br>in the tender list
	</div>
</div>
<div class="pure-u-1-3">
	<div class="homebox">
	Fill in your SOQ bids<br>and a small Questionnaire
	</div>
</div>
<div class="pure-u-1-3">
	<div class="homebox">
	Wait for approval
	</div>
</div>
<div class="pure-u-1" style="margin:50px 0;">
<form class="pure-form" method="get" action="/tenders">
	<fieldset>
		<input type="text" style="padding:10px;width:250px;" name="s" placeholder="Find your tender..">
		<input type="submit" class="pure-button pure-button-primary" value="Find tenders">
	</fieldset>
</form>
</div>
</div>
<div class="pure-g" style="margin:100px 0;">
<div class="pure-u-1-2 left">
	<div class="homeupdates">
		<div class="subtitle">News</div>
		<div class="updates-items">
			<div class="updates-item">Tenders above 30 lakhs now available in the site</div>
			<div class="updates-item">Website might be down today due to maintenance</div>
			<div class="updates-item">E Procurement site functional</div>
		</div>
	</div>
</div>
<div class="pure-u-1-2 right">
	<div class="homeupdates">
		<div class="subtitle">Quick Links</div>
		<div class="updates-items">
		<a href="/tenders"><div class="updates-item">Tender List</div></a>
		<a href="/contact"><div class="updates-item">Contact</div></a>
		</div>
	</div>
</div>
<div class="clearfix"></div>
</div>
</main>
<footer>
<div>
	<div>
		<img src="img/iiti_logo_grey.png" alt="IIT Indore">
	</div>
	<div>
		Built for IIT Indore | 2014
	</div>
</div>
</footer>
</div>
</body>
</html>
