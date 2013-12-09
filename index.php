<?php 
require 'include/init.inc';
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome to CNODE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css">
#plan div { text-align: center; }
</style>

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h3><?php t('欢迎来到 CNODE','Welcome to CNODE') ?></h3>
		<h4><?php t('CNODE是一个的VPN服务提供者，我们也准备为用户建立一个VPN社区。','VPN for China Expats.')?></h4>
		<br>
		<div>
			<form action="register.php" class="form-inline" method="post">
				<label><?php t('注册账号赠送1天免费试用','Register Now for 1 day free use')?></label>
				<input type="text" name="email" placeholder="Email" autocomplete="off">
				<input type="text" name="nickname" placeholder="<?php t('昵称','Nick name')?>" autocomplete="off" class="input-small">				
				<input type="password" name="password" placeholder="<?php t('密码','Password')?>" autocomplete="off" class="input-small">
				<input type="submit" value="<?php t('立即注册','Register')?>" class="btn btn-success">
			</form>
		</div>
		<div>
			<?php t('客服联系:','Customer Service Contact (QQ):')?>
			<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1507417094&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1507417094:41" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
		</div>
		<br>
		<table style="width: 100%;" class="table table-striped">
			<caption><?php t('套餐','Plan')?></caption>
			<thead>
				<tr>
					<td></td>
					<td><?php t('月付','Monthly pay')?></td>
					<td><?php t('季付', 'Quarter pay')?></td>
					<td><?php t('年付', 'Year pay')?></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php t('费用', 'Cost')?></td>
					<td>15</td>
					<td>40</td>
					<td>120</td>
				</tr>
				<tr>
					<td><?php t('月流量','Monthly traffic Limit')?></td>
					<td>10G</td>
					<td>10G</td>
					<td>10G</td>
				</tr>
			</tbody>
		</table>
		
		<div>
			<p><?php t('如何设置:','How to setup devecies:')?></p>
			<ul>
				<li><?php t('服务器地址请填写','Server address please input')?>: us1.cnode.cc</li>
				<li><?php t('支持协议','Protocol')?>: PPTP</li>
				<li><?php t('账户,密码请填写您的注册账户名(Email)和密码','Account,password is the same as site account(Email),password')?></li>
			</ul>
			<p><?php t('详细步骤请参考以下说明:','Details steps, only in chinese')?></p>
			<ul>
				<li><a href="articles/win7.php">Windows 7</a></li>
				<li><a href="articles/winxp.php">Windows xp</a></li>
				<li><a href="articles/iphone.php">iPhone</a></li>
				<li><a href="articles/android.php">Android</a></li>
				<li><a href="articles/osx.php">OS X</a></li>
			</ul>
		</div>
		
		<div class="alert alert-error">
			<p>-----<?php t('使用须知','Terms')?>-----</p>
			<ul>
				<li><?php t('请勿进行BT,电驴等进行大流量下载',"Please don't use BT,eMule like p2p application")?></li>
				<li><?php t('使用本服务时请遵守相关法律。严禁进行“反动政治”,“非法网络侵入”,“网络盗窃、诈骗”等活动，否则立即封号。','Please obey the laws in China and US when using this service.')?></li>
			</ul>
 		</div>
		
		<div style="">
			
		</div>
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'include/footer.inc';?>
	</body>
</html>
