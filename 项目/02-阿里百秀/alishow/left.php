<?php 
include_once 'admin/tools/Mysql.class.php';
$m = new Mysql();

//拼接查询cate的sql语句
$sql = "select * from ali_cate where cate_show=1";
$cate_list = $m->selectAll($sql);

//随机推荐数据获取
$sql = "select * from ali_post order by rand() limit 0,5";
$rand_post = $m->selectAll($sql);

//最新评论
$sql = "SELECT m.member_name,c.cmt_content,c.cmt_time FROM ali_comment c
 LEFT JOIN ali_member m ON c.cmt_memid=m.member_id
 ORDER BY c.cmt_time DESC LIMIT 0,6";
$new_comment = $m->selectAll($sql);
?>
<div class="header">
      <h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
        <?php foreach ($cate_list as $value):?>
        <li><a href="list.php?cid=<?=$value['cate_id'];?>">
            <i class="fa <?=$value['cate_class'];?>"></i>
            <?=$value['cate_name'];?></a>
        </li>
        <?php endforeach;?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
 <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random">
          <?php foreach ($rand_post as $value):?>
          <li>
            <a href="javascript:;">
              <p class="title"><?=$value['post_title'];?></p>
              <p class="reading">阅读(<?=$value['post_click'];?>)</p>
              <div class="pic">
                <img src="/admin/uploads/<?=$value['post_file'];?>" alt="">
 <!--  全路径
 www.alishow.com/admin/uploads/../uploads/2348815439487409.jpg
 -->
              </div>
            </a>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
<?php foreach ($new_comment as $value):?>
<li>
<a href="javascript:;">
  <div class="avatar">
    <img src="uploads/avatar_1.jpg" alt="">
  </div>
  <div class="txt">
    <p>
      <span><?=$value['member_name'];?></span>9个月前(<?=date('m-d', $value['cmt_time']);?>)说:
    </p>
    <p><?=$value['cmt_content'];?></p>
  </div>
</a>
</li>
<?php endforeach;?>
        </ul>
      </div>
    </div>

    
    
    
    
    