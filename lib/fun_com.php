<?php
//从数组$ary各元素组成数据集合,用于元素 in 集合
function getdatasetfromarray($ary){
	$sum = count($ary);
	$set = "(";
	for($i = 0;$i<$sum;$i++){
		$ss = $ary[$i];
		$set = ($set=="(")?$set."'$ss'":$set.",'$ss'";
	}
	$set = $set.")";
	if($set=="()") $set = "(null)";
	return $set;
}
function cnSubStr($string,$sublen) 
{ 
	if($sublen>=strlen($string)) 
	{ 
		return $string; 
	} 
	$s=""; 
	for($i=0;$i<$sublen;$i++) 
	{ 
		if(ord($string{$i})>127) 
		{ 
		$s.=$string{$i}.$string{++$i}; 
		continue; 
		}else{ 
		$s.=$string{$i}; 
		continue; 
		} 
	}
	$s.="..."; 
	return $s; 
}
//post数据，转成插入，更新语句 $tablef表结构 二维,$data POST数据，$udate 为空不更新，$mdate有些这段不操作
function getIU($tablef,$data,$id,$udate=array(),$mdate=array()){
	$iname="";
	$inamev="";
	$uname="";
	$rmsg=array();
   foreach ($tablef as $key=>$val){
    	$keyn=$val['name'];
    	$vo=$data[$keyn];
    	if(isset($data[$keyn]) && $keyn!="id") {
    			//默认转化
    			if($val['type']=='int'){
    				$vo=intval($vo);
    			}
    			if($val['type']=='real'){
    				$vo=floatval($vo);
    			}
    			if($val['type']=='datetime'){
    				if(strlen($vo)>16 && strlen($vo)<20){
    					
    				}else{
    					$vo=date('Y-m-d H:i:s',time());
    				}
    			}
    			//$mdate有些这段不操作
    			if(in_array($keyn,$mdate)){
    				continue;
    			}
    			//为空不更新
    			if ($id) {
    				if(in_array($keyn,$udate) && empty($vo)){	    				
		    		}else{
		    			if($uname==""){
			    			$uname.=$keyn."='".$vo."'";
		    			}else{
				    		$uname.=",".$keyn."='".$vo."'";
			    		}
		    		}
	    		}else{
		    		if($iname==""){
	    				$iname.=$keyn;
		    			$inamev.="'".$vo."'";
	    			}else{
			    		$iname.=",".$keyn;
			    		$inamev.=",'".$vo."'";
		    		}
	    		}	    		
    	}        
    }
    $rmsg[0] = $iname;
    $rmsg[1] = $inamev;
    $rmsg[2] = $uname;
    return $rmsg;
}
//返回查询
function getSearch($search){
	$wsql="where 1=1";
	$rmsg=array();
	$tmpar=array();
	foreach ($search as $key=>$val){
		$tmpv=$_REQUEST[$key];
                if($tmpv === 0);
                    $tmpv .=",1"; 
		if(!$tmpv){
			$tmpv=$_GET[$key];
		}
		
		if($tmpv){
                    $tmpvs = explode(',', $tmpv);
                    $tmpv = $tmpvs[0];
			
			if($val=="="){
				if($key = "stats"){
					$wsql.=" and stat ='".$tmpv."' ";
				}else{
					$wsql.=" and ".$key." ='".$tmpv."' ";
				}
				
			}else{
				$wsql.=" and $key like '%$tmpv%'";
			}
			$tmpar[$key]=$tmpv;
		}
		
	}
    $rmsg[0] = $wsql;
    $rmsg[1] = $tmpar;
    return $rmsg;
}
//文件权限判断
function admin_pvi($action_list){
	$see_action_list=$_SESSION['action_list'];
	if($_SESSION['adminmax']==1){
		return true;
	}	
	if(in_array($action_list,$see_action_list)){
		return true;
	}else{
		showmessage_go("对不起，没有权限");
	}
}
//一级权限判断
function menu_pvi($action_list,$menu_arr){
	$see_action_list=$_SESSION['action_list'];
	$menu_new=array();
	foreach ($menu_arr AS $key => $v)
    {
    	if($_SESSION['adminmax']==1 and $v['listok']==1){
			$menu_new[$key]=$menu_arr[$key];
		}elseif(in_array($v['action'],$see_action_list)  and $v['listok']==1){
    		$menu_new[$key]=$menu_arr[$key];
    	}else{
    		
    	}
    }
     return $menu_new;
}
//二三级权限判断
function menu_pvi2($menu_arr1,$menu_arrc,$menuid){
	$menu_new=array();
	$see_action_list=$_SESSION['action_list'];
	foreach ($menu_arr1 AS $key => $val)
	{
		if($val['pid']==$menuid){
			//权限
			if((in_array($val['action'],$see_action_list) || $_SESSION['adminmax']==1) and $val['listok']==1){
				$menu_new[$key]=$val;
				foreach ($menu_arrc AS $key2 => $val2)
				{
					if($val2['pid']==$key){
						if((in_array($val2['action'],$see_action_list) || $_SESSION['adminmax']==1) and $val2['listok']==1){
							$menu_new[$key]['children'][$key2] = $val2;
						}
					}
				}
			}
			
		}
	}
    return $menu_new;
}
?>