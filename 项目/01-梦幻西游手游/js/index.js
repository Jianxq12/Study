/**
 * Created by dell on 2017/9/2.
 */
$(function () {
    $(".nav_top_inner .nav_ele a").mouseenter(function () {
        $(".dropdown_menu").stop().slideDown(1000)
    });
    $("#comman_nav_top").mouseleave(function () {
        $(".dropdown_menu").stop().slideUp(1000)
    });
    $(".pic-slide .tab_nav a").mouseenter(function () {
        var index = $(this).index();
        // console.log(index);
        // var ImgWidth = $(".slide-box-bg .pic-list")[0].Width;
        // console.log(ImgWidth);
        var ImgWidth = $(".slide-box-bg .pic-list").width();
        // var ImgWidth = $(".slide-box-bg .pic-list").css("width");
        // console.log(ImgWidth);
        $(".slide-box-bg .slide-wrap").stop().animate({left:-index * ImgWidth+"px"})
    });
    $('.btn-top').click(function () {
        console.log("333");
        $('html,body').animate({scrollTop:0},300)
    })
});
