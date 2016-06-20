<?php

header('Content-Type:text/html;Charset=utf-8;');  

include "crypt.php";  

$data = 'PHP加密解密算法';  // 被加密信息
$key = '123';     // 密钥
$encrypt = encrypt($data, $key);
$decrypt = decrypt($encrypt, $key);
//echo $encrypt, "\n", $decrypt;


$a="Z2ljk5JsZmXYyKOxmaU=";
$b="ZWZjmJtraGKTlGusnK0=";

$aa=decrypt($a);

$bb=decrypt($b);

echo $aa."<br>";
echo $bb."<br>";



?>
