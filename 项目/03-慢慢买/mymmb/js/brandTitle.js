
$(function () {

    $.ajax({
        type:'get',
        url:obj.base+obj.getbrandtitle,
        success:function (data) {
            console.log(data);
            $('.brand_list>ul').html(template('tpl',data));

        }
    })
})