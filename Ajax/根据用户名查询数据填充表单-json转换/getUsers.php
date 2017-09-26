<?php 
// 接收前台输出
$name = $_GET['name'];
// 链接数据库
$link = mysql_connect('localhost','root','nanwm');
mysql_select_db('itcast',$link);
mysql_query("set names utf8");
// 拼接SQL语句,执行sql
$sql = "select * from userinfo where username = '$name'";
$res = mysql_query($sql);
// 将资源转为json
$arr = mysql_fetch_assoc($res);

echo json_encode($arr);



