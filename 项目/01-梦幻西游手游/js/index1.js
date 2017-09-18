$(function () {
    //给同人站添加背景图片
    $(".lunbo-one>ul>li").each(function (index,ele) {
        $(ele).css("background","url("+$(ele).attr("data-image")+")");
        $(ele).css("backgroundSize","100% 100%");
    });
    $(".lunbo-two>ul>li").each(function (index,ele) {
        $(ele).css("background","url("+$(ele).attr("data-image")+")");
        $(ele).css("backgroundSize","100% 100%");
    });

    //同人背景图片下面的小轮播
    var sCount = 0;
    $(".arrowLeft").click(function () {
        if(sCount == 0){
            $(".lunbo-two>ul").css("left",-4*92);
            sCount = 4;
        }
        sCount--;
        $(".lunbo-two ul").stop().animate({left : -sCount*92});
    });
    $(".arrowRight").click(function () {
        if(sCount == 4){
            $(".lunbo-two ul").css("left","0");
            sCount = 0;
        }
        sCount++;
        $(".lunbo-two ul").stop().animate({left : sCount*-92});
    });

    //同人站背景图片大轮播
    var count = 0;
    var picWidth = $(".lunbo-one ul li").width();
    setInterval(function () {
        if(count == 5){
            count = 0;
            $(".lunbo-one ul").css("left","0");
        }
        count++;
        $(".lunbo-one ul").stop().animate({left : -count*picWidth+"px"});
        $(".arrowRight").click();
    },1000);


    $(".link-two").mouseenter(function () {
        $(this).css("background","url(images/index_z_e2b1377.png) -208px -599px");
        $(".link-one").css("background","url(images/index_z_e2b1377.png) -418px -599px")
    });
    $(".link-one").mouseenter(function () {
        $(this).css("background","url(images/index_z_e2b1377.png) -523px -599px");
        $(".link-two").css("background","url(images/index_z_e2b1377.png) no-repeat -313px -599px")
    });

    var index = 0;
    var timer = setInterval(function () {
        var slide_wrap = document.getElementsByClassName("z-slide-wrap")[0];
        var slide_box_bg = document.getElementsByClassName("slide-box-bg")[0];
        var bg_width = slide_box_bg.offsetWidth;

        if(index == 5){
            index = 0;
            slide_wrap.style.left = 0;

        }else if(index == 0){
            index = 4;
            slide_wrap.style.left = -4 * bg_width + "px";
        }
        index++;
        myAnimate(slide_wrap,-bg_width*index);

        //轮播图下面的小图被选中
        if(index == 5){
            $(".slide-box-nav a").eq(0).addClass("on").siblings().removeClass("on");
        }else{
            $(".slide-box-nav a").eq(index).addClass("on").siblings().removeClass("on");
        }

        //最右边的轮换
        if(index % 2 == 1){
            $(".t-pic-box ul").animate({left : "-175px"});
            $(".r-b-block s").eq(0).addClass("change-color");
            $(".r-b-block s").eq(1).removeClass("change-color");
        }else{
            $(".t-pic-box ul").animate({left : "0"});
            $(".r-b-block s").eq(0).removeClass("change-color");
            $(".r-b-block s").eq(1).addClass("change-color");
        }
    },1000);

    //钱袋hover上移
    $(".entrance a").hover(function () {
        $(this).find("div").stop().animate({top : "-34px"},500);
    },function () {
        $(this).find("div").stop().animate({top : "0"},500);
    });

    //新闻hover背景块显示
    $(".new-nav>ul>li").mouseenter(function () {
        $(this).addClass("blue-box").siblings().removeClass("blue-box");
        $(".new-main").eq($(this).index()).addClass("news-main-show").siblings().removeClass("news-main-show");
    });


    //官方hover上，下面对应显示相应的div
    $(".zx-nav li").mouseenter(function () {
        $(this).addClass("gf-active").siblings().removeClass("gf-active");
        $(".gf-main .gf-main-one").eq($(this).index()).fadeIn().siblings().fadeOut();
    });

    //官方新闻下面设置背景图片
    $(".bg").each(function (index,ele) {
        $(ele).css("background","url("+$(ele).attr("data-image")+") no-repeat");

    });
    $(".gf-main-one>ul>li").mouseenter(function () {
        var index = $(this).index();
        console.log(index);
        if(index == 4){
            console.log($(".gf-main-one>ul>li"));
            $(this).prevAll().stop().animate({width : "0"});
            $(this).stop().animate({width : "280px"});
            $(this).prev().stop().animate({width : "1120px"});
            return ;
        }
        $(this).stop().animate({width : "1120px"});
        $(this).prevAll().stop().animate({width : "0"});
        $(this).nextAll().stop().animate({width : "280px"});
    });
    $(".gf-main-one>ul>li").mouseleave(function () {
       $(".gf-main-one>ul>li").stop().animate({width : "280px"})
    });

    //给赛事中心的内容添加背景图片
    $(".content-box-small").each(function (index,ele) {
        $(ele).css("background","url(images/game"+(index+1)+".png");
    })

//赛事中心外层hover
    $(".wu-nav>ul>li").mouseenter(function () {
        $(this).addClass("wu-nav-hover").siblings().removeClass("wu-nav-hover")
        $(".content-box-big").eq($(this).index()).addClass("show").siblings().removeClass("show");
    })
    //赛事中心内层hover
    $(".game-top-left>ul>li").mouseenter(function () {
        $(this).addClass("game-left-hover").siblings().removeClass("game-left-hover");
        $(".content-box-big.show").children(".content-box-small").eq($(this).index()).addClass("show").siblings().removeClass("show");
    })

    //赛事中心右侧的hover
    $(".ride-nav li").mouseenter(function () {
        $(this).addClass("wu-nav-hover").siblings().removeClass("wu-nav-hover");
        $(".ride-content div").eq($(this).index()).show().siblings().hide();
    })

    //掉金钱
    $(".gift_box").mouseenter(
        function () {
            money();
        }
    );
    function money() {
        for(var i = 0;i < 100;i++){
            var span = $("<span class='money'></span>");
            span.css({left : Math.round(Math.random()*2000)+"px"});
            $("body").append(span);
            span.animate({top : "1500px"},(i*40),function () {
                $(this).remove();
            });
        }
    }
});


