<meta charset="utf-8">
<?php
//1. 接收前台传递的id值
$id = $_GET['id'];
//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
//3. 实例化Mysql类
$m = new Mysql();
//4. 拼接sql语句
$sql = "delete from ali_cate where cate_id=$id";
//5. 调用execute方法执行删除
$num = $m->execute($sql);
//6. 跳转
if($num > 0){
    echo '删除成功';
    header('Refresh:2;url=categories.php');
} else {
    echo '删除是失败';
    header('Refresh:2;url=categories.php');
}