<?php
define('DB_HOST', "localhost");

define('DB_USER', "root");

define('DB_PASSWORD', "123456");

define('DB_DATABASE', "sqb");

if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
    require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
} // 注意文件路径

?>
