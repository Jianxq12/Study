<?php
// 接收跨域的随机数
$fn = $_GET['fn'];
// 定义返回值
$arr = array('id'=>101,'name'=>'zs');
// 输出返回值
$str = json_encode($arr);

echo $fn."($str)";

