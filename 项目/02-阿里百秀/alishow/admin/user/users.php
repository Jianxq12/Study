<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
  <script type="text/javascript" src="../../assets/vendors/jquery/jquery.js"></script>
  <script type="text/javascript" src="../../assets/layer/layer.js"></script>
</head>
<body>
<?php
include_once '../checksession.php';
//定义每页显示数量
$pagesize = 2;
//1. 引入Mysql类
include_once '../tools/Mysql.class.php';
//2. 实例化Mysql类
$m = new Mysql();

//计算总页数
//1. 获取总条数
$sql = "select count(*) num from ali_user";
$tmp = $m->selectOne($sql);
$rows = $tmp['num'];
//2. 计算总页数
$pages = ceil($rows/$pagesize);

//定义页号和每页显示数量
$pageno = isset($_GET['pageno'])?$_GET['pageno']:1;
//判断从url接收的页号
if($pageno < 1){
    //如果小于1，调整为1
    $pageno = 1;
} else if($pageno > $pages){
    //如果大于总页数
    $pageno = $pages;
}


$start = ($pageno - 1) * $pagesize;

//3. 拼接SQL语句，调用selectAll方法进行查询
$sql = "select * from ali_user limit $start,$pagesize";
//返回二维数组
$user_list = $m->selectAll($sql);
?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input id="addBtn" type="button" value="添加新用户">
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
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
<?php foreach($user_list as $value):?>
<tr>
<td class="text-center"><input type="checkbox"></td>
<td class="text-center"><img class="avatar" src="../../assets/img/default.png"></td>
<td><?=$value['user_email'];?></td>
<td><?=$value['user_slug'];?></td>
<td><?=$value['user_nickname'];?></td>
<td><?php
        if($value['user_state'] == 1){
            echo "激活";
        } else {
            echo "未激活";
        }
    ?></td>
<td class="text-center">
  <a href="javascript:;" class="btn btn-default btn-xs editBtn" 
    data="<?=$value['user_id']; ?>">编辑</a>
  <a href="javascript:;" class="btn btn-danger btn-xs" 
     onclick="deluser(<?=$value['user_id'];?>, $(this))">删除</a>
</td>
</tr>
<?php endforeach;?>
            </tbody>
          </table>
<?php 


$prev = $pageno-1;
$next = $pageno+1;
?>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="users.php?pageno=1">首页</a></li>
          <?php if($pageno == 1):?>
            <li><a href="javascript:;">上一页</a></li>
          <?php else :?>
            <li><a href="users.php?pageno=<?=$prev;?>">上一页</a></li>
          <?php endif;?>
          
          <?php
            if($pageno <= 2){
                for($i = 1; $i <= 5; $i++){
                    echo "<li><a href='users.php?pageno={$i}'>$i</a></li>";
                }
            } else if($pageno >= $pages - 1){
                for($i = $pages - 4; $i <= $pages; $i++){
                    echo "<li><a href='users.php?pageno={$i}'>$i</a></li>";
                }
            } else {
                for($i = $pageno - 2; $i <= $pageno + 2; $i++){
                    echo "<li><a href='users.php?pageno={$i}'>$i</a></li>";
                }
            }
          ?>
          
          <?php if($pageno == $pages):?>
            <li><a href="javascript:;">下一页</a></li>
          <?php else :?>
            <li><a href="users.php?pageno=<?=$next;?>">下一页</a></li>
          <?php endif;?>
          <li><a href="users.php?pageno=<?=$pages;?>">尾页</a></li>

        </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
  //1. 获取按钮标签对象，绑定点击事件
  $('#addBtn').click(function(){
	  layer.ready(function(){ 
		  layer.open({
		    type: 2,
		    title: '添加新用户',
		    maxmin: false,
		    area: ['800px', '500px'],
		    content: 'adduser.html',
		  });
	  });
  })

  function deluser(id, obj){
	    layer.confirm('您确认删除吗？', function(){
	    	$.post('deluser.php', {id:id}, function(msg){
		        if(msg == 1){
		            //删除对应的tr
		            layer.alert('删除成功');
		            obj.parent().parent().remove();
			    } else {
			        layer.alert('删除失败');
				}
			});
		})
	    
  }

  $('.editBtn').click(function(){
	    //获取自定义属性data中的值
	    var id = $(this).attr('data');
	    layer.ready(function(){
	        layer.open({
	            type: 2,
	            title: '修改用户',
	            area: ['800px', '500px'],
	            maxmin: false,
	            content: 'edituser.php?id='+id
		    });
	    });
  })
  </script>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
</body>
</html>
