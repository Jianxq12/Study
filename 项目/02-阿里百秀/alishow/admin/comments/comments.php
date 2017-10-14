<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
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
$m = new Mysql();
$sql = "SELECT cmt_id,member_nickname,cmt_content,post_title,cmt_time,cmt_state FROM ali_comment c
  JOIN ali_post p ON c.cmt_postid=p.post_id
  JOIN ali_member m ON c.cmt_memid=m.member_id
  ORDER BY cmt_id";
//$sql = "select * from ali_comment";
$cmt_list = $m->selectAll($sql);
?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: block">
          <button id="btnAllow" class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cmt_list as $value):?>
          <tr class="danger">
            <td class="text-center">
                <input type="checkbox" name="cmt_id" value="<?=$value['cmt_id']?>">
            </td>
            <td><?=$value['member_nickname'];?></td>
            <td><?=$value['cmt_content'];?></td>
            <td><?=$value['post_title'];?></td>
            <td><?=date('Y/m/d', $value['cmt_time']);?></td>
            <td class='tdState'><?=$value['cmt_state'];?></td>
            <td class="text-center">
              <?php if($value['cmt_state'] == '批准'):?>
              <a href="modifystate.php?id=<?=$value['cmt_id']?>&state=<?=$value['cmt_state']?>" 
                class="aState btn btn-info btn-xs">驳回</a>
              <?php else:?>
              <a href="modifystate.php?id=<?=$value['cmt_id']?>&state=<?=$value['cmt_state']?>" 
                class="aState btn btn-info btn-xs">批准</a>
              <?php endif;?>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
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
  $('#btnAllow').click(function(){
	    //获取所有已选中的checkbox
	    var checkbox_list = $("[name=cmt_id]:checked");
	    //遍历checkbox，获取value值，拼接成一个字符串
	    //el是html对象
	    var str = '';
	    checkbox_list.each(function(index, el){
	        str += el.value + ",";
		})
		//截取掉最后一个 , 
		str = str.substr(0, str.length-1);
	    //发送ajax请求，要将str一起发送到后台
	    $.post('allowCmt.php', {'ids':str}, function(msg){
	        if(msg == 1){
	        	alert('批量批准成功');
	        	checkbox_list.each(function(){
		        	//当前checkbox找两次parent到tr，再查找类名就可以找到对应的td对象和a对象
	        	    $(this).parent().parent().find('.tdState').html('批准');
	        	    $(this).parent().parent().find('.aState').html('驳回');
		        })
			} else {
			    alert('批量批准失败');
			}
		});
  });
  </script>
</body>
</html>










