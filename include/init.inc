<?php
error_reporting(E_ALL);
@ini_set('display_errors', true);
date_default_timezone_set('Asia/Shanghai');
session_start();

# defines
define('TMP', __DIR__.'/../tmp');
define('LIB', __DIR__.'/../lib');

$config = require_once __DIR__.'/../config/config.php';

require_once __DIR__.'/helper.php';

# determine and load locale strings
if (!isset($_COOKIE['lang'])) {
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4); //只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。
	if (preg_match("/zh/i", $lang)) {
		$_COOKIE['lang'] = 'zh';
	} else {
		$_COOKIE['lang'] = 'en';
	}	
}

$lang = 'en';
if ($_COOKIE['lang'] == 'zh') {
	$lang = 'zh';
//	include_once 'locale/zh.php';
} else {
	$lang = 'en';
// 	include_once 'locale/en.php';
}

# db
require_once __DIR__.'/../lib/php-activerecord/ActiveRecord.php';

$connectstring = "mysql://{$config['db.user']}:{$config['db.password']}@{$config['db.host']}/{$config['db.database']};charset=utf8";
$cfg = ActiveRecord\Config::instance();
$cfg->set_model_directory(__DIR__.'/../model');
$cfg->set_connections(
		array(
				'development' => $connectstring,
				'test' => $connectstring,
				'production' => $connectstring
		)
);
ActiveRecord\DateTime::$DEFAULT_FORMAT = 'Y-m-d H:i:s';

function auth($name='', $check_only=false) {
	if (empty($_SESSION['user'])) {
		if ($check_only) return null;
		header("Location: /login.php");
	}
	else {
		if ($name == '') {
			return $_SESSION['user'];
		}
		else {
			return $_SESSION['user'][$name];
		}
	}
}

$alerts = array();

function alert($msg, $type) {
	global $alerts;
	if ($msg) {
		$alerts[] = array('type' => $type, 'msg' => $msg);
	}
}

function echo_alerts() {
	global $alerts;
	foreach ($alerts as $value) {
		echo "<div class='alert alert-{$value['type']}'>{$value['msg']}</div>";
	}
}

function t($zh, $en, $echo=true) {
	global $lang;
	$txt = $lang == 'zh' ? $zh : $en;
	if ($echo)
		echo $txt;
	else 
		return $txt;
}

function s($zh, $en) {
	return t($zh, $en, false);
}

