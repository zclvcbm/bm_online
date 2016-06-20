<?
 $relativepath=$_SERVER['PHP_SELF'];
 $relativepath=substr($relativepath,0,strpos($relativepath,"admin"));

 $basepath='http://'.$_SERVER['HTTP_HOST'];

 $url=$basepath.$relativepath."login.php";

 echo "<script language='javascript' type='text/javascript'>"; 
 echo "window.location.href='$url'";
 echo "</script>"; 
?>
