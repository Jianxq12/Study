<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<?php 
include_once '../checksession.php';
include_once '../tools/Mysql.class.php';
//1. 接收url传参
$cate = isset($_GET['cate'])?$_GET['cate']:0;
$state = isset($_GET['state'])?$_GET['state']:0;
//2. 判断$cate和$state的值，如果不等于0才拼接where条件
$where = '';
if($cate != 0){
    $where .= "cate_id=$cate and ";
}
if($state != 0){
    $where .= "post_state=$state and ";
}
//cate_id=1 and 1
//post_state = 2 and 1
//cate_id=1 and post_state=2 and 1
$where .= "1";
//3. 使用limit进行分页  limit 2,3
$pageno = isset($_GET['pageno'])?$_GET['pageno']:1;
$pagesize = 3;
$start = ($pageno-1)*$pagesize;
$limit = "limit $start,$pagesize";

$m = new Mysql();
$sql = "SELECT post_id,post_title,user_nickname,cate_name,post_addtime,post_state FROM ali_post p
          LEFT JOIN ali_cate c ON p.post_cateid=c.cate_id
          LEFT JOIN ali_user u ON p.post_author=u.user_id
          where $where $limit
       ";
$post_list = $m->selectAll($sql);

//查询分类数据
$sql = "select * from ali_cate";
$cate_list = $m->selectAll($sql);

//计算分页导航条数据
//1. 查询总条数
$sql = "SELECT count(post_id) num FROM ali_post p
          LEFT JOIN ali_cate c ON p.post_cateid=c.cate_id
          LEFT JOIN ali_user u ON p.post_author=u.user_id
          where $where
       ";
$tmp = $m->selectOne($sql);
$count = $tmp['num'];
//2. 计算总页数
$pages = ceil($count/$pagesize);
?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline" action="posts.php" method="get">
          <select name="cate" class="form-control input-sm">
            <option value="0">所有分类</option>
            <?php foreach ($cate_list as $value):?>
            <option value="<?=$value['cate_id'];?>"><?=$value['cate_name'];?></option>
            <?php endforeach;?>
          </select>
          <select name="state" class="form-control input-sm">
            <option value="0">所有状态</option>
            <option value="2">草稿</option>
            <option value="1">已发布</option>
          </select>
          <button class="btn btn-default btn-sm" type="submit">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="posts.php?cate=<?=$cate;?>&state=<?=$state;?>&pageno=1">首页</a></li>
          <li><a href="posts.php?cate=<?=$cate;?>&state=<?=$state;?>&pageno=<?=($pageno-1);?>">上一页</a></li>
          <?php for($i = 1; $i <= $pages; $i++):?>
          <li><a href="posts.php?cate=<?=$cate;?>&state=<?=$state;?>&pageno=<?=$i;?>"><?=$i;?></a></li>
          <?php endfor;?>
          <li><a href="posts.php?cate=<?=$cate;?>&state=<?=$state;?>&pageno=<?=($pageno+1);?>">下一页</a></li>
          <li><a href="posts.php?cate=<?=$cate;?>&state=<?=$state;?>&pageno=<?=$pages;?>">尾页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($post_list as $value):?>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><?=$value['post_title'];?></td>
            <td><?=$value['user_nickname'];?></td>
            <td><?=$value['cate_name'];?></td>
            <td class="text-center"><?=date('Y/m/d', $value['post_addtime']);?></td>
            <td class="text-center">
            <?php 
                if($value['post_state'] == 1){
                    echo "已发布";
                } else {
                    echo "草稿";
                }
            ?>
            </td>
            <td class="text-center">
              <a href="javascript:;" data=<?=$value['post_id'];?> class="edit btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" data=<?=$value['post_id'];?> class="del btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
     <?php include_once '../include/aside.php';?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
  $('.del').click(function(){
	   if(confirm('您确认删除吗？')){
    	    var id = $(this).attr('data');
    	    _this = $(this);
    	    $.post('delpost.php', {'id':id}, function(msg){
    	        if(msg == 2){
    		        alert('删除失败');
    		    } else {
    			    alert('删除成功');
    		    	_this.parent().parent().remove();
    		    }
    		});
	   }
  });
  $('.edit').click(function(){
	    var id = $(this).attr('data');
	    location.href = "editpost.php?id="+id;
  })
  </script>
</body>
</html>
















