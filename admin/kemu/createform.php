<?php

session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");

$sql = "SELECT * FROM tf_form WHERE display='1' AND fid=".escapeshellarg($fid);
$f = $db->getOne($sql);
if (!$f)
    exit;

// 生成创建数据表的SQL语句
$db->query("DROP TABLE IF EXISTS `form_$fid`");
$sql = "CREATE TABLE `form_$fid` (
            id int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',";

$formList = $db->getAll("SELECT * FROM tf_form_type WHERE fid='$fid' ORDER BY orderid ASC");
$flag = 0;
foreach ($formList AS $k => $form) {
    $k = (!$k) ? 0 : $k++;
    //$i=1;
    if ($form['ismust'] == 1)
    {
        //if(!empty(strstr($form['title'],"费")))
        //{
        //    $sql .= "val" . (100+$i) . " char(100) not null comment  '" . $form['title'] . "', ";
        //}
        $sql .= "val" . $k . " char(100) not null comment  '" . $form['title'] . "', ";
    }
    else
    {
        //if(!empty(strstr($form['title'],"费")))
        //{
        //    $sql .= "val" . (100+$i) . " char(100) comment '" . $form['title'] . "', ";
        //}
        $sql .= "val" . $k . " char(100) comment '" . $form['title'] . "', ";
    }
        
    if ($form['title'] == "报考级别" || $form['title'] == "培训类别" || $form['title'] == "其它费用") {
        $flag++;
    }
}
if ($flag < 3) {
    msg("请按要求先为考试科目创建报考级别、培训类别、其它费用！");
    exit();
} else if ($flag > 3) {
    msg("不可重复创建多个报考级别、培训类别、其它费用！");
    exit();
}
$sql .= "sfzh char(100) not null comment '身份证号',
                 bmh char(100) not null comment '报名号',
                 jfzt int(4) not null comment '缴费状态' default 0,
                 shzt int(4) not null comment '审核状态' default 0 ,
                 bmsj varchar(30) comment '报名时间',
                 xgsj varchar(30) comment '修改时间',
                 kskm varchar(100) comment '考试科目',
	         pxkm varchar(100) comment '培训科目',
	         ksfy float(11) not null comment '考试费用' default 0,
                 pxfy float(11) not null comment '培训费用' default 0,
	         qtfy float(11) not null comment '其它费用' default 0,";
$sql .= " PRIMARY KEY (`id`)
             ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";

$result = $db->query($sql);
if ($result) {
    msg("创建表成功！");
}
else
    msg("创建表失败！");
?>