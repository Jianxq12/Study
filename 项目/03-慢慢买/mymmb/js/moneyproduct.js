
$(function () {
    var productid=tools.getParam('productid');

    $.ajax({
        type:'get',
        url:obj.base+obj.moneyctrlproduct,
        dataType:'json',
        data:{
            productid:productid
        },
        success:function (data) {
            console.log(data);
            $('.money_content').html(template('tpl',data));
        }
    })
})