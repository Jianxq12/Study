<?php 
header("content-type:text/html;charset=utf8");

$config = [
	"host" => "localhost",
	"user" => "root",
	"password" => "nanwm",
	"charset" => "utf8",
	"db" => "itcast"
];

// 数据库连接函数
function connect($conf){
	// 1.建立连接
	$link = @mysql_connect($conf["host"],$conf["user"],$conf["password"]) or die("服务器忙");

	// 2.设置字符集
	mysql_query("set names ".$conf["charset"]);

	// 3.选择数据库
	mysql_query("use ".$conf["db"]) or die("选择数据库失败");

	return $link;
}

$link = connect($config);
// var_dump($link);

