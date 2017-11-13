
$(function () {
    var ulWidth = 0;
    var titleid = 0;
    $.ajax({
        type:'get',
        url:obj.base+obj.baicaijiatitle,
        data:{
            titleid:0
        },
        success:function (data) {
            console.log(data);

            $('.bcj_title>ul').html(template('tpl',data));

            // 动态计算ul宽度
            // liWidth = $('.bcj_title>ul li').eq(0).outerWidth();
            // console.log(liWidth);
            // var num = data.result.length;
            // console.log(num);
            // $('.bcj_title>ul').width(liWidth*num);
            $('.bcj_title>ul li').each(function (i,e) {
                ulWidth += $(e).outerWidth();
            })
            console.log(ulWidth);
            $('.bcj_title>ul').width(ulWidth);

        }
    })

    function render() {
            $.ajax({
                type:'get',
                url:obj.base+obj.baicaijiaproduct,
                data:{
                    titleid:titleid
                },
                success:function (data) {
                    console.log(data);
                    $('.moneyctrl_content>ul').html(template('tpl2',data));
                }
            })
    }
    render();
    
    // 点击切换
    $('.bcj_title').on('click','a',function () {
        var $this = $(this);
        titleid = $this.data('titleid');
        $this.addClass('active').parent().siblings().children().removeClass('active');

        render();
    })
    
        // 标题栏滚动
        setTimeout(function () {
            new IScroll('.bcj_title',{
                scrollX:true,
                scrollY:false
            })
        },1000)



})