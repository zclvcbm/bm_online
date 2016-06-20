<?php

include_once '../../crypt/crypt.php';
//上传文件类型列表
//上传文件类型列表
$uptypes=array(
    'image/jpg',
    'image/jpeg',
     'image/pjpeg'
    /*
    'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
    'image/x-png'
     */
     
);

$max_file_size=102400;     //上传文件大小限制, 单位BYTE
$destination_folder="../../upload/init/"; //上传文件路径
$watermark=1;      //是否附加水印(1为加水印,其他为不加水印);
$watertype=1;      //水印类型(1为文字,2为图片)
$waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
$waterstring="";  //水印字符串
$waterimg="";    //水印图片
$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);
$imgpreviewsize=1/2;    //缩略图比例

require_once("../data/dconfig.php");
require_once("../lib/config.php");
require_once './ifadmin.php';
require_once '../fun.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!is_uploaded_file($_FILES["pic"][tmp_name]))
    //是否存在文件
    {
         showmessage_go("图片不存在!");
    }

    $file = $_FILES["pic"];
    if($max_file_size < $file["size"])
    //检查文件大小
    {
        showmessage_go("文件太大!");
    }

    if(!in_array($file["type"], $uptypes))
    //检查文件类型
    {
        showmessage_go("文件类型不符!".$file["type"]);
    }

    if(!file_exists($destination_folder))
    {
        mkdir($destination_folder);
    }

    $filename=$file["tmp_name"];
    $image_size = getimagesize($filename);
    $width = $image_size[0];
    $height = $image_size[1];
    
    if($width>$height)
    {
        showmessage_go("您上传照片的横纵比不合要求！");
    } 
    
    if($width<140)
    {
        showmessage_go("图像宽不能小于140像素！");
    }
    if($height<210)
    {
        showmessage_go("图像高不能小于210像素！");
    }
    
    $pinfo=pathinfo($file["name"]);
    $ftype=$pinfo['extension'];
    $destination = $destination_folder.time().".".$ftype;
    if (file_exists($destination) && $overwrite != true)
    {
        showmessage_go("同名文件已经存在了");
    }

    if(!move_uploaded_file ($filename, $destination))
    {
        showmessage_go("移动文件出错");
    }
    
}
    
$db = new MySql();
$db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
$table = "tf_users";
$name = trim($_POST['name']);
$username = str_replace(' ', '',$_POST['username']);
$password = encrypt(trim($_POST['password']));
$age = substr($username, 6, 4).'-'.substr($username, 10, 2).'-'.substr($username, 12, 2);
$vlidate = substr($username, 14, 3);
if ($vlidate % 2 == 1)
    $sex = "男";
else
    $sex = "女";
$tel = trim($_POST['tel']);
$qq = $_POST['qq'];
$zgxl = $_POST['zgxl'];
$zgxw = $_POST['zgxw'];
$address = $_POST['address'];
$stat = $_POST['stat'];
$studentid = str_replace(' ', '',trim($_POST['studentid']));
$classid = str_replace(' ', '',trim($_POST['classid']));
$uid = date('Y')."".rand(1000, 9999);
$email = $_POST['email'];
$pic = $destination;
$folk = $_POST['folk'];

$sql = 'insert into '.$table.'(name,username,uid,studentid,classid,password,sex,age,folk,tel,qq,email,zgxl,zgxw,address,stat,regtime,pic)  
    values("'.$name.
        '","'.$username.
        '",'.$uid.
        ',"'.$studentid.
        '","'.$classid.
        '","'.$password.
        '",'.$sex.
        ',"'.$age.
        '","'.$folk.
        '","'.$tel.
        '","'.$qq.
        '","'.$email.
        '","'.$zgxl.
        '","'.$zgxw.
        '","'.$address.
        '",'.$stat.
        ',now(),"'.$pic.'")';
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','insert','$sql',now())";
$db->query($data_sql);
$db->query($sql);

if ($db->affected_rows()>0) {
    $db->query("COMMIT");
    echo "<script type='text/javascript'> alert('考生信息添加成功！');</script>";
    echo "<script>location.href='user_list.php';</script>";
}
else
{
    $db->query("ROLLBACK");
    echo "<script type='text/javascript'> alert('考生信息添加失败!');history.go(-1);</script>";
}

?>