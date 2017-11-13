
;(function () {

 var nav = document.querySelector(".jd_nav");
 var ul = nav.children[0];
 var lis = ul.children;


 //1. 思路：
   //1.1 ul在动，触摸ul， 给ul注册三个touch相关的事件
   //1.2 获取到触摸滑动的Y轴的距离，给ul设置translateY

 var startY = 0;
 var currentY = 0;//核心变量，记录每次移动完之后的位置

 ul.addEventListener("touchstart", function (e) {
   //1. 记录开始的位置
   startY = e.changedTouches[0].clientY;
 });


 //移动的时候，允许多移动50
 //结束的时候，如果发现多移动了，使用动画移回去
 ul.addEventListener("touchmove", function (e) {
   //2. 计算滑动的距离，让ul跟着移动
   var distance =  e.changedTouches[0].clientY - startY;

   var temp = currentY + distance;

   //只允许translateY 50
   if(temp >= 50){
     temp = 50;
   }

   if(temp <= nav.offsetHeight - ul.offsetHeight - 50){
     temp = nav.offsetHeight - ul.offsetHeight - 50
   }
   setTranslate(temp);


 });
 ul.addEventListener("touchend", function (e) {
   //结束时，需要记录当前的位置
   var distance =  e.changedTouches[0].clientY - startY;
   currentY = currentY + distance;

   if(currentY >= 0){
     currentY = 0;
   }
   if(currentY <= nav.offsetHeight - ul.offsetHeight){
     currentY = nav.offsetHeight - ul.offsetHeight;
   }
   addTransition();
   setTranslate(currentY);


 });

 function addTransition() {
   ul.style.transition = "all .2s";
   ul.style.webKitTransition = "all .2s";
 }
 function removeTransition() {
   ul.style.transition = "none";
   ul.style.webKitTransition = "none";
 }
 function setTranslate(value) {
   ul.style.transform = "translateY(" + value + "px)";
   ul.style.webkitTransform = "translateY(" + value + "px)";
 }
})();



// new IScroll('.jd_nav',{
//   scrollX:true,
//   scrollY:true
// });

// new IScroll(".jd_main",{
//   scrollY:true,
//   scrollX:false,
// });