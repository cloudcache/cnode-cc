<?php
require_once 'include/init.inc';
$email = $_SESSION['email']; 
?>
<!DOCTYPE html>
<html>
<head>
<title>CNODE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css">
#plan div { text-align: center; }
</style>

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h2><?php t('注册成功','Register success')?></h2>
		
		<div class="alert alert-success">
			<?php t('注册已成功，但账号还处于未激活状态。请进入您的注册邮箱','Register success, but your account is currently inactive, please go to you register email to')?> <b>
			<?php echo $email;?></b> 
			<?php t('激活账号。', 'Active your account')?> 
		</div>
		<?php t('未收到邮件? 请联系客服。',"Don't receive any activation mail? please contact customer services.")?>
		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1507417094&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1507417094:41" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'include/footer.inc';?>
</body>
</html>
		