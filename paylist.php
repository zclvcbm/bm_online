

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

            <title>付费列表_在线报名系统</title>
            <meta name="keywords" content="在线报名系统,ddphp,php在线报名系统,在线报名系统,报名系统">
                <meta name="description" content="在线报名系统，采用php语言开发，安全无漏洞，打造最专业的在线报名系统！">

                    <link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">

                        <script type="text/javascript" src="./js/jquery.min.js"></script>  

                        <!--Header-->

                        <!--Header-->

                        </head>
                        <body>
                        
    <?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once './ifuser.php';

session_start();
//加载分页文件
    require_once("lib/page.class_temp.php");

    $db = new MySql();

//多个删除
    if ($_GET['action'] == "del") {
        $delID = $_GET['id'];
        if (isset($delID) && $delID) {
            $ARY = explode(',', $delID);
            for ($i = 0; $i < count($ARY); $i++) {
                $sql = 'delete from  tf_paylist where id=' . intval($ARY[$i]);
                $res = $db->query($sql);
            }
            echo "<script>alert('删除成功');</script>";
        }
    }
//删除
    if ($_GET['del'] == 1) {
        /* 取得过滤条件 */
        $sql = 'delete from  tf_paylist where id=' . $_GET['id'];
        $res = $db->query($sql);
        echo "<script>alert('删除成功');</script>";
    }

//查询
    $wsql = "where 1=1";
    $username = $_SESSION['username'];

    if ($username) {
       // $wsql.=" and sfzh ='$username'";
    }

//分页处理
    $np = (intval($_GET['np']) > 0) ? intval($_GET['np']) : 1;
    $sql = "select count(*) counts from tf_paylist ". $wsql;
    $db->query($sql);
    $db->next_record();
    $count = $db->f("counts");

    $pageevery = 10; //每页多少条
    $start = ($np - 1) * $pageevery;
    $perpage = $pageevery;

    $fy = new page(array('total' => $count, 'perpage' => $perpage));

//输出分页
    $pageNav = $fy->show(4);
//查询每几条到第几条
    $limits = $start . "," . $perpage;
//册除用的.返回页面地址.
    $_SESSION['CURPAGE'] = $p->CurrentUrl;
    $sql = "select * from tf_paylist ".$wsql." order by id desc limit $limits";
	
    $db->query($sql);
    $arrInfo = array();
    $i = 1;

?>                    
                        
                        
                        
                        <div class="header">
                                <div class="header_inner">
                                    <h1 class="logo">
                                        <a href="http://www.ddphp.cn/"><img alt="" src="./images/logo.png"></a>      
                                    </h1>
                                    <ul class="nav">

                                    </ul>
                                    <div class="search">

                                    </div>
                                    <ul class="menu">

                                        <li><a href="out.php">退出</a></li>
                                        <li>
                                            用户，你好!&nbsp;&nbsp;<a href="index.php">[报考中心]</a>&nbsp;&nbsp;<a href="center.php">[用户中心]</a>     </li>

                                    </ul>
                                </div>
                            </div>
                            <!--/Header-->
                            <!--/Header-->

                            <div class="boxwrap">
                                <div class="left180">
                                    <!--Sidebar-->


                                    <div class="sidebar">
                                        <h3>功能导航</h3>
                                        <ul>
                                            <li><a href="center.php">用户中心</a></li>
                                            <li><a href="info.php">基本信息</a></li>
                                            <li><a href="pic.php">照片维护</a></li>
                                            <li><a href="#">考试列表</a></li>
                                            <li><a href="signuplist">报名缴费</a></li>
                                            <li><a href="paylist.php">付款记录</a></li>
                                            <li><a href="print.php?id=1571" target="_blank">打印准考证</a></li>
                                            <li><a href="search.html" target="_blank">考试分数查询</a></li>
                                        </ul>
                                    </div>    

                                    <!--/Sidebar-->
                                </div>

                                    <!--修改资料-->

                                    <div class="info-edit">
                                        <div class="info-edit-top">
                                            <ul class="step">

                                                <li class="step1"><em>1</em>报考列表</li>

                                            </ul>

                                        </div>
                                        <ul class="formlist">
                                 <table  width="700" cellpadding="0" cellspacing="0"  rules=all >
                                <tbody>
                                    <tr><td colspan="12" class="topTd" height="5"></td></tr>
                                    <tr class="row">
                                        <th  align="center">序号</th>
                                        <th  align="center">报名号</th>
                                        <th  align="center">交易事项</th>
                                        <th  align="center">交易流水号</th>
                                        <th  align="center">总金额</th>
                                        <th  align="center">付款日期</th> 
                                        <th  align="center">付款方式</th> 
                                        <td  align="center">操作</td>
                                    </tr>
<?php

while ($db->next_record()) {
    ?>
                                        <tr >
                                            <td  align="center"><?php echo $i ?></td>
                                            <td  align="center"><?php echo $db->f("bmh") ?></td>
                                            <td  align="center"><?php echo $db->f("jysx") ?></td>
                                            <td  align="center"><?php echo $db->f("jylsh") ?></td>
                                            <td  align="center"><?php echo $db->f("money") ?></td>
                                            <td  align="center"><?php echo $db->f("lastdate") ?></td>
                                            <td  align="center"><?php echo $db->f("fkfs") ?></td>
                                            <td  align="center"><a href="paylist.php?act=list&id=<?php echo $db->f("id") ?>&del=1" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;</td>
                                        </tr>
    <?php
    $i++;
}
?>
                                    <tr><td colspan="12" class="bottomTd" height="5"><? echo $pageNav; ?></td></tr></tbody></table>

                                        </ul>
<div class="page"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>



                                <!--Footer-->
                                <div class="footer">
                                    <div class="footer_inner">
                                        <div class="copyright">
                                            <table width=100% height="30" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="center" style="font-size:9pt;line-height:20px; COLOR: #787878;">联系我们 <SPAN class=style5> | 推荐分辨率：1024 X 768 及以上</SPAN><br>
                                                            Copyright&copy;2015 三峡大学继续教育学院 | 学院地址：宜昌市大学路8号 | 邮编：443002 | 联系电话：0717-6398961</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--/Footer-->

                            </div>
                        </body>
<script>
    document.getElementById("DIV的ID").innerHTML="HTML页面里的内容";
</script>
                        </html>