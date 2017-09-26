<?php 
// 引入mysql类文件
include_once 'Mysql.class.php';
// 实例化Mysql类
$m = new Mysql();
// 构建写入数据的SQL
$sql = "insert into prov values(null,'浙江省',0)";
// 输出结果
echo $m->execute($sql);


