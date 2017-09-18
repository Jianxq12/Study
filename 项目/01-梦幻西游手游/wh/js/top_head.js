/**
 * Created by dell on 2017/9/1.
 */
$(function () {
   $(".top-bar-main .mulu").mouseenter(function () {
       $(this).css({"background":"#f3f3f3",
           "border-bottom":"3px solid #bc2e2e",
           "box-sizing":"border-box",
       });
       $("#top_head_menu").show(800);
   });
   $("#top_head_menu").mouseleave(function () {
       $(".top-bar-main .mulu").css({"background": "none","border-bottom": 0});
       $(this).hide(800);
   });
    var t;
    var index = 0;
    function showAuto(){
        index++;
        if(index > 1){
            index = 0
        }
        $(".chongzhi li").eq(index).stop().fadeIn(1000).siblings().stop().fadeOut(1000);
    }
    clearInterval(t);
    t = setInterval(showAuto, 3000);
});
