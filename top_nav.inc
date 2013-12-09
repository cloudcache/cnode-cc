<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">CNODE</a>
			<div class="nav-collapse collapse">
				<p class="navbar-text pull-right">
				<?php if (auth('', true) == null) {
					echo '<a href="/login.php" class="navbar-link">'.t('登录','Login',false).'</a>';
				} else {
					echo '<a href="/logout.php" class="navbar-link">'.t('退出','Logout',false).'</a>';
				} ?>
	            </p>
			    <ul class="nav">
			      <li class="active"><a href="/index.php"><?php t('首页','Home')?></a></li>
			      <li><a href="/account/buy.php"><?php t('购买','Buy')?></a></li>	
<!-- 			      <li><a href="blog.php">Blog</a></li> -->
<!-- 			      <li><a href="/community.php">社区</a></li> -->
			      <li><a href="/account/index.php"><?php t('我的账号','Account')?></a></li>
			    </ul>
			</div>
	  </div>
	</div>
</div>
