<?php
//1. 从session中取id
session_start();
$id = $_SESSION['id'];
//2. 获取用户输入的旧密码
$oldpwd = md5($_POST['oldpwd']);
//3. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();
//4. 拼接SQL语句
$sql = "select user_pwd from ali_user where user_id=$id";
$tmp = $m->selectOne($sql);
//5. 判断用户输入旧密码和数据表取出的密码的一致性
if($tmp['user_pwd'] == $oldpwd){
    //继续判断两个新密码是否一致
    if($_POST['newpwd'] == $_POST['re-newpwd']){
        //允许修改,拼接SQL语句,执行修改
        $pwd = md5($_POST['newpwd']);
        $sql = "update ali_user set user_pwd='$pwd' where user_id=$id";
        $num = $m->execute($sql);
        if($num > 0){
            echo "修改成功";
            header('Refresh:2;url=profile.php');
            die;
        } else {
            header('location:../err.php?errno=803');
            die;
        }
    } else {
        header('location:../err.php?errno=802');
        die;
    }
} else {
    header('location:../err.php?errno=801');
    die;
}