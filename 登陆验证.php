<?php 
session_start(); 
    $host = "localhost"; //���������� 
    $db_user = "root"; //�û��� 
    $db_password = "74862856"; //���� 
    $db = "TEST"; //��Ҫ���ӵ����ݿ� 
    $link_id = @ mysql_connect($host,$db_user,$db_password) or die("�������ݿ�ʧ��".mysql_error()); 
    $db_selected = mysql_select_db($db,$link_id);   
    if(!$db_selected){ 
        die("δ�ҵ�ָ�������ݿ�".mysql_error()); 
    } 
  
if(isset($_COOKIE['user'])){  
 
    $sql = 'select * from name where user="'.$_COOKIE['user'].'"'; 
    $result = @ mysql_query($sql,$link_id) or die("SQL������"); 
    $row = mysql_fetch_array($result,MYSQL_ASSOC); 
    if(isset($row)){ //������ݿ��д��ڸ��û� 
        Header("Location:index.php"); //�Ϸ�COOKIEֱ����ת��ָ������ 
    }else{ 
        $_COOKIE['user'] = ""; //�Ƿ�COOKIE��� 
        Header("Location:login.php"); //����������� 
    } 
 
} 
 
if(isset($_POST['submitted'])){ 
 
    $user = $_POST['user']; 
    $pwd = $_POST['pwd']; 
    $sql = 'select * from name where user="'.$user.'"'; 
    $result = @ mysql_query($sql,$link_id) or die("SQL������"); 
    $row = mysql_fetch_array($result,MYSQL_ASSOC); 
    $cmp_pwd = $row['password']; 
    if($cmp_pwd == $pwd){ //�ô����ݿ�ȡ����������ύ������Ƚ� 
 
        setcookie("user",$user,time()+300); //����COOKIE 
        echo "<script language=javascript>alert('��¼�ɹ�');</script>"; 
        Header("Location:index.php"); //��ת��ָ��ҳ�� 
 
    }else{ 
        echo "<script language=javascript>alert('�û������������');</script>"; 
        Header("Location:login.php"); //��������ҳ�� 
 
    } 
 
} 
?> 
 
<html> 
    <head> 
    <title>��¼����</title> 
    <meta http-equiv="Content-Type" content="text/html" charset="utf8"> 
    </head> 
    <body> 
    <form action="just.php"  method="post"> 
        �û����� 
        <input type="text" name="user" /> 
        ����: 
        <input type="password" name="pwd" /> 
        <br/> 
        <input type="hidden" name="submitted" value="1" /> 
        <input type="submit" value="��¼" /> 
    </form> 
    </body> 
</html> 