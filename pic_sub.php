<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<?php
/******************************************************************************

参数说明:
$max_file_size  : 上传文件大小限制, 单位BYTE
$destination_folder : 上传文件路径
$watermark   : 是否附加水印(1为加水印,其他为不加水印);

使用说明:
1. 将PHP.INI文件里面的"extension=php_gd2.dll"一行前面的;号去掉,因为我们要用到GD库;
2. 将extension_dir =改为你的php_gd2.dll所在目录;
******************************************************************************/

//上传文件类型列表
$uptypes=array(
    'image/jpg',
    'image/jpeg',
    'image/pjpeg'
    /*'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
    'image/x-png'
     */
     
);

$min_file_size=51200;      //上传文件大小限制最小, 单位BYTE
$max_file_size=153600;     //上传文件大小限制最大, 单位BYTE
$destination_folder="upload/init/"; //上传文件路径
$destination_folder_copy="upload/init_copy/"; //上传文件路径_copy
$watermark=1;      //是否附加水印(1为加水印,其他为不加水印);
$watertype=1;      //水印类型(1为文字,2为图片)
$waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
$waterstring="";  //水印字符串
$waterimg="";    //水印图片
$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);
$imgpreviewsize=1/2;    //缩略图比例
$overwrite=1;
?>
<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once 'lib/fun_html.php';
require_once './ifuser.php';

$fname = $_FILES["pic"]["name"]; 
$fname_array = explode('.',$fname); 
$extend = $fname_array[count($fname_array)-1]; 

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //echo $_FILES["pic"][tmp_name];
    if (!is_uploaded_file($_FILES["pic"][tmp_name]))
    //是否存在文件
    {
         showmessage_go("图片不存在!");
    }

    $file = $_FILES["pic"];
    if($max_file_size < $file["size"])
    //检查文件大小
    {
        showmessage_go("图片目录有权限，图片过大!");
    }
    if($min_file_size > $file["size"])
    //检查文件大小
    {
        showmessage_go("图片目录有权限，图片过小!");
    }
    if(!in_array($file["type"], $uptypes))
    //检查文件类型
    {
        showmessage_go("文件类型不符!".$file["type"]);
    }
    if($extend!='jpg' and $extend!='JPG')//岳新国加and $extend!='JPG'
    //检查文件类型
    {
        showmessage_go("文件类型不符!只支持.jpg或.JPG 格式，您当前照片格式为：".$extend);
    }

    if(!file_exists($destination_folder))
    {
        mkdir($destination_folder);
	mkdir($destination_folder_copy);
    }

    $filename=$file["tmp_name"];
    $image_size = getimagesize($filename);
    $width = $image_size[0];
    $height = $image_size[1];
    
    if($width>$height)
    {
        showmessage_go("您上传照片的横纵比不合要求！");
    }
    
    if($width<150)
    {
        showmessage_go("图像宽不能小于150像素！");
    }
    if($height<200)
    {
        showmessage_go("图像高不能小于200像素！");
    }
    
    $pinfo=pathinfo($file["name"]);
    $ftype=$pinfo['extension'];
	$ftype=str_replace("JPG", "jpg", $ftype);
    $destination = $destination_folder.$_SESSION['username'].".".$ftype;
    $destination_copy = $destination_folder_copy.$_SESSION['username'].".".$ftype;
    if (file_exists($destination) && $overwrite != true)
    {
        showmessage_go("同名文件已经存在了");
    }

    if(!move_uploaded_file ($filename, $destination))
    {
        showmessage_go("移动文件出错!");
    }

    copy($destination,$destination_copy);
	

    $pinfo=pathinfo($destination);
    $fname=$pinfo[basename];
    echo " <font color=red>已经成功上传</font><br>文件名:  <font color=blue>".$destination_folder.$fname."</font><br>";
    echo " 宽度:".$image_size[0];
    echo " 长度:".$image_size[1];
    echo "<br> 大小:".$file["size"]." bytes";

   /*
    if($watermark==1)
    {
        $iinfo=getimagesize($destination,$iinfo);
        $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
        $white=imagecolorallocate($nimage,255,255,255);
        $black=imagecolorallocate($nimage,0,0,0);
        $red=imagecolorallocate($nimage,255,0,0);
        imagefill($nimage,0,0,$white);
        switch ($iinfo[2])
        {
            case 1:
            $simage =imagecreatefromgif($destination);
            break;
            case 2:
            $simage =imagecreatefromjpeg($destination);
            break;
            case 3:
            $simage =imagecreatefrompng($destination);
            break;
            case 6:
            $simage =imagecreatefromwbmp($destination);
            break;
            default:
            die("不支持的文件类型");
            exit;
        }

        imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
        imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);

        switch($watertype)
        {
            case 1:   //加水印字符串
            imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
            break;
            case 2:   //加水印图片
            $simage1 =imagecreatefromgif("xplore.gif");
            imagecopy($nimage,$simage1,0,0,0,0,85,15);
            imagedestroy($simage1);
            break;
        }

        switch ($iinfo[2])
        {
            case 1:
            //imagegif($nimage, $destination);
            imagejpeg($nimage, $destination);
            break;
            case 2:
            imagejpeg($nimage, $destination);
            break;
            case 3:
            imagepng($nimage, $destination);
            break;
            case 6:
            imagewbmp($nimage, $destination);
            //imagejpeg($nimage, $destination);
            break;
        }

        //覆盖原上传文件
        imagedestroy($nimage);
}    
  */

    session_start();
    $uid = $_SESSION['uid'];
    $db = new MySql();
    $sql = "select pic from tf_users where uid = $uid ";
    $result = $db->getOne($sql);
    //print_r($result);

    $pic = $result['pic'];
    /*
    if (file_exists("./".$pic)) {
        $pic_copy = $pic;
        $result=unlink ($pic);
        
        $pic_copy = str_replace("init", "init_copy", $pic_copy);
        unlink ($pic_copy);
    }
     * 
     */
    if($_POST['reupload']==1)
    {
        
        
        $sql = "update tf_users set pic='$destination',stat=0 where uid = $uid ";

        $sql = str_replace("'","\"",$sql);
        $ip = ip();
        $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[username]','$ip','update','$sql',now())";
                
        $db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
        $result = $db->query($sql);
        $res = $db->query($data_sql);
        /*
        $count = $db->affected_rows();
        if($count >= 1)
        {
            location('pic.php');
        }
        else
        {
            showmessage("上传图片失败！");
            location('pic.php');
        }
         */
        if ($result > 0) {
            $db->query("COMMIT");
            location('pic.php');
        } else {
            $db->query("ROLLBACK");
        }
        
    }
    else
    {
        $sql = "update tf_users set pic='$destination' where uid = $uid ";
        $db->query($sql);
        $count = $db->affected_rows();
    
        if($count >= 1)
        {
            location('pic.php');
        }
        else
        {
            showmessage("上传图片失败！");
            location('pic.php');
        }
    }
    
}
?>
