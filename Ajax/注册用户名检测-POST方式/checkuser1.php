<?php 
// 接收前台发送的用户名
$name = $_POST['name'];
// 链接数据库服务器
$link = mysql_connect('localhost','root','nanwm');
// 选择数据库
mysql_select_db('itcast',$link);
// 设置字符集
mysql_query('set names utf8');
// 构建SQL语句
$sql = "select username from userinfo where username = '$name'";
// 执行sql，返回结果集资源
$res = mysql_query($sql);
// 解析结果集
$line = mysql_fetch_assoc($res);
// 判断查询结果是否为空
if(empty($line)){
	// 如果为空，说明该用户不存在
	echo 1;
}else{
	// 如果不为空，说明该用户已存在
	echo 2;
}



