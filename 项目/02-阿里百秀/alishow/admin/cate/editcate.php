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
  <script>NProgress.start()</script>
<?php
include_once '../checksession.php';
//1. 接收categories.php传递的id值
$id = $_GET['id'];
//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
//3. 实例化Mysql
$m = new Mysql();
//4. 拼接SQL语句执行查询
$sql = "select * from ali_cate where cate_id=$id";
//5. 调用selectOne查询数据
$cate_info = $m->selectOne($sql);
?>
  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form action="modifycate.php" method="post">
            <input type="hidden" name="id" value="<?=$cate_info['cate_id'];?>" />
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" value="<?=$cate_info['cate_name'] ?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" value="<?=$cate_info['cate_slug'] ?>">
            </div>
            <div class="form-group">
              <label for="class">图标</label>
              <input id="class" class="form-control" name="class" type="text" value="<?=$cate_info['cate_class'] ?>">
            </div>
            <div class="form-group">
              <label for="state">状态</label>
              <?php if($cate_info['cate_state'] == 1):?>
              <input name="state" type="radio" value="1" checked>启用
              <input name="state" type="radio" value="2">禁用
              <?php else:?>
              <input name="state" type="radio" value="1">启用
              <input name="state" type="radio" value="2" checked>禁用
              <?php endif;?>
            </div>
            <div class="form-group">
              <label for="show">是否显示</label>
              <?php if($cate_info['cate_show'] == 1):?>
              <input name="show" type="radio" value="1" checked>显示
              <input name="show" type="radio" value="2">不显示
              <?php else:?>
              <input name="show" type="radio" value="1">显示
              <input name="show" type="radio" value="2" checked>不显示
              <?php endif;?>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
