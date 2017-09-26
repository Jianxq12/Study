<?php
//1. 接收前台传递的数据
$name = $_POST['name'];
// $name = 'zhang';
$link = mysql_connect('localhost','root','nanwm');
mysql_select_db('itcast',$link);
mysql_query("set names utf8");
// 拼接sql语句，执行查询
$sql = "select * from email where uname like '%$name%' or nickname like '%$name%'";

$res = mysql_query($sql);
// 将资源解析放入数组
while ($row = mysql_fetch_assoc($res)) {
	$result[] = $row;
}
// 将数组转为json
echo json_encode($result);

