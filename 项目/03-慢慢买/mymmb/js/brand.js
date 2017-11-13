
$(function () {

    var brandtitleid=tools.getParam('brandtitleid');
    var productId = 4;
    var productImg='';
    var productName = '';

    $.ajax({
        type:'get',
        url:obj.base+obj.getbrand,
        data:{
            brandtitleid:brandtitleid
        },
        success:function (data) {
            console.log(data);
            $('.brand_list_content1>ul').html(template('tpl',data));
            
        }
    })

    
    $.ajax({
        type:'get',
        url:obj.base+obj.getbrandproductlist,
        data:{
            brandtitleid:brandtitleid
        },
        success:function (data) {
            console.log(data);
            $('.brand_list_content2>ul').html(template('tpl2',data));
            productId = data.result[0].productId;
            console.log(productId)
            productImg = data.result[0].productImg;
            productName = data.result[0].productName;
        }
    })
    setTimeout(function () {
        $.ajax({
            type:'get',
            url:obj.base+obj.getproductcom,
            data:{
                productid:productId
            },
            success:function (data) {
                console.log(data);
                console.log(productId)
                data.productImg = productImg;
                data.productName = productName;
                $('.brand_list_content3>ul').html(template('tpl3',data));
            }
        })
    },500)



})