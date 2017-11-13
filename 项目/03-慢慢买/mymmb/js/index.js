
$(function () {

    // 获取菜单数据
    $.ajax({
        type:'get',
        url:obj.base+obj.index,
        dataType:'json',
        success:function (data) {
            console.log(data);
            $('.menu_list').html(template('tpl',data));
        }
    })


    // 点击菜单切换隐藏
    $('.menu_list').on('click','.item:nth-child(8)',function () {
        // console.log(1);
        $('.item:nth-last-child(-n+4)').toggleClass('hide');
    })

    // 获取折扣数据
    $.ajax({
        type:'get',
        url:obj.base+obj.index1,
        dataType:'json',
        success:function (data) {
            console.log(data);
            $('.product_list').html(template('tpl2',data));
        }
    })
})
