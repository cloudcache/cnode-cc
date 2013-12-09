<?php 
require_once 'include/init.inc';
require_once 'include/util.inc';
$email = "";
$nickname = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
	$nickname = $_POST['nickname'];
	$password = $_POST['password'];
	
	if (!validate_email($email)) {
		alert(s("请输入有效的电子邮箱地址",'Please input valid email address'), 'error');
	} else 	if (User::check_email($email)) {
		alert(s("该Email已被占用",'This email is aleady taken'), 'error');
	}
	
	if (!validate_nickname($nickname)) {
		alert(s("请输入有效的昵称",'Please input valid nick name'), 'error');
	} else if (User::check_nickname($nickname)) {
		alert(s("该昵称已被占用",'This nick name is aleady taken'), 'error');
	}
	
	if (!validate_password($password)) {
		alert(s("请输入有效的密码",'Please input valid password'), 'error');
	}
	
	if (count($alerts) <= 0) {
		$hashed_password = md5($password.$config['salt']); 
		$verify_hash = make_random_key();
		$user = User::create(array('email'=>$email, 'nickname'=>$nickname,'password'=>$hashed_password, 'verify_hash' => $verify_hash,'is_locked'=>1));
		Radcheck::create(array('username'=>$email,'value'=>$password,'attribute'=>'Cleartext-Password','op'=>''));
		
		// send active mail
		$r = Mailer::send_account_active($user->id);
		if ($r) {
			$_SESSION['email'] = $user->email;
			header('Location: /register_next.php');		
		}
		else {
			alert(s("注册失败，请稍后重试",'Register failed, please try again later'), 'error');
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php t('注册','Register')?> CNODE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css">
#plan div { text-align: center; }
</style>

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h1><?php t('注册','Register')?></h1>
		<div>
			<form class="form-horizontal" method="post" action="register.php">
				<?php echo_alerts(); ?>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">Email</label>
			    <div class="controls">
			      <input type="text" id="inputEmail" name="email" placeholder="<?php t('登录网站时使用','Use when login to site')?>" value="<?php echo $email;?>">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputUsername"><?php t('昵称','Nick name')?></label>
			    <div class="controls">
			      <input type="text" id="inputUsername" name="nickname" placeholder="<?php t('网站显示的昵称,4-10个字符','Dispay in site, 4-10 characters')?>" value="<?php echo $nickname;?>">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword"><?php t('密码','Password')?></label>
			    <div class="controls">
			      <input type="password" id="inputPassword" name="password" placeholder="<?php t('6-10位密码','6-10 characters password')?>" value="<?php echo $password;?>">
			    </div>
			  </div>
			  <div class="control-group">
			    <div class="controls">
			      <button type="submit" class="btn btn-success"><?php t('注册','Register')?></button>
			      <?php t('已经有账号','Have account')?> ? 
			       <a href="login.php"><?php t('立即登录','Login Now')?></a>
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
