
//入口函数,轮播图的功能
$(function () {

  var $carousel = $(".wjs_banner>.carousel");
  var $item = $carousel.find(".item");
  var $img = $carousel.find("img");


  $(window).on("resize", function () {

    //屏幕宽度
    var pageWidth = $(window).width();
    var isMobile = pageWidth >= 640 ? false : true;

    if (isMobile) {
      //如果是手机
      $item.removeClass("item_pc");
    } else {
      //如果是pc
      $item.addClass("item_pc");
    }

    $img.each(function (i, e) {

      var src = "";
      if (isMobile) {
        src = $(e).data("msrc");
      } else {
        src = $(e).data("psrc");
      }

      $(e).attr('src', src);

    });


    ////给所有的img设置src属性，值根据屏幕来判断，获取psrc或者msrc
    //for(var i = 0; i < $img.length; i++) {
    //
    //  //如果是两个参数 data(name,value):设置一个自定义属性
    //  //      data("id", 123);    //给标签设置了一个  data-id = "123"
    //  //如果是一个参数 data(name) :获取自定义属性
    //  var src = "";
    //  if(isMobile){
    //    src = $img.eq(0).data("msrc");
    //  }else {
    //    src =  $img.eq(0).data("psrc");
    //  }
    //
    //  //给图片设置src属性
    //  $img.eq(0).attr("src", src);
    //
    //}


  }).trigger("resize");


  var startX = 0;
  $carousel.on("touchstart", function (e) {
    //jquery对事件对象进行了一个包装
    startX = e.originalEvent.changedTouches[0].clientX;
    console.log(startX);
  });


  $carousel.on("touchend", function (e) {
    var distance = e.originalEvent.changedTouches[0].clientX - startX;

    //判断滑动是否
    if(Math.abs(distance) >= 100){
      if(distance > 0){
        $carousel.carousel("prev");
      }

      if(distance < 0){
        $carousel.carousel("next");
      }
    }

  });

});



//导航的功能
$(function () {
  var $nav = $(".wjs_product .nav");
  var $li = $nav.children();
  //1. 计算nav的宽度
  var width = 0;
  $li.each(function () {

    //width:获取width
    //innerWidth: 获取的padding + width
    //outerWidth(false): 获取的border + padding + width
    //outerWidth(true) : 获取的margin + border + padding + width
    width += $(this).outerWidth(true);

  });

  $nav.width(width);
  //2. 使用iscroll插件
  new IScroll(".nav_wrap",{
    scrollX:true,
    scrollY:false
  });
});