<?php
require_once __DIR__.'/../lib/phpmailer/class.phpmailer.php';

class Mailer {
	public static function send_account_active($uid) {
		$user = User::find_by_pk($uid, array());
		$email = $user->email;
		$hash = $user->verify_hash;
		
		$mail = new PHPMailer;
		
		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.exmail.qq.com';  // Specify main and backup server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'service@cnode.cc';                            // SMTP username
		$mail->Password = 'ww445178';                           // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		
		$mail->From = 'service@cnode.cc';
		$mail->FromName = 'CNODE';
		$mail->AddAddress($user->email, $user->nickname);  // Add a recipient
		$mail->CharSet = "UTF-8";
		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->IsHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = '用户注册验证邮件';
		$mail->Body    = <<<EOT
<div id="mailContentContainer" style="height:auto;min-height:100px;_height:100px;font-size:14px;padding:0;font-family: 'lucida Grande',Verdana;">
	<div style="background:#0061ba;width:820px;margin:0 auto;padding:8px;border:1px solid #0061ba;">
	</div>
	<div style="border:1px solid #0061ba;width:820px;margin:0 auto;padding:8px;">
	    <div style="padding:5px 20px;font-size:14px;">
	        <p style="padding-bottom:20px;">亲爱的 <strong><a href="mailto:http://$email" target="_blank">$email</a></strong>：</p>
	        <p style="background:#f7f7f7; padding:10px 20px;line-height:36px;">欢迎加入 <strong>CNODE</strong>，
	        请点击下面的链接来验证你的Email帐号<span style="font-size:12px; color:#999;">（链接24小时内访问有效）</span><br>
	        <a href="http://www.cnode.cc/account/active.php?vemail=$email&amp;hash=$hash" target="_blank" style="line-height:18px;">http://www.cnode.cc/account/active.php?vemail=$email&amp;hash=$hash</a><br>
	        <span style="font-size:12px; color:#999;">如果以上链接无法点击，请将它复制到你的浏览器（如IE）地址栏中进入访问。<br>
	        如果此次激活请求非你本人所发，请忽略本邮件。</span></p> 
	        <p style="padding-top:30px;">CNODE（<a href="http://www.cnode.cc/" target="_blank">http://www.cnode.cc/</a>） - VPN专业服务商</p>
	        <p style="border-top:1px solid #ddd;color:#999;font-size:12px;padding-top:10px;">这是一封系统自动发出的邮件，请勿回复。</p>
	    </div>
	</div> 
</div>'
EOT;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		if(!$mail->Send()) {
			file_put_contents('/tmp/mailer.log', "ERROR: send_account_active($uid) ".$mail->ErrorInfo);
			return false;
		}
		
		return true;		
	}
}
