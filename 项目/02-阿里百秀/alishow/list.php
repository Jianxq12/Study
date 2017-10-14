<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <?php 
    include_once 'left.php';
    
    //接收cate_id
    $cate_id = $_GET['cid'];
    //拼接sql语句，查询分类名称
    $sql = "select cate_name from ali_cate where cate_id=$cate_id";
    $cate_name = $m->selectOne($sql);
    
    //查询文章列表
    $sql = "SELECT post_id,post_title,post_desc,post_file,post_click,post_good,
       post_addtime,user_nickname,cate_name,num FROM ali_post p
  LEFT JOIN ali_cate c ON p.post_cateid=c.cate_id
  LEFT JOIN ali_user u ON p.post_author=u.user_id
  LEFT JOIN (SELECT cmt_postid,COUNT(*) num FROM ali_comment GROUP BY cmt_postid) cmt
       ON cmt.cmt_postid=p.post_id
  WHERE cate_id=$cate_id
  ORDER BY post_addtime DESC LIMIT 0,3";
    $post_list = $m->selectAll($sql);
    ?>
    <div class="content">
      <div class="panel new">
        <h3><?=$cate_name['cate_name'];?></h3>
        <?php foreach ($post_list as $value):?>
        <div class="entry">
          <div class="head">
            <a href="detail.php?pid=<?=$value['post_id'];?>"><?=$value['post_title'];?></a>
          </div>
          <div class="main">
            <p class="info"><?=$value['user_nickname'];?> 发表于 <?=date('Y-m-d', $value['post_addtime']);?></p>
            <p class="brief"><?=$value['post_desc'];?></p>
            <p class="extra">
              <span class="reading">阅读(<?=$value['post_click'];?>)</span>
              <span class="comment">评论(<?=$value['num'];?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?=$value['post_good'];?>)</span>
              </a>
              <a href="javascript:;" class="tags"> 分类：<span>星球大战</span></a>
            </p>
            <a href="detail.php?pid=<?=$value['post_id'];?>" class="thumb">
              <img src="/admin/uploads/<?=$value['post_file'];?>" alt="">
            </a>
          </div>
        </div>
        <?php endforeach;?>
        
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
