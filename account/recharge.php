<?php 
require '../include/init.inc';
require '../include/util.inc';
$amount = 0;
$uid = auth('uid');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$paymethod = $_POST['paymethod'];
	$amount = $_POST['amount'];
	
	if (empty($amount) || is_nan($amount)) {
		alert(s("请输入有效充值金额",'please input valid amount'), 'error');
	}
	else {
		// create order and redirect to payment gateway
		$order = Invoice::create(array('uid'=>$uid, 'total_fee'=>$amount,'trade_ip'=>get_client_ip()));
		alipay($order);
	}	
}

function alipay($order) {
	require_once("../lib/alipay_trade_create_by_buyer/lib/alipay_submit.class.php");
	global $alipay_config;
	$payment_type = "1";
	$notify_url = PAY_CALLBACK_DOMAIN."/alipay_trade_create_by_buyer/notify_url.php";
	$return_url = PAY_CALLBACK_DOMAIN."/alipay_trade_create_by_buyer/return_url.php";
	$seller_email = "wanwei_ncu@126.com";
	
	//商户订单号
	$out_trade_no = $order->id;
	//商户网站订单系统中唯一订单号，必填
	
	//订单名称
	$subject = PAY_SUBJECT;
	//必填
	
	//付款金额
	$price = $order->total_fee;
	//必填
	
	//商品数量
	$quantity = "1";
	//必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品
	//物流费用
	$logistics_fee = "0.00";
	//必填，即运费
	//物流类型
	$logistics_type = "EXPRESS";
	//必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
	//物流支付方式
	$logistics_payment = "SELLER_PAY";
	//必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
	//订单描述
	
	$body = PAY_BODY;
	//商品展示地址
	$show_url = "";
	//需以http://开头的完整路径，如：http://www.xxx.com/myorder.html
	
	//收货人姓名
	$receive_name = "";//$_POST['WIDreceive_name'];
	//如：张三
	
	//收货人地址
	$receive_address = "";//$_POST['WIDreceive_address'];
	//如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号
	
	//收货人邮编
	$receive_zip = "";//$_POST['WIDreceive_zip'];
	//如：123456
	
	//收货人电话号码
	$receive_phone = "";//$_POST['WIDreceive_phone'];
	//如：0571-88158090
	
	//收货人手机号码
	$receive_mobile = "";//$_POST['WIDreceive_mobile'];
	//如：13312341234
	
	
	/************************************************************/
	
	//构造要请求的参数数组，无需改动
	$parameter = array(
			"service" => "trade_create_by_buyer",
			"partner" => trim($alipay_config['partner']),
			"payment_type"	=> $payment_type,
			"notify_url"	=> $notify_url,
			"return_url"	=> $return_url,
			"seller_email"	=> $seller_email,
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"price"	=> $price,
			"quantity"	=> $quantity,
			"logistics_fee"	=> $logistics_fee,
			"logistics_type"	=> $logistics_type,
			"logistics_payment"	=> $logistics_payment,
			"body"	=> $body,
			"show_url"	=> $show_url,
			"receive_name"	=> $receive_name,
			"receive_address"	=> $receive_address,
			"receive_zip"	=> $receive_zip,
			"receive_phone"	=> $receive_phone,
			"receive_mobile"	=> $receive_mobile,
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
	);
	
	//建立请求
	$alipaySubmit = new AlipaySubmit($alipay_config);
	$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
	echo $html_text;
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?php t('我的账号','My account')?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h4><?php t('欢迎您','Welcome, '); echo auth('nickname')?></h4>
		<div class="row">
			<?php include 'left_nav.inc';?>
			<div class="span8">
				<h4><?php t('充值','Recharge')?></h4>
				<?php t('目前，我们只支持支付宝充值。','We only support alipay currently, paypal will be support soon. Contact us if you get trouble.');?>
				<hr>
				<form class="form-horizontal" method="post" action="recharge.php">
				<?php echo_alerts(); ?>				
				  <div class="control-group">
				    <label class="control-label" for="inputEmail">
				    	<img alt="" src="../img/alipay.gif">
				    </label>
				    <div class="controls">
				    	<input type="hidden" name="paymethod" value="alipay">
				      	<input type="text" name="amount" placeholder="<?php t('请输入充值金额','Please input recharge amount') ?>" value="<?php if (isset($_GET['v'])) echo $_GET['v'];  ?>">
				      	<input type="submit" class="btn" value="<?php t('立即充值','Recharge Now')?>">
				    </div>
				  </div>				
				</form>
				
				<hr>
				<div class="alert alert-info">
					<h4><?php t('充值提示:','Tips:')?></h4> <br>
					<p><?php t('进入充值页面请选择','When enter next page, please choose')?> <strong style="color:red">即时到帐交易</strong></p>
					<img alt="" src="/img/recharge_tip.png"> 
				</div>				
			</div>
		</div>
		
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'footer.inc';?>
</body>
</html>
