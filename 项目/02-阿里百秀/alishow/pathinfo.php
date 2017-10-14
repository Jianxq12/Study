<?php
$path = "D:/itshop/itshop.sql";
//参数：路径
//返回值：路径信息的数组
$arr = pathinfo($path);
echo "<pre>";
print_r($arr);