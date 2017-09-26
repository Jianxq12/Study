<?php
class Mysql{
	// 配置项设置为私有属性
	private $host;
	private $user;
	private $pwd;
	private $dbname;
	private $charset;
	// 链接资源和结果集资源也设置为属性
	private $link;
	private $res;

	function __construct(){
		//载入数据库链接的配置项
		$info = include_once 'Mysql.conf.php';
		$this->host = $info['host'];
		$this->user = $info['user'];
		$this->pwd = $info['pwd'];
		$this->dbname = $info['dbname'];
		$this->charset = $info['charset'];

		$this->connect();
	}

	function connect(){
		$this->link = mysql_connect($this->host,$this->user,$this->pwd);
		mysql_select_db($this->dbname,$this->link);
		mysql_query('set names '.$this->charset,$this->link);
	}

	// 执行查询，返回一个二维数组
	function selectAll($sql){
		$this->res = mysql_query($sql,$this->link);
		$result = array();
		while($row = mysql_fetch_assoc($this->res)){
			$result[] = $row;
		}
		return $result;
	}


	// 执行查询，返回一维数组
	function selectOne($sql){
		$this->res = mysql_query($sql,$this->link);
		return mysql_fetch_assoc($this->res);
	}

	// 执行增删改 返回影响行数
	function execute($sql){
		mysql_query($sql);
		return mysql_affected_rows($this->link);
	}

	// 释放结果集
	function free(){
		mysql_free_result($this->res);
	}

	// 关闭连接资源
	function close(){
		mysql_close($this->link);
	}
}



