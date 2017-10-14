<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Settings &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<?php 
include_once '../checksession.php';
$conf = include_once 'set.conf.php';
//print_r($conf);die;
?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>网站设置</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form action="modifyconf.php" method="post" enctype="multipart/form-data" class="form-horizontal" >
        <div class="form-group">
          <label for="site_logo" class="col-sm-2 control-label">网站图标</label>
          <div class="col-sm-6">
            <input id="site_logo" name="site_logo" type="hidden">
            <label class="form-image">
              <input id="logo" type="file" name="image">
              <img src="<?=$conf['site_pic'];?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="site_name" class="col-sm-2 control-label">站点名称</label>
          <div class="col-sm-6">
            <input id="site_name" name="site_name" value="<?=$conf['site_name'];?>" class="form-control" type="type" >
          </div>
        </div>
        <div class="form-group">
          <label for="site_description" class="col-sm-2 control-label">站点描述</label>
          <div class="col-sm-6">
            <textarea id="site_description" name="site_desc" class="form-control" placeholder="站点描述" cols="30" rows="6"><?=$conf['site_desc'];?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="site_keywords" class="col-sm-2 control-label">站点关键词</label>
          <div class="col-sm-6">
            <input id="site_keywords" name="site_keys" class="form-control" type="type" value="<?=$conf['site_keys'];?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">评论</label>
          <div class="col-sm-6">
            <div class="checkbox">
              <label>
              <?php if($conf['site_cmt'] == 1):?>
              <input id="comment_status" name="site_cmt" type="checkbox" value="1" checked>开启评论功能
              <?php else:?>
              <input id="comment_status" name="site_cmt" type="checkbox" value="1">开启评论功能
              <?php endif;?>
              </label>
            </div>
            <div class="checkbox">
              <label>
              <?php if($conf['site_state'] == 1):?>
              <input id="comment_reviewed" name="site_state" type="checkbox" value="1" checked>评论必须经人工批准</label>
              <?php else:?>
              <input id="comment_reviewed" name="site_state" type="checkbox" value="1">评论必须经人工批准</label>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" class="btn btn-primary">保存设置</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
