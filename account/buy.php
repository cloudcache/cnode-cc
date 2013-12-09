<?php 
require '../include/init.inc';
$uid = auth('uid');
$plans = array(0, array('days'=>30, 'price'=>15), array('days'=>90, 'price'=>40), array('days'=>180, 'price'=>75), array('days'=>365, 'price'=>120));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$planid = $_POST['planid'];
	if ($planid < 1 || $planid > 4) {
		$planid = 1;
	}
	
	$plan = $plans[$planid];
	$user = User::find_by_pk($uid, array());
	if ($plan['price'] > $user->balance) {
		$recharge = $plan['price'] - $user->balance;
		$msg = s("你的账号余额不足，请充值后再购买。当前余额: $user->balance 元, 还需充值 $recharge 元 <a href='recharge.php?v=$recharge'>立即充值</a>",
				"Insufficient balance,please recharge your account, then buy。Balance: $user->balance RMB, need rechage $recharge RMB <a href='recharge.php?v=$recharge'>Recharge Now</a>");
		alert($msg, 'error');
	} else {
		$user->start_at = date('Y-m-d H:i:s');
		if ($user->expire_in < 0) {
			$user->expire_at = date('Y-m-d H:i:s', strtotime('+ '.$plan['days'].' days'));
		} else {
			$user->expire_at = $user->expire_at->add(new DateInterval('P'.$plan['days'].'D'));
		}
		
		$user->balance -= $plan['price'];
		$user->save();
		// 购买成功
		$msg = s("购买成功。<a href='index.php'>查看我的账号</a>","Buy success. <a href='index.php'>Check my account</a>");
		alert($msg,'success');
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?php t('购买','Buy')?></title>
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
				<h4><?php t('购买使用套餐','Choose a plan')?></h4>
				<?php echo_alerts() ?>
				<form class="form-horizontal" method="post" action="buy.php">
					<div class="control-group">
						<label class="control-label" for="inputPassword"><?php t('套餐选择','Plans')?></label>
						<div class="controls">
							<label class="radio">
							  <input type="radio" name="planid" value="1" checked>
							  <?php t('1个月: 15元','1 Month, 15 Yuan(RMB)')?>
							</label>
							<label class="radio">
							  <input type="radio" name="planid" value="2" >
							  <?php t('3个月: 40元','3 Month, 40 Yuan(RMB)')?>
							</label>
							<label class="radio">
							  <input type="radio" name="planid" value="3" >
							  <?php t('半年: 75元','Half year, 75 Yuan(RMB)')?>							  
							</label>
							<label class="radio">
							  <input type="radio" name="planid" value="4" >
							  <?php t('一年: 120元','One year, 120 Yuan(RMB)')?>
							  
							</label>
						</div>
					</div>
					
					<input type="submit" value="<?php t('购买','Buy')?>" class="btn btn-block btn-primary">
				</form>
			</div>
		</div>

		<div class="footer" style="text-align: center;">© 2013 CNODE</div>
	</div>
	<?php include 'footer.inc';?>
</body>
</html>
