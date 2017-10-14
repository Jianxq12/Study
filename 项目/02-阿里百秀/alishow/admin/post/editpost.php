<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <link href="/assets/js/Ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="/assets/js/Ueditor/third-party/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/js/Ueditor/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/js/Ueditor/umeditor.min.js"></script>
  <script type="text/javascript" src="/assets/js/Ueditor/lang/zh-cn/zh-cn.js"></script>
  <script type="text/javascript" src="/assets/WdatePicker.js"></script>
  
</head>
<body>
<?php 
include_once '../checksession.php';
//查询分类信息
include_once '../tools/Mysql.class.php';
$m = new Mysql();
$sql = "select * from ali_cate";
$cate_list = $m->selectAll($sql);

//接收id值,根据id值查询数据
$id = $_GET['id'];
$sql = "select * from ali_post where post_id=$id";
$post_info = $m->selectOne($sql);
?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action="modifypost.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$post_info['post_id'];?>" />
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input name="title" type="text" value="<?=$post_info['post_title'];?>"  id="title" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" class="form-control input-lg" name="content">
            <?=$post_info['post_title'];?>
            </textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input value="<?=$post_info['post_slug'];?>"name="slug" type="text" id="slug" class="form-control" >
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <option value="0">未分类</option>
              <?php foreach ($cate_list as $value):?>
              <?php if($post_info['post_cateid'] == $value['cate_id']):?>
              <option value="<?=$value['cate_id'];?>" selected><?=$value['cate_name'];?></option>
              <?php else:?>
              <option value="<?=$value['cate_id'];?>"><?=$value['cate_name'];?></option>
              <?php endif;?>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input name="created" type="text" id="created" class="form-control" value="<?=$post_info['post_addtime'];?>">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <?php if($post_info['post_state'] == 1):?>
              <option value="草稿">草稿</option>
              <option value="已发布" selected>已发布</option>
              <?php else: ?>
              <option value="草稿" selected>草稿</option>
              <option value="已发布" >已发布</option>
              <?php endif;?>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
  var um = UM.getEditor('content', {
	  initialFrameWidth:850, //初始化编辑器宽度,默认500
      initialFrameHeight:300  //初始化编辑器高度,默认500
  });
  </script>
</body>
</html>
















