<nav class="pure-g">
<div>
	<ul class="pure-u-1">
		<a href="/"><li style="float:left;">E-Procurement</li></a>
		<a href="/tenders"><li style="float:left;">Tender List</li></a>
		<a href="/contact"><li style="float:left;">Contact</li></a>
<?php
if(isset($_SESSION['id'])){
	include_once('models/users.php');
	$user = new User($_SESSION['id']);
?>
		<a href="/logout?redirect_uri=<?=urlencode($_SERVER['REQUEST_URI'])?>"><li style="float:right;">Logout</li></a>
		<a href="/user/<?=$_SESSION['id']?>"><li style="float:right;"><?=$user->name?></li></a>
	<?php if($user->type=='admin'){ ?>
		<a href="/admin"><li style="float:right;">Admin Panel</li></a>
<?php }
}else{ ?>
		<a href="/login?redirect_uri=<?=urlencode($_SERVER['REQUEST_URI'])?>"><li style="float:right;">Login</li></a>
		<a href="/register"><li style="float:right;">Register</li></a>
<?php } ?>
	</ul>
</div>
</nav>
