<?php
include_once ("../connect.php");
$action = $_GET['action'];

if ($action == 'import') { //导入XLS
require_once ("excel/reader.php");  // 应用导入excel的类
$data = new Spreadsheet_Excel_Reader();  //实例化类
$data->setOutputEncoding('utf-8'); //设置编码
$data->read($_FILES["excel"]["tmp_name"]); //读取excel临时文件

mysql_connect($host, $db_user, $db_pass) or die("不能连接数据库 $dbhost");//连接数据库 
mysql_select_db($db_name) or die ("不能打开数据库 $dbname");//打开数据库 
mysql_query("delete from xx");                      
//echo "正在执行数据导入操作！<br>"; 

if ($data->sheets[0]['numRows'] > 0) {   //判断excel里面的行数是不是大于0行  $data->sheets[0]['numRows']是excel的总行数
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {  //将execl数据插入数据库  $i表示从excel的第$i行开始读取  
        $type=$data->sheets[0]['cells'][$i][2];
        $name=$data->sheets[0]['cells'][$i][3];
		$bz=$data->sheets[0]['cells'][$i][4];
       
	    $sql = "insert into xx (type,name,bz) values(
                    '{$data->sheets[0]['cells'][$i][2]}',
                    '{$data->sheets[0]['cells'][$i][3]}',
                    '{$data->sheets[0]['cells'][$i][4]}'
                  )";
        //echo $sql."<br/>";
        mysql_query($sql);         
    }
	echo "<script>alert('数据导入成功');</script>";
	echo "<script>window.close();</script>";
} 
}
else if ($action=='export')
 { //导出XLS
   
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
require_once 'PHPExcel.php';

$objPHPExcel=new PHPExcel();
$objPHPExcel->getProperties()->setCreator('参数Excel文件')
        ->setLastModifiedBy('参数Excel文件')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','ID')
            ->setCellValue('B1','类型')
            ->setCellValue('C1','名称')
            ->setCellValue('D1','备注');

$i=2;   


$result = mysql_query("select * from xx order by id asc"); 
while($row=mysql_fetch_array($result)){ 
     $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i,$row['id'])
            ->setCellValue('B'.$i,$row['type'])
            ->setCellValue('C'.$i,$row['name'])
            ->setCellValue('D'.$i,$row['bz']);
			$i=$i+1;
}	


$objPHPExcel->getActiveSheet()->setTitle('类型参数');
$objPHPExcel->setActiveSheetIndex(0);
$filename=urlencode('类型参数表').'_'.date('Y-m-dHis');



//生成xls文件
ob_end_clean();//清除缓冲区,避免乱码

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');
exit;

}
?>
