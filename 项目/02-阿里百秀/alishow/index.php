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
    <?php include_once 'left.php';?>
    <div class="content">
      <div class="swipe">
<?php 
$sql = "select * from ali_pic where pic_state='显示' limit 0,4";
$pic_list = $m->selectAll($sql);
?>
        <ul class="swipe-wrapper">
          <?php foreach ($pic_list as $value):?>
          <li>
            <a href="#">
              <img src="/admin/uploads/<?=$value['pic_url'];?>">
              <span><?=$value['pic_txt'];?></span>
            </a>
          </li>
          <?php endforeach;?>
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
<?php 
$sql = "select * from ali_post where post_hot=1 order by post_addtime desc limit 0,5";
$hot_post = $m->selectAll($sql);
?>
        <h3>焦点关注</h3>
        <ul>
          <?php foreach ($hot_post as $key=>$value):?>
          <?php if($key == 0):?>
          <li class="large">
          <?php else: ?>
          <li>
          <?php endif;?>
            <a href="javascript:;">
              <img src="/admin/uploads/<?=$value['post_file'];?>" alt="">
              <span><?=$value['post_title'];?></span>
            </a>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
<?php 
$sql = "SELECT * FROM ali_post ORDER BY post_addtime DESC,post_click DESC LIMIT 0,5";
$click_post = $m->selectAll($sql);
?>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
          <?php foreach ($click_post as $key=>$value):?>
          <li>
            <i><?=$key+1;?></i>
            <a href="javascript:;"><?=$value['post_title'];?></a>
            <a href="javascript:;" class="like">赞(<?=$value['post_good'];?>)</a>
            <span>阅读 (<?=$value['post_click'];?>)</span>
          </li>
          <?php endforeach;?>
        </ol>
      </div>

      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
<?php 
$sql = "SELECT post_id,cate_name,post_title,user_nickname,post_file,post_addtime,post_desc,post_click,post_good,num FROM ali_post p
  LEFT JOIN ali_user u ON p.post_author=u.user_id
  LEFT JOIN ali_cate c ON p.post_cateid=c.cate_id
  LEFT JOIN (SELECT cmt_postid,COUNT(*) num FROM ali_comment GROUP BY cmt_postid) cmt ON cmt.cmt_postid=p.post_id
order by post_addtime desc limit 0,3";
$new_list = $m->selectAll($sql);
?>
      <div class="panel new">
        <h3>最新发布</h3>
        <?php foreach ($new_list as $value):?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?=$value['cate_name'];?></span>
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
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
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
  <script src="assets/vendors/jquery/jquery.js"></script>
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    })
  </script>
</body>
</html>
