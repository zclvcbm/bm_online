<?php

error_reporting(0);
//设置工程相对路径
$root_path="../..";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("$root_path/lib/fun_com.php");

require_once("../ifadmin.php");

require_once ("../excel/reader.php");  // 应用导入excel的类

$data = new Spreadsheet_Excel_Reader();  //实例化类

$data->setOutputEncoding('utf-8'); //设置编码

//print_r($_FILES);

$data->read($_FILES["excel"]["tmp_name"]); //读取excel临时文件

//print_r($data);
$db=new MySql();


if ($data->sheets[0]['numRows'] > 0) {   //判断excel里面的行数是不是大于0行  $data->sheets[0]['numRows']是excel的总行数
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {  //将execl数据插入数据库  $i表示从excel的第$i行开始读取
		
        $zkzh=$data->sheets[0]['cells'][$i][1];
		if($zkzh!=''){
			
		
		$sql = "select count(*) c from tf_zkzh where zkzh='".$zkzh."'";
		$res = $db->getOne($sql);
		if($res['c']>0)
		{
			echo "<script>alert('准考证号为".$zkzh."的信息有重复，请核对后再上传！');</script>";
			continue;
		}
		$sfzh=$data->sheets[0]['cells'][$i][2];
        $mc=$data->sheets[0]['cells'][$i][3];
        $level=$data->sheets[0]['cells'][$i][4];
		$llkssj=$data->sheets[0]['cells'][$i][5];
		$llksdd=$data->sheets[0]['cells'][$i][6];
		$llkszwh=$data->sheets[0]['cells'][$i][7];
		$sskssj=$data->sheets[0]['cells'][$i][8];
		$ssksdd=$data->sheets[0]['cells'][$i][9];
		$sskszwh=$data->sheets[0]['cells'][$i][10];
        
        $zhkssj=$data->sheets[0]['cells'][$i][11];
        $zhksdd=$data->sheets[0]['cells'][$i][12];
        $zhkszwh=$data->sheets[0]['cells'][$i][13];
        $bz=$data->sheets[0]['cells'][$i][14];
        $bmh=$data->sheets[0]['cells'][$i][15];
        $sql = "insert into tf_zkzh (zkzh,sfzh,mc,level,llkssj,llksdd,llkszwh,sskssj,ssksdd,sskszwh,zhkssj,zhksdd,zhkszwh,bz,bmh) values('$zkzh','$sfzh','$mc','$level','$llkssj','$llksdd','$llkszwh','$sskssj','$ssksdd','$sskszwh','$zhkssj','$zhksdd','$zhkszwh','$bz','$bmh')";
			 
        //echo $sql."<br/>";
        $db = new MySql();
        $db->query($sql); 
       }        
    }
    //die();
}
echo "<center>准考证号信息导入完成!</center>";
die('<meta http-equiv="refresh" content="1; URL=zkz_list.php">');
?>
