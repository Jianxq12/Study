
var mySwiper = new Swiper ('.swiper-container', {
  // 如果需要分页器
  pagination: '.swiper-pagination',
  loop:true,
  autoplay:5000,
  autoplayDisableOnInteraction:false,//用户滑完成后可以继续开启定时器
  effect:"slide",//指定滑动效果
})