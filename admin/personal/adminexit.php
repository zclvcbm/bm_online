<?php
@session_start();
$_SESSION['admin']="";
echo "<script>window.location.href='../login.php';</script>";
?>