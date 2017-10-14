<?php
//1. 使用fopen函数打开文件
$fp = fopen('d:/a.txt', 'w');
//2. 将字符串写入打开的文件
fwrite($fp, 'abcdefg');