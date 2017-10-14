<meta charset="utf-8">
<?php
//1. 接收表单数据
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$class = $_POST['class'];
$state = $_POST['state'];
$show = $_POST['show'];

//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();

//3. 拼接sql语句
$sql = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_class='$class',
        cate_state='$state',cate_show='$show' where cate_id=$id";
$num = $m->execute($sql);

//4. 根据结果跳转
if($num > 0){
    echo "修改成功";
    header("Refresh:2;url=categories.php");
} else {
    echo "修改失败";
    header("Refresh:2;url=editcate.php?id=$id");
}