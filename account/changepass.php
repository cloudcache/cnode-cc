<?php 
require '../include/init.inc';
require '../include/util.inc';
$uid = auth('uid');
$error = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$password = $_POST['password'];
	if (!validate_password($password)) {
		$error = s("请输入有效的密码",'Please input valid password');
	} else {
		$hashed_password = md5($password.$config['salt']);
		$user = User::find_by_pk($uid, array());
		$user->password = $hashed_password;
		$user->save();
		$success = s("密码修改成功！",'Password changed success');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php t('我的账号','Account')?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h4><?php echo s('欢迎您 ','Welcome, ').auth('nickname')?></h4>
		<div class="row">
			<?php include 'left_nav.inc';?>
			<div class="span8">
				<h3><?php t('修改密码','Change password')?></h3>
				<?php if($success) echo "<div class='alert alert-success'>$success</div>" ?>
				<?php if ($error) echo "<div class='alert alert-error'>$error</div>";?>				
				<form action="changepass.php" class="form-inline" method="post">
					<label><?php t('新密码','New password')?></label>
					<input type="password" name="password" placeholder="6-10<?php t('位密码',' characters password')?>" autocomplete="off" class="input">
					<input type="submit" value="<?php t('修改','Submit')?>" class="btn">					
				</form>
				
			</div>
		</div>
		
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'footer.inc';?>
</body>
</html>
