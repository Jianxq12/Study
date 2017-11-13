
$(function () {

    $.ajax({
        type:'get',
        url:obj.base+obj.getcoupon,
        success:function (data) {
            console.log(data);
            $('.coupon>ul').html(template('tpl',data));
        }
    })
})