
$(function () {

    var couponid = tools.getParam('couponid');
    
    $.ajax({
        type:'get',
        url:obj.base+obj.getcouponproduct,
        data:{
            couponid:couponid
        },
        success:function (data) {
            console.log(data);

            $('.moneyctrl_content>ul').html(template('tpl',data));
        }
    })


    // 遮罩层轮播图
    var mySwiper = new Swiper ('.swiper-container', {
        loop: true,
        effect:"slide",

        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',

    })

    $('.moneyctrl_content').on('click','a',function () {
        $('.mask').fadeIn();

    })

    $('.close').on('click',function () {
        $('.mask').hide();
    })
})