<?php

//输出$n个html回车换行
function htm_enter($n) {
    for ($i = 0; $i < $n; $i++) {
        echo "<br>";
    }
}

//输出$n个php回车换行
function php_enter($n) {
    for ($i = 1; $i <= $n; $i++) {
        echo chr(13);
    }
}

//得到$n个html回车换行
function get_htm_enter($n) {
    $enter = "";
    for ($i = 0; $i < $n; $i++) {
        $enter .= "<br>";
    }
    return $enter;
}

//得到$n个php回车换行
function get_php_enter($n) {
    $enter = "";
    for ($i = 1; $i <= $n; $i++) {
        $enter .= chr(13);
    }
    return $enter;
}

//输出内容后换行
function php_println($content) {
    print $content . get_php_enter(1);
}

function htm_println($content) {
    print $content . get_htm_enter(1);
}

function get_php_println($content) {
    return $content . get_php_enter(1);
}

function get_htm_println($content) {
    return $content . get_htm_enter(1);
}

//输出php$n个空格
function php_space($n) {
    for ($i = 1; $i <= $n; $i++) {
        echo chr(12);
    }
}

//输出html$n个空格
function htm_space($n) {
    for ($i = 1; $i <= $n; $i++) {
        echo "&nbsp;";
    }
}

//得到hmtl$n个空格
function get_htmspace($n) {
    $space = "";
    for ($i = 1; $i <= $n; $i++) {
        $space = $space . "&nbsp;";
    }
    return $space;
}

//得到php$n个空格
function get_phpspace($n) {
    $space = "";
    for ($i = 1; $i <= $n; $i++) {
        $space = $space . chr(12);
    }
    return $space;
}

//弹出提示信息.
function showmessage($message) {
    echo "<SCRIPT LANGUAGE=JavaScript>";
    echo "alert(\"$message\")";
    echo "</SCRIPT>";
}

//弹出提示信息.
function showmessage_go($message) {
    echo "<SCRIPT LANGUAGE=JavaScript>";
    echo "alert(\"$message\");";
    echo "history.go(-1);";
    echo "</SCRIPT>";
    exit;
    return "false";
}

//如果变量为空,弹出提示信息.退出.
function showmessage_go_var($message, $variable, $variable2 = 1, $variable3 = 1) {
    //如果变量为空
    if (!$variable || !$variable2 || !$variable3) {
        echo "<SCRIPT LANGUAGE=JavaScript>";
        echo "alert(\"$message\");";
        echo "history.go(-1);";
        echo "</SCRIPT>";
        exit;
    }
}

//成功返回信息.
function success($smarty, $pagetitle, $message, $url) {
    $smarty->assign("pagetitle", $pagetitle);
    $smarty->assign("message", $message);
    $smarty->assign("url", $url);
    $smarty->display('success.tpl');
    return "false";
}

//定位到$target页面
function location($target) {
    echo "<SCRIPT LANGUAGE='JavaScript'>";
    echo "location.href = \"$target\"";
    echo "</SCRIPT>";
}

//定位到$target页面
function locationhref($src, $target) {
    echo "<SCRIPT LANGUAGE='JavaScript'>";
    echo $src . ".location.href = \"$target\"";
    echo "</SCRIPT>";
}

function sql_injection($content) {
    if (!get_magic_quotes_gpc()) {
        if (is_array($content)) {
            foreach ($content as $key => $value) {
                $content[$key] = addslashes($value);
            }
        } else {
            addslashes($content);
        }
    }
    return $content;
}

/*
  函数名称：inject_check()
  函数作用：检测提交的值是不是含有SQL注射的字符，防止注射，保护服务器安全
  参　　数：$sql_str: 提交的变量
  返 回 值：返回检测结果，ture or false
 */

function inject_check($sql_str) {
    return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str); // 进行过滤 
}

/*
  函数名称：verify_id()
  函数作用：校验提交的ID类值是否合法
  参　　数：$id: 提交的ID值
  返 回 值：返回处理后的ID
 */

function int_check($id = null) {
    if (!$id) {
        exit('没有提交参数！');
    } // 是否为空判断 
    elseif (inject_check($id)) {
        exit('提交的参数非法！');
    } // 注射判断 
    elseif (!is_numeric($id)) {
        exit('提交的参数非法！');
    } // 数字判断 
    $id = intval($id); // 整型化 

    return $id;
}

/*
  函数名称：str_check()
  函数作用：对提交的字符串进行过滤
  参　　数：$var: 要处理的字符串
  返 回 值：返回过滤后的字符串
 */

function str_check($str) {
    if (!get_magic_quotes_gpc()) { // 判断magic_quotes_gpc是否打开 
        $str = addslashes($str); // 进行过滤 
    }
    $str = str_replace("'", "‘", $str);
    $str = str_replace("<", "＜", $str);
    $str = str_replace(">", "＞", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace("and", "ＡＮＤ", $str);
    $str = str_replace("or", "ＯＲ", $str);
    $str = str_replace("where", "ＷＨＥＲＥ", $str);
    $str = str_replace("%", "％", $str);
    $str = str_replace("*", "＊", $str);
    $str = str_replace("_", "――", $str);
    $str = htmlspecialchars($str); // html标记转换 
    return $str;
}

/*
  函数名称：post_check()
  函数作用：对提交的编辑内容进行处理
  参　　数：$post: 要提交的内容
  返 回 值：$post: 返回过滤后的内容
 */

function post_check($post) {
    if (!get_magic_quotes_gpc()) { // 判断magic_quotes_gpc是否为打开 
        $post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤 
    }
    $post = str_replace("_", "\_", $post); // 把 '_'过滤掉 
    $post = str_replace("%", "\%", $post); // 把 '%'过滤掉 
    $post = nl2br($post); // 回车转换 
    $post = htmlspecialchars($post); // html标记转换 

    return $post;
}

/**
 * 返回客户端IP
 * @return string
 */
function ip() {
    if ($_SERVER['HTTP_CLIENT_IP'] && $_SERVER['HTTP_CLIENT_IP'] != 'unknown') {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ($_SERVER['HTTP_X_FORWARDED_FOR'] && $_SERVER['HTTP_X_FORWARDED_FOR'] != 'unknown') {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $arr = explode(",", $ip);
    return $arr[0];
}

?>