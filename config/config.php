<?php
define('UPLOAD_DIR', __DIR__.'/../uploads');

define('HOST', '192.168.1.5');
//define('HOST', '121.199.26.162');

if (HOST == 'localhost') {
	define('DEBUG', 2);
}
else {
	define('DEBUG', 0);
}

// define('UPLOAD_URL', 'http://'.HOST.'/mm/uploads');
// define('AVATAR_DEFAULT', 'http://'.HOST.'/mm/avatar/1.png');
// define('GROUP_AVATAR_DEFAULT', 'http://'.HOST.'/mm/avatar/group_avatar_default.png');

// PAY
define('PAY_SUBJECT', 'CNODE账户充值');
define('PAY_BODY', '');
define('PAY_CALLBACK_DOMAIN', 'http://cnode.cc/cb');

// alipay
$alipay_config['partner']		= '2088002887359633';
//安全检验码，以数字和字母组成的32位字符
$alipay_config['key']			= 'g6vmhqcu78xwb3mnjazejscfc1o03ndz';
$alipay_config['sign_type']    = strtoupper('MD5');
$alipay_config['input_charset']= strtolower('utf-8');
//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert']    = __DIR__.'/cacert.pem';
//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';

return array(
	'salt'				=> '964Dx7Svpn4VZ',
	'db.host'			=> '127.0.0.1',
	'db.user'			=> 'root',
	'db.password'		=> 'apple',
	'db.database'		=> 'radius'
);
