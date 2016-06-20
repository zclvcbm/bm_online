<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: MooPHP.php 104 2008-04-14 09:18:55Z kimi $
*/

define('IN_MOOPHP', TRUE);
//note MooPHP的核心版本，例如：0.0.1
define('MOOPHP_VERSION', '0.0.1');
//note 正在被访问的文件路径，例如：D:\web\MooPHP
define('MOOPHP_ROOT', substr(__FILE__, 0, -11));
//note 正在被访问的文件URL，例如：http://www.ccvita.com/MooPHP
define('MOOPHP_URL', strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, strpos($_SERVER['SERVER_PROTOCOL'], '/'))).'://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
//note REQUEST_URI
define('REQUEST_URI', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : (isset($_SERVER['argv']) ? $_SERVER['PHP_SELF'].'?'.$_SERVER['argv'][0] : $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING']));
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
!defined('MOOPHP_TEMPLATE_DIR') && define('MOOPHP_TEMPLATE_DIR', 'Moo-templates');
!defined('MOOPHP_TEMPLATE_COMPLIE_DIR') && define('MOOPHP_TEMPLATE_COMPLIE_DIR', 'Moo-data/templates');
!defined('MOOPHP_TEMPLATE_URL') && define('MOOPHP_TEMPLATE_URL', MOOPHP_URL.'/template');

// 定义指示 PHP4 或 PHP5 的常量
if(substr(PHP_VERSION, 0, 1) == '5') {
	define('PHP5', true);
	define('PHP4', false);
} else {
	define('PHP5', false);
	define('PHP4', true);
}

//note 禁止对全局变量注入
if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) {
	exit('Request tainting attempted.');
}

//note MooPHP基础量保存数组
$_MooPHP = array();
//note 初始化类保存变量
$_MooClass = array();
//note 初始化Block保存变量
$_MooBlock = array();
//note 数据库信息初始化
$dbHost = $dbName = $dbUser = $dbPasswd = $dbPconnect = '';

require_once MOOPHP_ROOT.'/MooConfig.php';

//note 对GPC变量进行安全处理
if (!MAGIC_QUOTES_GPC) {
	$_GET = MooAddslashes($_GET);
	$_POST = MooAddslashes($_POST);
	$_COOKIE = MooAddslashes($_COOKIE);
	$_REQUEST = MooAddslashes($_REQUEST);
	$_SERVER = MooAddslashes($_SERVER);
	$_FILES = MooAddslashes($_FILES);
}

/**
* 自动加载默认类文件函数，并将其初始化
* @param string $classname - 类名
* @return class
*/
function MooAutoLoad($classname) {
	global $_MooClass;

	if($_MooClass[$classname]) {
		return $_MooClass[$classname];
	} else {
		require_once MOOPHP_ROOT.'/libraries/'.$classname.'.class.php';
		$_MooClass[$classname]= & new $classname;
		return $_MooClass[$classname];
	}

}

/**
* 为变量或者数组添加转义
* @param string $value - 字符串或者数组变量
* @return array
*/
function MooAddslashes($value, $force = 0) {
	return $value = is_array($value) ? array_map('MooAddslashes', $value) : addslashes($value);
}


/**
* 将特殊字符转成 HTML 格式。比如<a href='test'>Test</a>转换为&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;
* @param $value - 字符串或者数组变量
* @return array
*/
function MooHtmlspecialchars($value) {
	return is_array($value) ? array_map('MooHtmlspecialchars', $value) : preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1', str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $value));
}