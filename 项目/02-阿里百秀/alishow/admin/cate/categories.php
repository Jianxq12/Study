<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<?php 
include_once '../checksession.php';
//1. 引入Mysql.class.php类
include_once '../tools/Mysql.class.php';
//2. 实例化Mysql类
$m = new Mysql();
//3. 拼接sql语句，执行查询
$sql = "select * from ali_cate";
$cate_list = $m->selectAll($sql);
//print_r($cate_list);die;
?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
        <a href="addcate.php">添加新分类</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
<?php foreach($cate_list as $value):?>
<tr>
<td class="text-center"><input type="checkbox"></td>
<td><?=$value['cate_name']; ?></td>
<td><?=$value['cate_slug']; ?></td>
<td class="text-center">
  <a href="editcate.php?id=<?=$value['cate_id'];?>" class="btn btn-info btn-xs">编辑</a>
  <a href="delcate.php?id=<?=$value['cate_id'];?>" 
      class="btn btn-danger btn-xs" onclick="return confirm('您确认删除吗？')">删除</a>
</td>
</tr>
<?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
