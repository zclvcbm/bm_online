<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: 2008-05-01 05:32:47Z aming $
*/
//require_once '../../data/dconfig.php';
include_once '../../data/dconfig.php';
error_reporting(0);

 ini_set('date.timezone','Asia/Shanghai'); // 'Asia/Shanghai' 为上海时区 
 
//note MySQL的主机地址，通常为localhost
$dbHost = constant("DB_HOST");

//note 系统使用的MySQL的数据库名，比如project_moophp
$dbName = constant("DB_DATABASE");

//note MySQL的用户名
$dbUser = constant("DB_USER");

//note MySQL的用户名对应的密码
$dbPasswd = constant("DB_PASSWORD");

//note MySQL表前缀
$tablePre = 'tf_';

//note:以下内容无需修改
//note MySQL数据库字符集
$dbCharset = 'utf8';
//note 是否为持续链接
$dbPconnect = 0;
$secCode = 0;//是否开启验证码功能0为关闭，1为开启
$db = MooAutoLoad('MooMySQL');
$db->connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPconnect, $dbCharset);
$db->query("SET NAMES UTF8");
//加载常用函数库
require_once('Global.function.php');