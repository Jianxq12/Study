  <meta charset="utf-8">
<?php
$conf = include_once 'set.conf.php';
//1. 文件上传处理
$upfile = $conf['site_pic'];
if($_FILES['image']['error'] == 0){
    $tmp = pathinfo($_FILES['image']['name']);
    $name = md5($tmp['filename'].time()).'.'.$tmp['extension'];
    $upfile = "../uploads/$name";
    move_uploaded_file($_FILES['image']['tmp_name'], $upfile);
    //删除之前的文件
    unlink($conf['site_pic']);
}

//2. 接收表单的其他数据
$site_name = $_POST['site_name'];
$site_desc = trim($_POST['site_desc']);
$site_keys = $_POST['site_keys'];
$site_cmt  = @$_POST['site_cmt'];
$site_state = @$_POST['site_state'];

//3. 将数据写入set.conf.php文件
$fp = fopen('set.conf.php', 'w');
$str = "<?php
return array(
    'site_pic'  => '$upfile',
    'site_name' => '$site_name',
    'site_desc' => '$site_desc',
    'site_keys' => '$site_keys',
    'site_cmt'  => '$site_cmt',
    'site_state'=> '$site_state'
);";
fwrite($fp, $str);
echo "修改成功";
header('Refresh:2;url=settings.php');















