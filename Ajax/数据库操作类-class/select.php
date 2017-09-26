<?php 
// 引入mysql类文件
include_once 'Mysql.class.php';
// 实例化Mysql类
$m = new Mysql();
// 执行查询
$sql = "select * from prov";
// 返回二维数组
$arr = $m->selectAll($sql);
// 输出结果
echo "<table border=1 width=300>";
foreach ($arr as $key => $value) {
	echo "<tr>";
	echo "<td>{$value['id']}</td>";
	echo "<td>{$value['name']}</td>";
	echo "<td>{$value['pid']}</td>";
	echo "</tr>";
}
echo "</table>";

