<?php
header('Content-type:text/html;charset=utf-8');
//1. 接收用户输入验证码
$user_code =  $_POST['code'];
//2. 从session中取出系统产生验证码
session_start();
$sys_code = $_SESSION['code'];
//3. 判断如果用户输入验证码不等于系统产生的验证码，则提示错信息，跳转回登录页
//strtoupper   strtolower
if(strtoupper($user_code) != strtoupper($sys_code)){
    header('location:err.php?errno=101');
    die;
}

//4. 接收用户名和密码
$email = $_POST['email'];
$pwd = md5($_POST['pwd']);
//5. 引入Mysql类
include_once 'tools/Mysql.class.php';
$m = new Mysql();
//6. 拼接SQL语句,执行(根据用户名查询)
$sql = "select * from ali_user where user_email='$email'";
//返回值要么是一维数组(用户名正确)要么是空(用户名错误)
$user_info = $m->selectOne($sql);
//7. 判断查询结果是否为空
if(empty($user_info)){
    header('location:err.php?errno=102');
} else {
    //判断用户输入密码和数据表中取出密码的匹配性
    if($pwd == $user_info['user_pwd']){
        //正常登录
        $_SESSION['id'] = $user_info['user_id'];
        $_SESSION['email'] = $user_info['user_email'];
        $_SESSION['nickname'] = $user_info['user_nickname'];
        echo "登录成功";
        header('Refresh:2;url=index.php');
    } else {
        header('location:err.php?errno=103');
    }
}



