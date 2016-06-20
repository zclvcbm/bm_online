<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0046)http://eems.hbsoft.net/user/photoUpload/?act=2 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="./css/global.css" rel="stylesheet" type="text/css">
<link href="./css/eems1.css" rel="stylesheet" type="text/css">
<link href="./css/reset.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/jquery.min.js"></script>
<style type="text/css">
#top_eems_1{
	background-color:#09C;
	}
#top_block{
	background-color:#09C;
	}
.side_nav_title1{
	background-color:#09C;
	}
#bot_eems_1{
	background-color:#09C;
	}
.main_tit{border-bottom:1px solid #EEE;color:#444;font-size:18px;margin:0 0 20px;padding:0 0 10px;}
</style>
</head>
<?php
        require_once("data/dconfig.php");
        require_once("lib/config.php");
        require_once './ifuser.php';

	$x= rand (0,100);

        session_start();
        
        $uid = $_SESSION['uid'];
        
        $db = new MySql();
        $sql = "select * from tf_users where uid=$uid ";
        $user = $db->getOne($sql);
        
        //print_r($user);
        if($user['stat']==0&&$user['pic']=="")
            $act=0;
        else if($user['stat']==0&& !empty($user['pic']))
            $act=1;
        else if($user['stat']==1)
            $act=2;
        else
            $act=3;
 //       $act=1;
 ?>
<body>
<h1 class="main_tit">
<span></span>上传/查看电子照片
</h1>
<div id="page_eems_1">
    <div id="main_eems_1_right">
        <?php
            if($act==0)
            {
                echo '<div id="main_block1">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><table width="100%%" border="0" cellspacing="0" cellpadding="0" class="table_line1">
                                <tbody>
                                    <tr>
                                        <td width="25%" height="40" align="right">&nbsp;</td>
                                        <td width="5%" height="40">&nbsp;</td>
                                        <td width="45%" height="40" class="black18"><strong>上传电子照片</strong></td>
                                        <td width="25%" height="40">&nbsp;</td>
                                    </tr>
                                    <form action="pic_sub.php" method="post" enctype="multipart/form-data">
                                    <tr>
                                        <td width="35%" height="40" align="right" class="black105">请选择要上传的电子照片文件</td>
                                        <td width="5%" height="40">&nbsp;</td>
                                        <td width="45%" height="40"><input name="pic" type="file" class="form2" id="fileField" size="36" maxlength="128"></td>
                                        <td width="15%" height="40">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" height="40" align="right" class="black105">可上传文件的类型</td>
                                        <td width="5%" height="40">&nbsp;</td>
                                        <td width="45%" height="40">
                                            .jpg
                                        </td>
                                        <td width="25%" height="40">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" height="40" align="right" class="black105">可上传文件的体积</td>
                                        <td width="5%" height="40">&nbsp;</td>
                                        <td height="40" colspan="2">100Kb 超过此容量的照片将上传失败，照片无法显示，审核也将不合格。</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" height="40" align="right" class="black105">&nbsp;</td>
                                        <td width="5%" height="40">&nbsp;</td>
                                        <td width="45%" height="40"><input type="submit" name="button" id="button" value="上传所选文件"></td>
                                        <td width="25%" height="40">&nbsp;</td>
                                    </tr>
                                    </form>
                                    <tr>
                                        <td width="25%" height="150" align="right" class="black105">电子照片要求</td>
                                        <td width="5%" height="150">&nbsp;</td>
                                        <td height="150" colspan="2">
                                            <p>上传的照片将用于各类考试的准考证、证书等，请务必慎重上传，只接受正规照像馆所拍摄的照片。
											1、照片宽与高的比例为2:3；宽不小于150像素、高不小于200像素。<br>
                                               2、照片底色必须为浅蓝色。<br>
                                               3、照片须为*.jpg格式(jpg为小写字母)<br>
                                               4、照片文件容量大小不小于50kb不大于150KB<br>
                                               5、须为显示近期、免冠、正面的证照相。<br>
                                               6、成像须自然、清晰。不可由低尺寸（低分辨率）照片拉大；不可由其它照片"扣图"粘贴。<br>
                                               7、头部高度占照片高度的比例不低于1/2。<br>
                                               8、长刘海或长发者须整理好头发勿遮挡五官。<br />
											   9、允许上传使用扫描仪扫描纸质登记照片得到的电子档，但必须符合上述要求；不接受使用手机及其它设备翻拍纸质登记照片得到的电子档；上传的照片不能有明显PS的痕迹。
                                               </p>
                                         </td>
                                        </tr>
                                        <tr>
                                            <td height = "80" colspan = "4" align = "center" class = "black105"><img src = "./images/photo_rule.jpg" width = "500" height = "400"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                </div>';
                }
                else if($act==1)
                {
                    echo '<div id="main_block1">
                            <table width="100%%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                              <td>&nbsp;</td>
                              </tr>

                            <tr>
                              <td><table width="100%%" border="0" cellspacing="0" cellpadding="0" class="table_line1">

                                <tbody><tr>
                                  <td width="25%" height="40" align="right">&nbsp;</td>
                                  <td width="5%" height="40">&nbsp;</td>
                                  <td width="45%" height="40" class="black18"><strong>上传/查看电子照片</strong></td>
                                  <td width="25%" height="40">&nbsp;</td>
                                  </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">电子照片状态</td>
                                  <td width="5%" height="40">&nbsp;</td>
                                  <td width="45%" height="40"><span class="blue105">照片已上传，等待审核，12小时内审核完毕，请耐心等待。</span></td>
                                  <td width="25%" height="40">&nbsp;</td>
                                  </tr>
                                <tr>
                                  <td width="25%" height="230" align="right" class="black105">电子照片显示</td>
                                  <td width="5%" height="230">&nbsp;</td>
                                  <td width="45%" height="230">
                                          <img src="./'.$user["pic"].'?rand='.$x.' " width="140" height="210">
					 
                                  </td>
                                  <td width="25%" height="230"><p>如更新上传后仍显示原图片</p>
                                      <p>请按 <strong><span class="red105">F5</span></strong> 键刷新本页面</p></td>
                                  </tr>
                                  <tr>
                                    <td width="25%" height="40" align="right" class="black105">更改电子照片</td>
                                    <td width="5%" height="40">&nbsp;</td>
                                    <td width="45%" height="40">
                                        <form method="POST" name="picform" id="picform" action="pic_sub.php" enctype="multipart/form-data">
                                            <input type="file" name="pic" id="pic">
                                            <input type="hidden" name="reupload" value="1">
                                        </form>  
                                    </td>
                                    <td width="25%" height="40"></td>
                                 </tr>
                                  </tbody></table></td>
                              </tr>

                            <tr>
                              <td>&nbsp;</td>
                              </tr>
                            </tbody></table>
                          </div>';
                }
                else if($act==2)
                {
                    echo '<div id="main_block1">
                            <table width="100%%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                              <td><table width="100%%" border="0" cellspacing="0" cellpadding="0" class="table_line1">
                                <tbody>
                                <tr>
                                  <td width="25%" height="40" align="right">&nbsp;</td>
                                  <td width="5%" height="40">&nbsp;</td>
                                  <td width="45%" height="40" class="black18"><strong>上传/查看电子照片</strong></td>
                                  <td width="25%" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">电子照片状态</td>
                                  <td width="5%" height="40">&nbsp;</td>
                                  <td width="45%" height="40"><span class="blue105">照片已上传，经审核合格，不可修改。</span></td>
                                  <td width="25%" height="40">&nbsp;</td>
                                  </tr>
                                <tr>
                                  <td width="25%" height="230" align="right" class="black105">电子照片显示</td>
                                  <td width="5%" height="230">&nbsp;</td>
                                  <td width="45%" height="230">
                                          <img src="./'.$user["pic"].'" width="140" height="210">
                                  </td>
                                  <td width="25%" height="230"><p>如更新上传后仍显示原图片</p>
                                      <p>请按 <strong><span class="red105">F5</span></strong> 键刷新本页面</p></td>
                                 </tr>
                                 <tr height="95">
                                 </tr>
                                  </tbody>
                                  </table>
                                  </td>
                              </tr>
                            <tr>
                              <td>&nbsp;</td>
                              </tr>
                            </tbody></table>
                          </div>';
                }elseif ($act==3) {
                    echo '<div id="main_block1">
                            <table width="100%%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                              <td>&nbsp;</td>
                              </tr>

                            <tr>
                              <td><table width="100%%" border="0" cellspacing="0" cellpadding="0" class="table_line1">

                                <tbody><tr>
                                  <td width="25%" height="40" align="right">&nbsp;</td>
                                  <td width="5%" height="40">&nbsp;</td>
                                  <td width="45%" height="40" class="black18"><strong>上传/查看电子照片</strong></td>
                                  <td width="25%" height="40">&nbsp;</td>
                                  </tr>
                                <tr>
                                  <td width="25%" height="40" align="right" class="black105">电子照片状态</td>
                                  <td width="5%" height="40">&nbsp;</td>
                                  <td width="45%" height="40"><span class="blue105">照片已上传，<font color="red">审核不合格</font>，请重新上传。请务必到正规照像馆拍摄符合要求的登记照，并上传电子档，如审核再不合格，将不再进行审核</span></td>
                                  <td width="25%" height="40">&nbsp;</td>
                                  </tr>
                                <tr>
                                  <td width="25%" height="230" align="right" class="black105">电子照片显示</td>
                                  <td width="5%" height="230">&nbsp;</td>
                                  <td width="45%" height="230">

                                          <img src="./'.$user["pic"].'" width="140" height="210">
                                  </td>
                                  <td width="25%" height="230"><p>如更新上传后仍显示原图片</p>
                                      <p>请按 <strong><span class="red105">F5</span></strong> 键刷新本页面</p></td>
                                  </tr>
                                  <tr>
                                    <td width="25%" height="40" align="right" class="black105">更改电子照片</td>
                                    <td width="5%" height="40">&nbsp;</td>
                                    <td width="45%" height="40">
                                        <form method="POST" name="picform" id="picform" action="pic_sub.php" enctype="multipart/form-data">
                                            <input type="file" name="pic" id="pic">
                                            <input type="hidden" name="reupload" value="1">
                                        </form>  
                                    </td>
                                    <td width="25%" height="40"></td>
                                 </tr>
                                  </tbody></table></td>
                              </tr>

                            <tr>
                              <td>&nbsp;</td>
                              </tr>
                            </tbody></table>
                          </div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
    	$('#pic').change(function(){
    		$('#picform').submit();
    	})
    })
    </script>
</body>
</html>