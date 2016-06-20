<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../style/style.css" rel="stylesheet" type="text/css" />
    <?php
    //设置工程相对路径
    $root_path = "../..";
    require_once("$root_path/data/dconfig.php");
    require_once("$root_path/lib/config.php");
    require_once '../ifadmin.php';
    //加载分页文件
    require_once($root_path . "/lib/db_page.php");

    $db = new MySql();

    //查询
    $wsql = "where 1=1";
    $username = $_SESSION['admin'];
    if ($username) {

        $wsql.=" and username like '%$username%'";
    }
//总计录数
    $sql = "select count(*) counts from tf_admin_log $wsql";

    $db->query($sql);
    $db->next_record();
    $infoCounts = $db->f("counts");
//分页类
    $p = new ShowPage;
//设置查询变量
    $p->setvar(array("username" => $username,
        "title" => $title,
        "keyword" => $queKeyWord)
    );
//设置每页显示条数
    $pagenums = 10;
    $p->set($pagenums, $infoCounts);
//输出分页
    $pageNav = $p->output(1);
//查询每几条到第几条
    $limits = $p->limit();
//册除用的.返回页面地址.
    $_SESSION['CURPAGE'] = $p->CurrentUrl;
    $sql = "select * from tf_admin_log  $wsql order by lastdate desc limit $limits";
    $db->query($sql);
    $arrInfo = array();
    $i = 0;
    ?>
    <div class="main" >
        <div class="content" >
            <div class="title">管理员登陆记录</div>
            <div class="imgButton">
            </div>
        </div>
        <div class="list">
            <table class="list" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr><td colspan="12" class="topTd" height="5"></td></tr>
                    <tr class="row">
                        <th >编号</th>
                        <th>登陆人</th>
                        <th  align="center">ip</th>
                        <th >操作动作</th>
                        <th >登陆时间</th>
                    </tr>
                    <?php
                    while ($db->next_record()) {
                        ?>
                        <tr >
                            <td ><?php echo $db->f("id") ?></td>
                            <td><?php echo $db->f("username") ?></td>
                            <td ><?php echo $db->f("ips") ?></td>
                            <td ><?php echo $db->f("info") ?></td>
                            <td ><?php echo $db->f("lastdate") ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>

                    <tr><td colspan="12" class="bottomTd" height="5"></td></tr></tbody></table>

        </div>
        <div class="page"><?php echo $pageNav; ?></div>
    </div>
