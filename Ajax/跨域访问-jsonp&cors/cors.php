<?php
// 设置http://www.alishow.com网站下的所有程序都能访问当前页面
header('Access-Control-Allow-Origin:http://www.alishow.com');

// header('Access-Control-Allow-Origin:http://www.alishow.com,http://www.ajax.com.cn');

// 设置所有网站都可以访问当前页面
// header('Access-Control-Allow-Origin:*');

// 设置POST和GET访问方式均可
header('Access-Control-Allow-Methods:POST,GET');

echo '123';
