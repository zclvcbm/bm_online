<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>报名系统</title>
        <meta name="keywords" content="报名系统">
        <meta name="description" content="报名系统！">
        <meta content="报名系统" name="keywords">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link media="screen" type="text/css" href="css/style.css" rel="stylesheet">
    </head>
<?php
        require_once("data/dconfig.php");
        require_once("lib/config.php");
        require_once './ifuser.php';
        session_start();
        
        $uid = $_SESSION['uid'];
        
        $db = new MySql();
        $sql = "select * from tf_users where uid=$uid ";
        $user = $db->getOne($sql);
        $sql = "select * from tf_user_log where username='$user[username]' order by lastdate desc";
        $log = $db->getOne($sql);
    ?> 


<h1 class="main_tit">
<span></span>用户中心 <strong>(请完善个人资料，再提交报名信息)</strong>
</h1>
<!--会员中心-->
<div class="main_head">
    <div class="avatarbox">
        <img src="<?php echo $user['pic']==""?"./images/pic.jpg":$user['pic']; ?>">
            <?php
            if ($user['stat'] == 0 || $user['stat'] == 2) {
                echo '<span><a href="pic.php">设置头像</a></span>';
            }
            ?>
    </div>
    <div class="tips_box">
        <h3>
            尊敬的<span class="red"><?php echo $user['name']; ?></span>，欢迎您！</h3>
        <dl>
            <dt>用户编号：</dt>
            <dd><?php echo $uid; ?></dd>
        </dl>
        <dl>
            <dt>信息审核状态：</dt>
            <dd>
                <span style="color:Green;">
                    <?php
                    if ($user['stat'] == 0)
                        echo "未审核";
                    else if ($user['stat'] == 1)
                        echo "审核通过";
                    else if ($user['stat'] == 2)
                        echo "审核未通过";
                    ?>
                </span>
            </dd>
        </dl>
        <dl>
            <dt>本次登录IP：</dt>
            <dd>
                <?php if ($_SERVER["REMOTE_ADDR"] == "::1") echo "127.0.0.1";
                else echo $_SERVER["REMOTE_ADDR"]; ?></dd>
        </dl>
        <dl>
            <dt>上次登录IP：</dt>
            <dd><?php if ($log['ips'] == "::1") echo "127.0.0.1"; ?></dd>
        </dl>
        <dl>
            <dt>注册时间：</dt>
            <dd><?php echo $user[regtime]; ?></dd>
        </dl>
        <dl>
            <dt>上次登录时间：</dt>
            <dd><?php echo $log['lastdate']; ?></dd>
        </dl>
        <div class="red" style="padding-left:0px; font-size:16px;color: red">
            <?php
                if($user['stat']==1)
                    echo "您已通过审核，请打印您的报名表信息，交纳报考费用,等待考试通知!";
                else
                    echo "请完善补充填写个人基本信息及照片！";
            ?>
            
        </div>
    </div>
</div>
<div class="main_box" style="clear: both">
</div>
                    