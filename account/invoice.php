<?php 
require '../include/init.inc';
?>
<!DOCTYPE html>
<html>
<head>
<title>我的账号</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h4>欢迎您 <?php echo auth('nickname')?></h4>
		<div class="row">
			<?php include 'left_nav.inc';?>
			<div class="span8">
				<h3>敬请期待...</h3>
			</div>
		</div>
		
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'footer.inc';?>
</body>
</html>
