<?php
require_once("../../data/dconfig.php");
require_once("../../lib/config.php");
require_once '../ifadmin.php';

$sql = "select id,uid,pic from tf_users where (stat=0 or stat=2) and issub=1";
$db = new MySql();
$db2 = new Mysql();
$db->query($sql);
while($user=$db->next_record())
{
    $pic_init = $db->Record['pic'];
    $id = $db->Record['id'];
    $pic_passed = str_replace("init", "passed", $pic_init);
    $pic_unpassed = str_replace("init", "unpassed", $pic_init);

    if(! empty($pic_unpassed) && file_exists("../../".$pic_unpassed))
    {
        $sql = "update tf_users set stat=2 where id=".$id;
        $db2->query($sql);
    }

    if(!empty($pic_passed) && file_exists("../../".$pic_passed))
    {
        $sql = "update tf_users set stat=1 where id=".$id;
        $db2->query($sql);
    }
    else
    {
        
    } 
	
}

showmessage_go("更新完成！","user_list.php");
?>
