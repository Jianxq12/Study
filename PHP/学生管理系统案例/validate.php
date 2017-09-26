<?php 
header("content-type:text/html;charset=utf8");

include "function.php";
include "connect.php";

if(!$_POST){
	redirect('login.php','请先登录');
}

//接收数据
$user = $_POST['user'];
$pass = $_POST['pass'];

if(empty($user) || empty($pass)){
	redirect('login.php','用户名及密码不能为空');
}

// 按照用户名查询密码
$sql = "select * from admin where user = '$user'";

$res = mysql_query($sql);
if(!$res || mysql_num_rows($res) == 0){
	redirect('login.php','用户名或者密码出错');
}

// 解析结果集
$line = mysql_fetch_assoc($res);
$passDb = $line['password'];//加密的32位字符串

if(md5($pass) === $passDb){
	// 将登录标志保存在SESSION数据中
	session_start();
	$_SESSION['user'] = $user;

	redirect('index.php','登录成功');
}

redirect('login.php','登录失败');
