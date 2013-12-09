<?php
require '../include/init.inc';
$hash = $_REQUEST['hash'];
$email = $_REQUEST['vemail'];
$verify_ok = false;

$user = User::first(array('email' => $email));
if ($user && $user->verify_hash == $hash) {
	$verify_ok = true;
	$user->is_locked = 0;
	$user->start_at = date('Y-m-d H:i:s');
	$user->expire_at = date('Y-m-d H:i:s', strtotime('+ 1 days'));
	$user->save();
	
	$rc = Radcheck::first(array('username'=>$email));
	if ($rc) {
		$rc->op = ':=';
		$rc->save();
	}
	
	$_SESSION['user'] = $user->profile();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php t('激活账号','Active account')?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css">
#plan div { text-align: center; }

</style>
<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h2><?php t('激活账号','Active account')?></h2>
		
		<?php
		if ($verify_ok) {
		?>
		<div class='alert alert-success'><h4><?php t('激活已成功，正在自动登陆账号','Account acitve success, login in')?>...</h4></div>
		<script type="text/javascript">
		window.setTimeout(function() {
			location.href="index.php";
		}, 2000);
		</script>
		<?php
		} else {
			echo "<div class='alert alert-error'><h2>".s('激活失败','Account active failed')."。</h2></div>";
		}
		?>
		
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'footer.inc';?>
</body>
</html>
		
