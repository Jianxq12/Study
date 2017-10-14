<?php
//清除session
session_start();
$_SESSION['id'] = null;
$_SESSION['email'] = null;
$_SESSION['nickname'] = null;

//跳转
echo "退出成功";
header('Refresh:2;url=login.html');