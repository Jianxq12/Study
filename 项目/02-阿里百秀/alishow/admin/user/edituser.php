<link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="../../assets/css/admin.css">
<script src="../../assets/vendors/nprogress/nprogress.js"></script>
<script src="../../assets/vendors/jquery/jquery.js"></script>
<script src="../../assets/layer/layer.js"></script>
<?php 
//1. 接收用户id值
$id = $_GET['id'];
//2. 引入Mysql类
include_once '../tools/Mysql.class.php';
$m = new Mysql();
//3. 拼接SQL语句
$sql = "select * from ali_user where user_id=$id";
$user_info = $m->selectOne($sql);
?>
<div class="col-md-4">
<form id="editForm">
<input type="hidden" id="uid" value="<?=$user_info['user_id'];?>" />
<h2>修改用户</h2>
<div class="form-group">
  <label for="email">邮箱</label>
  <input id="email" value="<?=$user_info['user_email'];?>" class="form-control" name="email" type="email">
</div>
<div class="form-group">
  <label for="slug">别名</label>
  <input id="slug" value="<?=$user_info['user_slug'];?>" class="form-control" name="slug" type="text">
</div>
<div class="form-group">
  <label for="nickname">昵称</label>
  <input id="nickname" value="<?=$user_info['user_nickname'];?>" class="form-control" name="nickname" type="text">
</div>
<div class="form-group">
  <input type="button" id="edituser" class="btn btn-primary" value="添加">
</div>
</form>
        </div>
 <script type="text/javascript">
 $(document).ready(function(){
	 $('#edituser').click(function(){
		   var id = $('#uid').val();
		   var email = $('#email').val();
		   var slug = $('#slug').val();
		   var nickname = $('#nickname').val();

		   //调用ajax程序
		   var data = {'id':id, 'email':email, 'slug':slug, 'nickname':nickname};
		   $.post('edituser_deal.php', data, function(msg){
			    if(msg == 1){
			        alert('修改成功');
				} else {
				    alert('修改失败');
			    }
			    var index = parent.layer.getFrameIndex(window.name);
				parent.layer.close(index);
		   });
		   
	 })
 })
 
 
 </script>
 
 
 
 
 