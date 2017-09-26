<?php 
header("content-type:text/html;charset=utf8");

// 判断是否有登录成功标志
session_start();

// 没有登录 跳转到登录页面
if(!isset($_SESSION['user'])){
	header('location:login.php');
}
