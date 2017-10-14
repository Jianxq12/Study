<div class="profile">
      <img class="avatar" src="../../uploads/avatar.jpg">
      <h3 class="name">
        <?php 
            echo $_SESSION['nickname'];
        ?>
      </h3>
    </div>
    <ul class="nav">
      <li>
        <a href="index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li class="active">
        <a href="#menu-posts" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse in">
          <li class="active"><a href="/admin/post/posts.php">所有文章</a></li>
          <li><a href="/admin/post/addpost.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="/admin/comments/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="/admin/user/users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="/admin/other/slides.php">图片轮播</a></li>
          <li><a href="/admin/other/settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>