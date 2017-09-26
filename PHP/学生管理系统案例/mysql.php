<?php

header("content-type:text/html;charset=utf8");

/**
 * [connect 数据连接基本操作]
 * @param  array  $conf [配置参数数组]
 * @return [resoure]       [建立的连接]
 */
function connect($conf =[]){
	// 1、建立连接
	$link = @mysql_connect($conf['host'],$conf['user'],$conf['pass']) or die('服务器忙');

	// 2、设置字符集
	mysql_query("set names ".$conf['charset']);

	// 3、选择数据库
	mysql_query("use ".$conf['db']) or die("数据库选择失败");

	return $link;

}
/**
 * [query 执行SQL语句]
 * @param  string $sql [要执行的语句]
 * @return [boolean | resource]      [description]
 */
function query($sql =""){
    $res =mysql_query($sql);
    if(!$res){
    	die("发生错误了，错误信息如下：<h4>".mysql_error()."</h4>");
    }else{
    	return $res;
    }
}
/**
 * [selectOneRow 查询一行]
 * @param  string $sql [SQL语句]
 * @return [array]      [空数组或者关联数组]
 */
function selectOneRow($sql =""){
	$res =query($sql);
	if(mysql_num_rows($res) == 0){
		// 空结果集
		return [];
	}else{
		return mysql_fetch_assoc($res);
	}
}
/**
 * [selectRows 查询多行]
 * @param  string $sql [SQL语句]
 * @return [type]      [description]
 */
function selectRows($sql =""){
	$res =query($sql);
	if(mysql_num_rows($res) == 0){
		// 空结果集
		return [];
	}else{
		// 解析结果集
		while($line =mysql_fetch_assoc($res)){
			$rows[] =$line;
		}

		// 二维数组
		return $rows;
	}
}
/**
 * [selectOneCol 查询一个一行一列的值]
 * @param  string $sql [description]
 * @return [type]      [description]
 */
function selectOneCol($sql =""){
	$res =query($sql);
	if(mysql_num_rows($res) == 0){
		return false;
	}else{
		// 返回索引数组
		$line =mysql_fetch_row($res);
		return $line[0];
	}
}

/**
 * 测试代码
 */



// 配置服务器的连接参数
$config=[
	'host'    =>"localhost:3306",
	'user'    =>"root",
	'pass'    =>"root",
	'charset' =>"utf8",
	'db'      =>"itheima",
];

$link =connect($config);

// 增删改
/*$sql ="update student set age =29 where id =9";
$res =query($sql);
if($res){
	echo "执行成功";
}*/

// 查询一个一行一列的值--统计行数等
// $sql ="select count(*) from student ";
// $res =selectOneCol($sql);
// if(!$res){
// 	echo "暂无数据";
// }else{
// 	echo "结果为".$res;
// }


// 查询一行数据，返回关联数组
/*$sql ="select * from student where id =123";
$sql ="select * from student where id =1";
$res =selectOneRow($sql);
if(!$res){
	echo "暂无数据";
}else{
	print_r($res);
}*/

// 查询多行
/*$sql ="select * from student where id > 2";
$res =selectRows($sql);
if(!$res){
	echo "暂无数据";
}else{
	foreach($res as $v){
		$str = "姓名<b>".$v['name']."</b>&nbsp;";
		$str .= "年龄<b>".$v['age']."</b>&nbsp;";
		$str .= "性别<b>".$v['sex'].'</b><br>';
		echo $str;
	}
}*/