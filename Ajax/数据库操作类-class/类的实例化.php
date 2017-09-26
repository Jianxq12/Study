<?php

header('content-type:text/html;charset=utf-8');

class Gf{
	// 修饰符可用来修饰方法和属性
	// 	Public: 公有的，在类的外部和内部，包括子类当中都能够找到
	// protected: 受保护的，在类的内部和子类当中能够找到
	// private: 私有的，只有在当前类的内部能够找到。
	private $name;
	private $age;
	private $sex;

	//如果方法前不使用访问修饰符，默认是public的
	//实例化对象时，会自动调用构造方法
	function __construct($name,$age,$sex){
		$this->name = $name;
		$this->age = $age;
		$this->sex = $sex;
		$this->info();
	}

	public function eatting(){
		echo "我的女朋友是个大吃货";
	}

	private function buy(){
		echo "买买买";
	}

	function info(){
		// 类的内部调用自己的属性和方法，用$this指针
		echo "我的名字是".$this->name."，今年".$this->age."岁";
		$this->buy();
	}
}


$g = new Gf('zxx',20,'女');

