<?php
// 接收前台传递数据
$name = $_GET['name'];
// $name = "电脑配件";
// 链接数据库
$link = mysql_connect('localhost','root','nanwm');
mysql_select_db('itcast',$link);
mysql_query("set names utf8");
// 根据不同的选项卡值拼接不同的查询条件
switch ($name) {
    case '推荐商品':
        $where = 'tj=1';
        break;
    case '电脑整机':
        $where = 'cateid=1';
        break;
    case '电脑配件':
        $where = 'cateid=2';
        break;
    case '办公打印':
        $where ='cateid=3';
        break;
    case '网络产品':
        $where = 'cateid=4';
        break;
}
// echo $where;
// 构建SQL语句
$sql = "select * from sp_goods where $where";
// 执行SQL语句
$res = mysql_query($sql);
// echo $res;
// 直接将数据拼接成前台需要的html结构
$str = "<ul>";

while ($row = mysql_fetch_assoc($res)) {
$str .="<li>
            <dl>
                <dt><a href=''><img src='{$row['small_logo']}'/></a></dt>
                <dd><a href=''>{$row['name']}</a></dd>
                <dd><span>售价：</span> <strong>￥{$row['price']}</strong></dd>
            </dl>
        </li>";
}
$str .= "</ul>";
echo $str;




