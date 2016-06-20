<link href="style/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" language="javascript" src="js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="js/top.js"></script>
<script language="javascript">
     var t = null;
    t = setTimeout(time,1000);//开始执行
    function time()
    {
       clearTimeout(t);//清除定时器
       dt = new Date();
       var h=dt.getHours();
       var m=dt.getMinutes();
       var s=dt.getSeconds();
       document.getElementById("timeShow").innerHTML =  "现在的时间为："+h+"时"+m+"分"+s+"秒";
       t = setTimeout(time,1000); //设定定时器，循环执行             
    } 
  </script>
<div class="top">
<div class="toplogo"></div>

<div class="nav">
<ul>
<li class="now_time">
<label id="timeShow"></lable>
</li>
<li class="now_out"> <a href="personal/adminexit.php" target="_top">安全退出</a></li>

</ul>
</div>
</div>

