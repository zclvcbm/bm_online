<?php
error_reporting(0);
//设置工程相对路径
$root_path="../..";
require_once("../../data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("$root_path/lib/fun_com.php");

require_once("../ifadmin.php");

require_once ("../excel/reader.php");  // 应用导入excel的类

$data = new Spreadsheet_Excel_Reader();  //实例化类

$data->setOutputEncoding('utf-8'); //设置编码


$db=new MySql();

$data->read($_FILES["excel"]["tmp_name"]); //读取excel临时文件

if ($data->sheets[0]['numRows'] > 0) {   //判断excel里面的行数是不是大于0行  $data->sheets[0]['numRows']是excel的总行数
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {  //将execl数据插入数据库  $i表示从excel的第$i行开始读取  
    
	    $zkzh=$data->sheets[0]['cells'][$i][8];
		
		$sql = "select count(*) c from tf_cj where zkzh='".$zkzh."'";
		$res = $db->getOne($sql);
		if($res['c']>0)
		{
			echo "<script>alert('准考证号为".$zkzh."的信息有重复，请核对后再上传！');</script>";
			continue;
		}
        $cj_type_id=$data->sheets[0]['cells'][$i][2];
        $mc=$data->sheets[0]['cells'][$i][3];
        $level=$data->sheets[0]['cells'][$i][4];
        $sfzh=$data->sheets[0]['cells'][$i][5];
        $zsbh=$data->sheets[0]['cells'][$i][6];
        $lxdh=$data->sheets[0]['cells'][$i][7];

        $cj1=$data->sheets[0]['cells'][$i][9];
        $cj2=$data->sheets[0]['cells'][$i][10];
        $cj3=$data->sheets[0]['cells'][$i][11];
        $cj4=$data->sheets[0]['cells'][$i][12];
        $cj_stats=$data->sheets[0]['cells'][$i][13];
        
        
        $sql = "insert into tf_cj (cj_type_id,mc,level,sfzh,zsbh,lxdh,zkzh,cj1,cj2,cj3,cj4,cj_stats) values($cj_type_id,'$mc','$level','$sfzh','$zsbh','$lxdh','$zkzh','$cj1','$cj2','$cj3','$cj4',$cj_stats)";
 
        $db = new MySql();
        $db->query($sql);         
    }
}
echo "<center>准考证号信息导入完成!</center>";
die('<meta http-equiv="refresh" content="1; URL=cj_list.php">');
?>
