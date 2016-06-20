<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.
	常用函数
	$Id: Global.function.php 102 2008-04-14 05:32:47Z aming $
*/


/**
*分页函数
*
*
*/
function multi($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = TRUE, $simple = FALSE) {
	$multipage = '';
	$mpurl .= strpos($mpurl, '?') ? '&amp;' : '?';
	$realpages = 1;
	if($num > $perpage) {
		$offset = 2;

		$realpages = @ceil($num / $perpage);
		$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if($page > $pages) {
			$from = 1;
			$to = $pages;
		} else {
			$from = $curpage - $offset;
			$to = $from + $page - 1;
			if($from < 1) {
				$to = $curpage + 1 - $from;
				$from = 1;
				if($to - $from < $page) {
					$to = $page;
				}
			} elseif($to > $pages) {
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}

		$multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="'.$mpurl.'page=1" class="first"'.$ajaxtarget.'>1 ...</a>' : '').
			($curpage > 1 && !$simple ? '<a href="'.$mpurl.'page='.($curpage - 1).'" class="prev"'.$ajaxtarget.'>&lsaquo;&lsaquo;</a>' : '');
		for($i = $from; $i <= $to; $i++) {
			$multipage .= $i == $curpage ? '<strong>'.$i.'</strong>' :
				'<a href="'.$mpurl.'page='.$i.($ajaxtarget && $i == $pages && $autogoto ? '#' : '').'"'.$ajaxtarget.'>'.$i.'</a>';
		}

		$multipage .= ($curpage < $pages && !$simple ? '<a href="'.$mpurl.'page='.($curpage + 1).'" class="next"'.$ajaxtarget.'>&rsaquo;&rsaquo;</a>' : '').
			($to < $pages ? '<a href="'.$mpurl.'page='.$pages.'" class="last"'.$ajaxtarget.'>... '.$realpages.'</a>' : '').
			(!$simple && $pages > $page && !$ajaxtarget ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\''.$mpurl.'page=\'+this.value; return false;}" /></kbd>' : '');

		$multipage = $multipage ? '<div class="pages">'.(!$simple ? '<em>&nbsp;'.$num.'&nbsp;</em>' : '').$multipage.'</div>' : '';
	}
	$maxpage = $realpages;
	return $multipage;
}

function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}

function checkMust($must, $value) {
	if($must) {
		if(!$value) {
			msg('信息填写不完整');
			exit;
		}
	}
}

function showForm($type = '', $title = '', $options = '' ,$default = '', $msg = '' ,$name = '' ,$must = '') {
	$must = $must ? '<font color="red"> <b>*</b> </font>' : '';
	switch ($type) {
		case 'text':
			//文本框
			$option .= '<tr align="center"><td width="20%" align="right">'.$title.'</td><td align="left" style="padding-left:20px;"><input type="text" name="val'.$name.'" value="'.$default.'" /></td><td width="30%" align="left">'.$must.$msg.'</td></tr>';
			break;

		case 'hidden':
			//隐藏表单
			$option .= '<input type="hidden" name="val'.$name.'" value="'.$default.'" />';
			break;

		case 'file':
			//上传表单
			$option .= '<tr align="center"><td width="20%" align="right">'.$title.'</td><td align="left" style="padding-left:20px;"><input type="file" name="val'.$name.'" value="'.$default.'" /><input type="submit" name="upload"></td><td width="30%" align="left">&nbsp'.$msg.'</td></tr>';
			break;

		case 'select':
			//下拉菜单
			$option .= '<tr align="center"><td width="20%" align="right">'.$title.'</td><td align="left" style="padding-left:20px;"><select name="val'.$name.'">';
			$arr = explode("\n", $options);
			foreach($arr AS $k=>$val) {
                                
                                if($title=="报考级别" || $title=="培训类别")
                                {
                                    $vals = explode ('|',$val);
                                    $option .= '<option value="'.$val.'">'.$vals[0].'</option>';
                                }
                                else if($title=="其它费用")
                                {
                                    $vals = explode ('|',$val);
                                    $option .= '<option value="'.$val.'">'.$vals[0].'</option>';
                                }
                                else
                                    $option .= '<option value="'.$val.'">'.$val.'</option>';
			}
			$option .= '</select></td><td width="30%" align="left">'.$must.$msg.'</td></tr>';
			break;

		case 'checkbox':
			//复选框
			$option .= '<tr align="center"><td width="20%" align="right">'.$title.'</td><td align="left" style="padding-left:20px;">';
			$arr = explode("\n", $options);
			foreach($arr AS $k=>$v) {
				$option .= $v.'<input name="val'.$name.'[]" type="checkbox" value="'.$v.'" />&nbsp&nbsp&nbsp';
			}
			$option .= '</td><td width="30%" align="left">'.$must.$msg.'</td></tr>';
			break;

		case 'radio':
			//单选按钮
			$option .= '<tr align="center"><td width="20%" align="right">'.$title.'</td><td align="left" style="padding-left:20px;">';
			$arr = explode("\n", $options);
                        $i=0;
                        $j=0;
			foreach($arr AS $k=>$v) {
                            $option .= '<input type="radio" name="val'.$name.'" value="'.$v.'"/>'.$v.'&nbsp;&nbsp;&nbsp;&nbsp';
			}
                        $option .='</td><td width="30%" align="left">'.$must.'</td></tr>';
			//$option .= $must.'&nbsp'.$msg.'</td></tr>';
			break;

		case 'textarea':
			//文本区域
			$option .= '<tr align="center"><td width="20%" align="right">'.$title.'</td><td align="left" style="padding-left:20px;"><textarea name="val'.$name.'" cols="50" rows="10">'.$default.'</textarea></td><td width="30%" align="left">'.$must.$msg.'</td></tr>';
			break;
		case 'pass':
			//密码表单
			$option .= '<tr align="center"><td width="20%" align="right">'.$title.'</td><td align="left" style="padding-left:20px;"><input type="password" name="val'.$name.'" value="'.$default.'" /></td><td width="30%" align="left">'.$must.$msg.'</td></tr>';
			break;
		
		case 'submit' :
			$val = (!$options) ? '提 交' : $options;
			$option .= '<tr><td></td><td></td><td></td></tr><tr align="center"><td></td><td><input type="submit" style="width:80px;height:30px;" name="'.$title.'" value="'.$val.'"></td><td></td></tr>';
			break;

		case 'formhead' :
			$name = 'myform';
			$option .= '<form name="'.$name.'" method="post" enctype="multipart/form-data" action="'.$title.'">';
		break;

	}
	return $option;
	
}

$magic_quotes_gpc = get_magic_quotes_gpc();
@extract(daddslashes($_POST));
@extract(daddslashes($_GET));
if(!$magic_quotes_gpc) {
	$_FILES = daddslashes($_FILES);
}

function daddslashes($string, $force = 0)
{
	if(!$GLOBALS["magic_quotes_gpc"] || $force)
	{
		if(is_array($string))
		{
			foreach($string as $key => $val)
			{
				$string[$key] = daddslashes($val, $force);
			}
		}
		else
		{
			$string = addslashes($string);
		}
	}
	return $string;
}

function msg($msg,$back = '',$url = '') {
	if(empty($msg)) $msg = "出错";
	if(empty($back)) {
		echo "<script type='text/javascript'> alert('$msg');history.go(-1);</script>";
	}
	elseif ($back=="subok") {
		echo "<script type='text/javascript'> alert('$msg');</script>";
		echo "<script>location.href='$url';</script>";
	}
}

