/**
 * Created by WAF on 2017/9/6.
 */
$(function(){
    $('.one-left a').eq(0).mouseenter(function(){
        $(this).css('backgroundPosition','-136px -16px')
    })
    $('.one-left a').eq(0).mouseleave(function(){
        $(this).css('backgroundPosition','0 -228px')
    })
    $('.one-left a').eq(1).mouseenter(function(){
        $(this).css('backgroundPosition','-136px -84px')
    })
    $('.one-left a').eq(1).mouseleave(function(){
        $(this).css('backgroundPosition','0 -296px')
    })
    $('.one-right a').eq(0).mouseenter(function(){
        $(this).css('backgroundPosition','-385px 0px')
    })
    $('.one-right a').eq(0).mouseleave(function(){
        $(this).css('backgroundPosition','-385px -490px')
    })
    $('.one-right a').eq(1).mouseenter(function(){
        $(this).css('backgroundPosition','-385px -90px')
    })
    $('.one-right a').eq(1).mouseleave(function(){
        $(this).css('backgroundPosition','0 -354px')
    })
    $('.one-right a').eq(2).mouseenter(function(){
        $(this).css('backgroundPosition','-546px -90px')
    })
    $('.one-right a').eq(2).mouseleave(function(){
        $(this).css('backgroundPosition','0 -422px')
    })
    var lis=$('.two-down li');

    for(var i= 0;i<lis.length;i++){
        var index=lis[i].index;
        $(lis[i]).click(function(){
            var ix=$(this).index();
            $(this).addClass("xg").siblings().removeClass("xg");
            if($(this).hasClass()){
                $(this).stop().animate({width:'87px'},200).siblings().css('width','72px');
                $(this).css({background:'url(tupian/d'+(ix+1)+'.png) no-repeat'},200)
            }
            $('.xBody-two ul').css('top',-(ix*470)+'px');
        });
        $(lis[i]).mouseenter(function(){
            var ix=$(this).index();
            $(this).stop().animate({width:'87px'},200).siblings().css('width','72px');
            $(this).css({background:'url(tupian/d'+(ix+1)+'.png) no-repeat'},200)
        });
        $(lis[i]).mouseleave(function(){
            var ix=$(this).index();
            if($(this).hasClass()==false){
                $(this).stop().animate({width:'87px'},200).siblings().css('width','72px');
                $(this).css({background:'url(tupian/'+(ix+1)+'.png) no-repeat'},200)
            }
        })
    }























































})