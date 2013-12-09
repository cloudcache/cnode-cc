<?php 
require '../include/init.inc';
$uid = auth('uid');
$user = User::find_by_pk($uid, array());
$expire_in = $user->expire_in;
$u = Radacct::find_by_sql("select sum(acctinputoctets) as i,sum(acctoutputoctets) as o from `radacct` r where r.username='{$user->email}'"); 

?>
<!DOCTYPE html>
<html>
<head>
<title><?php t('我的账号','My account')?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css"></style>
<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h4><?php t('欢迎您','Welcome, '); echo auth('nickname')?></h4>
		<div class="row">
			<?php include 'left_nav.inc';?>
			<div class="span9">
				<h5><?php t('基本信息','Base Info')?></h5>
				<hr>
				<table class="table table-striped">
					<tr>
						<td><?php t('账号','Account')?>:</td>
						<td><?php echo $user->email;?></td>
						<td></td>
					</tr>
					<tr>
						<td><?php t('使用状态','Status')?>:</td>
						<td><?php echo $user->start_at->format('Y-m-d').s(' 至 ',' to ').$user->expire_at->format('Y-m-d');?></td>
						<td>
						<?php if ($expire_in > 0) {
							echo "<div class='alert alert-success' style='margin-bottom: 0'>".s('剩余','Remains')." $expire_in ".s('天','days')." </div>";
						} else {
							echo "<div class='alert alert-error' style='margin-bottom: 0'>".s('已过期','Expired')." <a href='buy.php'>".s('立即购买','Buy Now')."</a></div>";
						}?>
						</td>
					</tr>
					<tr>
						<td><?php t('账户余额','Balance')?>:</td>
						<td><?php echo $user->balance;?></td>
						<td>							
							<a href="recharge.php"><?php t('账户充值','Recharge')?></a>
						</td>
					</tr>
					<tr>
						<td><?php t('注册时间','Register time')?>:</td>
						<td><?php echo $user->created_at;?></td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
		
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'footer.inc';?>
</body>
</html>
