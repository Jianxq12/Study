
$(function () {

    // 获取分类标题
    $.ajax({
        type:'get',
        url:obj.base+obj.categorytitle,
        dataType:'json',
        success:function (data) {
            console.log(data);
            $('.category>ul').html(template('tpl',data));


        }
    })

    // 点击切换显示分类内容
    $('.category>ul').on('click','.category_title',function () {
        var $this=$(this);
        $this.siblings().toggleClass('hide');

        if(!$this.siblings().hasClass('hide')){
            var titleId =$this.data('id');
            $.ajax({
                type:'get',
                url:obj.base+obj.categorycontent,
                dataType:'json',
                data:{
                    titleid:titleId
                },
                success:function (data) {
                    console.log(data);
                    $this.siblings().html(template('tpl2',data));
                }
            })
        }

    })

    // 获取分类内容



})

