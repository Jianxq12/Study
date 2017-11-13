

$(function () {

    $.ajax({
        type:'get',
        url:obj.base+obj.getsitenav,
        success:function (data) {
            console.log(data);
            $('.sitenav').html(template('tpl',data));
        }
    })
})