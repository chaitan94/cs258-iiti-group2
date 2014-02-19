<nav class="pure-g">
<div>
	<ul class="pure-u-1">
		<a href="/"><li style="float:left;">E-Procurement</li></a>
		<a href="/tenders"><li style="float:left;">Tender List</li></a>
		<?php
		if(isset($_SESSION['id'])){
			include_once('models/users.php');
			$user = new User($_SESSION['id']);
		?>
		<a href="/logout"><li style="float:right;">Logout</li></a>
		<a href="/user/<?=$_SESSION['id']?>"><li style="float:right;"><?=$user->name?></li></a>
		<?php }else{ ?>
		<a href="/login"><li style="float:right;">Login</li></a>
		<a href="/register"><li style="float:right;">Register</li></a>
		<?php } ?>
	</ul>
</div>
</nav>