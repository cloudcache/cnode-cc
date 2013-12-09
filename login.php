<?php 
require_once __DIR__.'/include/init.inc';
$email = "";
$password = "";

$errors = array();
global $config;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if (empty($email)) {
		$errors[] = s("请输入有效的电子邮箱地址",'Please input valid email address');
	}
		
	if (empty($password)) {
		$errors[] = s("请输入有效的密码", 'Please input valid password');
	}
	
	$hashed_password = md5($password.$config['salt']); 
	$user = User::first(array('conditions'=>array('email=? and password=?',$email, $hashed_password)));
	if ($user) { // login user
		if ($user->is_locked == 1) {
			$_SESSION['email'] = $user->email;
			header('Location: /register_next.php');
		}
		$_SESSION['user'] = $user->profile();
		header('Location: /account/index.php');
	}
	else {
		if(count($errors) <= 0) 
			$errors[] = s("邮件地址或密码无效",'Email address is invalid');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php t('登陆','Login to ')?> CNODE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css">
#plan div { text-align: center; }
</style>

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h1><?php t('登录', 'Login')?></h1>
		<div>
			<form class="form-horizontal" method="post" action="login.php">
				<?php
				foreach ($errors as $e) {
					echo "<div class=\"alert alert-error\">";
					echo $e;
					echo "</div>";
				} 
				?>
			
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">Email</label>
			    <div class="controls">
			      <input type="text" id="inputEmail" name="email" placeholder="Email" value="<?php echo $email;?>">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword"><?php t('密码','Password')?></label>
			    <div class="controls">
			      <input type="password" id="inputPassword" name="password" placeholder="<?php t('密码','Password')?>" value="<?php echo $password;?>">
			    </div>
			  </div>
			  <div class="control-group">
			    <div class="controls">
			      <label class="checkbox">
			        <input type="checkbox"> <?php t('记住我','Remember Me')?>
			      </label>
			      <button type="submit" class="btn btn-primary"><?php t('登录','Login')?></button>
			      <?php t('还没有账号',"Don't have account yet")?> ? <a href="register.php"><?php t('立即注册','Register Now')?></a>
			    </div>
			  </div>
			</form>
		</div>		
		
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'include/footer.inc';?>
</body>
</html>
