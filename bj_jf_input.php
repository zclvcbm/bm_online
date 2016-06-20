<?php
require_once("data/dconfig.php");
require_once("lib/config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
<title></title>
<meta name="keywords" content="">
<meta name="description" content="">
<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
.notice{width:387px;margin:20px auto;height:26px;overflow:hidden;background:url() no-repeat;}
.noticTipTxt{color:#ff7300;height:22px;line-height:22px;overflow:hidden;margin:0 0 0 40px;}
.noticTipTxt li{height:22px;line-height:22px;}
.noticTipTxt a{color:#0075E8;font-size:12px;text-decoration:none;}
.noticTipTxt a:hover{color:#ff7300;text-decoration:underline;}
.button{
width: 140px;
line-height: 38px;
text-align: center;
font-weight: bold;
color: #fff;
text-shadow:1px 1px 1px #333;
border-radius: 5px;
margin:0 20px 20px 0;
position: relative;
overflow: hidden;
}
.button:nth-child(6n){
margin-right: 0;
}
.button.green{
border:1px solid #64c878;
box-shadow: 0 1px 2px #b9ecc4 inset,0 -1px 0 #6c9f76 inset,0 -2px 3px #b9ecc4 inset;
background: -webkit-linear-gradient(top,#90dfa2,#84d494);
background: -moz-linear-gradient(top,#90dfa2,#84d494);
background: linear-gradient(top,#90dfa2,#84d494);
}
</style>
<link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">

<body>    
<!--Header-->
   <div class="header">
    <div class="header_inner">
    <h1 class="logo">
      <a href="#"><img alt="" src="./images/logo.png"></a>      
    </h1>
    <ul class="nav"></ul>
    <div class="search"></div>
    <ul class="menu">      
      <li><a href="login.php">登录</a></li>
      <li></li>      
    </ul>
  </div>
</div>
<!--/Header-->

<div class="boxwrap">
  <div class="main_box">
    <h1 class="main_tit">
      报名查询
    </h1>
      <div class="type-list">
          
          <form action="bj_jf.php" method="post" onsubmit="return checkForm1()">
           <div align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;班级报名查询</b></div>考试名称：
          <select name="fid">
              <?php
                $today = "20".date('y-m-d',time());
                $db1 = new MySql();
                $kaoshi_sql = "select fname,k.fid,k.subs_time,k.sube_time from tf_kkhb k left join tf_form f on k.fid=f.fid  where printable=1 order by id desc";
                $fnames = $db1->getArray($kaoshi_sql);
                
                foreach ($fnames as $fname)
                {

                    $option = "<option value='" . $fname['fid'] . "'";
                    if($fname['subs_time']>$today || $fname['sube_time'] <$today)
                      $option = $option." disabled='disabled' >".$fname['fname']."</option>";
                    else
                      $option = $option." >".$fname['fname']."</option>";
                    echo $option;
                }
              ?>  
          </select>
          &nbsp;&nbsp;班号：<input name="classid" type="text" id="classid"></input>
          &nbsp;&nbsp;<input type="submit" value="查询"></input><br/>
          </form>
      </div>
      
      
      
      <!-- //暂时隐藏个人交费
      <div class="type-list">
          <form action="bj_jf1.php" method="post">
          <div align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;个人报名查询</b></div>&nbsp;&nbsp;&nbsp;&nbsp;考试名称：
          <select name="fid">
              <?php
                $today = "20".date("y-m-d",time());
                $db1 = new MySql();
                $kaoshi_sql = "select fname,k.fid,k.subs_time,k.sube_time from tf_kkhb k left join tf_form f on k.fid=f.fid  where printable=1 order by id desc";
                $fnames = $db1->getArray($kaoshi_sql);

                foreach ($fnames as $fname) 
                {
                    $option = "<option value='" . $fname['fid'] . "'";
                    if($fname['subs_time']>$today || $fname['sube_time'] <$today)
                      $option = $option." disabled='disabled' >".$fname['fname']."</option>";
                    else
                      $option = $option." >".$fname['fname']."</option>";
                    echo $option;
                }
              ?>  
          </select>
          &nbsp;&nbsp;身份证号：<input name="sfzh" type="text" id="sfzh" readonly="readonly"></input>
          &nbsp;&nbsp;<input type="submit" value="查询"></input><br/>
          </form>
          <div class="clear">
          </div>
      </div>
      -->
      
      
      
    <div class="clear"></div>
  </div>
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
    


<script type="text/javascript" src="./js/scrolltext.js"></script>
<script type="text/javascript">

if(document.getElementById("jsfoot01")){
	var scrollup = new ScrollText("jsfoot01");
	scrollup.LineHeight = 22;      
	scrollup.Amount = 1;         
	scrollup.Delay = 20;          
	scrollup.Start();            
	scrollup.Direction = "down"; 
}

if(document.getElementById("jsfoot02")){
	var scrollup = new ScrollText("jsfoot02");
	scrollup.LineHeight = 22;      
	scrollup.Amount = 1;      
	scrollup.Delay = 20;           
	scrollup.Start();             
	scrollup.Direction = "up";   
}

function checkForm1()
{
    if(document.getElementById('classid').value==="")
    {
        alert("班号不能为空！");
        return false;
    }
}

function checkForm2()
{
    if(document.getElementById('sfzh').value==="")
    {
        alert("身份证号不能为空！");
        return false;
    }
}

</script> 

</body>
</html>
