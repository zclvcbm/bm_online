<?php 
error_reporting(0);
session_start();
require_once("data/dconfig.php");
require_once("lib/config.php");


$sql = "select * from tf_users ";



$db = new MySql();

mysql_query("set names gbk");

$db->query("update form_1 set val2='99999'");

/*
$results = $db->getArray($sql);

foreach ($results as $result) {

if(empty($result['pic']))
	{
		continue;
	}
print_r($result);
	$sfzh = $result['username'];
	$pic = $result['pic'];
	$pic1 = str_replace("init", "init_copy", $pic);
	$pic2 = str_replace("init", "passed", $pic);
	$pic3 = str_replace("init", "unpassed", $pic);

	$pic_new = "upload/init/".$sfzh.".jpg";
	$pic_new1 = "upload/init_copy/".$sfzh.".jpg";
	$pic_new2 = "upload/passed/".$sfzh.".jpg";
	$pic_new3 = "upload/unpassed/".$sfzh.".jpg";

	//echo $pic;
	rename($pic, $pic_new);
	rename($pic1, $pic_new1);
	rename($pic2, $pic_new2);
	rename($pic3, $pic_new3);



	$sql1 = "update tf_users set pic='".$pic_new."' where username='".$sfzh."'";

	$db->query($sql1);
	
}

*/




?>