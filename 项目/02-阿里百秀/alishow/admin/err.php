<?php
header('Content-Type:text/html;charset=utf-8');
//1. 接收错误代码
$err = $_GET['errno'];
//2. 根据不同的错误代码，显示不同的错误信息
switch ($err){
    case 101:
        echo "验证码错误,错误码:$err";
        header('Refresh:2;url=login.html');
        break;
    case 102:
        echo "用户名错误,错误码:$err";
        header('Refresh:2;url=login.html');
        break;
    case 103:
        echo "密码错误,错误码:$err";
        header('Refresh:2;url=login.html');
        break;
    case 801:
        echo "您所输入的旧密码不正确,错误码:$err";
        header('Refresh:2;url=user/profile.php');
        break;
    case 802:
        echo "您输入的两次新密码不一致,错误码:$err";
        header('Refresh:2;url=user/profile.php');
        break;
    case 803:
        echo "修改新密码失败,错误码:$err";
        header('Refresh:2;url=user/profile.php');
        break;
    case 901:
        echo "您尚未登录,请登陆后再访问,错误码:$err";
        header('Refresh:2;url=login.html');
        break;
    default:
        echo "未知错误,错误码:$err";
        header('Refresh:2;url=login.html');
        break;
}


