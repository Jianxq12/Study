
$(function () {

    var shopid = 0;
    var areaid = 0;

    $.ajax({
        type:'get',
        url:obj.base+obj.getgsshop,
        success:function (data) {
            console.log(data);
            $('.shop>ul').html(template('tpl',data));
        }
    })

    $.ajax({
        type:'get',
        url:obj.base+obj.getgsshoparea,
        success:function (data) {
            console.log(data);
            $('.area>ul').html(template('tpl2',data));
        }
    })

    function render() {
        $.ajax({
            type:'get',
            url:obj.base+obj.getgsproduct,
            data:{
                shopid:shopid,
                areaid:areaid
            },
            success:function (data) {
                console.log(data);
                $('.gsproduct_list>ul').html(template('tpl3',data));
            }
        })
    }

    render();
    
    // 点击切换显示隐藏
    $('.bcj_title li').each(function (i,e) {
        $(this).on('click',function () {
            $('.item').removeClass('active').eq(i).toggleClass('active');
        })
    })

    $('.shop').on('click','li',function () {

        $('.shop').toggleClass('active');
        $('#shop_t').html($(this).children().html());
        $(this).siblings().children('i').removeClass('on');
        $(this).children('i').addClass('on');
        shopid = $(this).data('shopid');
        render();
    })

    $('.area').on('click','li',function () {
        $('.area').toggleClass('active');
        $('#area_t').html($(this).children().html().substring(0,2));
        $(this).siblings().children('i').removeClass('on');
        $(this).children('i').addClass('on');
        areaid = $(this).data('areaid');
        render();
    })




})