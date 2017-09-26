<?php 
header("content-type:text/html;charset=utf8");

include "function.php";
include "connect.php";

session_start();
unset($_SESSION['user']);

if(!isset($_SESSION['user'])){
	redirect("login.php","已退出，请重新登录");
}

 ?>