<?php 
session_start(); 
    $host = "localhost"; //服务器名称 
    $db_user = "root"; //用户名 
    $db_password = "74862856"; //密码 
    $db = "TEST"; //所要连接的数据库 
    $link_id = @ mysql_connect($host,$db_user,$db_password) or die("连接数据库失败".mysql_error()); 
    $db_selected = mysql_select_db($db,$link_id);   
    if(!$db_selected){ 
        die("未找到指定的数据库".mysql_error()); 
    } 
  
if(isset($_COOKIE['user'])){  
 
    $sql = 'select * from name where user="'.$_COOKIE['user'].'"'; 
    $result = @ mysql_query($sql,$link_id) or die("SQL语句出错"); 
    $row = mysql_fetch_array($result,MYSQL_ASSOC); 
    if(isset($row)){ //如果数据库中存在该用户 
        Header("Location:index.php"); //合法COOKIE直接跳转到指定界面 
    }else{ 
        $_COOKIE['user'] = ""; //非法COOKIE清空 
        Header("Location:login.php"); //重新载入界面 
    } 
 
} 
 
if(isset($_POST['submitted'])){ 
 
    $user = $_POST['user']; 
    $pwd = $_POST['pwd']; 
    $sql = 'select * from name where user="'.$user.'"'; 
    $result = @ mysql_query($sql,$link_id) or die("SQL语句出错"); 
    $row = mysql_fetch_array($result,MYSQL_ASSOC); 
    $cmp_pwd = $row['password']; 
    if($cmp_pwd == $pwd){ //用从数据库取出的密码和提交的密码比较 
 
        setcookie("user",$user,time()+300); //设置COOKIE 
        echo "<script language=javascript>alert('登录成功');</script>"; 
        Header("Location:index.php"); //跳转到指定页面 
 
    }else{ 
        echo "<script language=javascript>alert('用户名或密码错误');</script>"; 
        Header("Location:login.php"); //重新载入页面 
 
    } 
 
} 
?> 
 
<html> 
    <head> 
    <title>登录窗口</title> 
    <meta http-equiv="Content-Type" content="text/html" charset="utf8"> 
    </head> 
    <body> 
    <form action="just.php"  method="post"> 
        用户名： 
        <input type="text" name="user" /> 
        密码: 
        <input type="password" name="pwd" /> 
        <br/> 
        <input type="hidden" name="submitted" value="1" /> 
        <input type="submit" value="登录" /> 
    </form> 
    </body> 
</html> 