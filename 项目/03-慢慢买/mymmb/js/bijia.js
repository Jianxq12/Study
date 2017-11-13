
$(function () {

    var productid = tools.getParam('productid');
    var category = tools.getParam('category');

    // 获取商品详情
    $.ajax({
        type:'get',
        url:obj.base+obj.getproduct,
        dataType:'json',
        data:{
            productid:productid
        },
        success:function (data) {
            data.category=category;
            console.log(data);
            $('.product_bijia_nav').html(template('tpl',data));
            $('.product_bijia_content').html(template('tpl2',data));
            $('.amount').html(template('tpl4',data));
        }
    })

    // 获取商品评论
    $.ajax({
        type:'get',
        url:obj.base+obj.productcom,
        dataType:'json',
        data:{
            productid:productid
        },
        success:function (data) {
            console.log(data);
            $('.comment_list>ul').html(template('tpl3',data));
        }
    })




})