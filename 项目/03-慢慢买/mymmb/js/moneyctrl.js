

$(function () {

    var pageid = 0;
    var totalPages = 1;
    
    function render() {
        
        $.ajax({
            type:'get',
            url:obj.base+obj.moneyctrl,
            dataType:'json',
            data:{
                pageid:pageid
            },
            success:function (data) {
                console.log(data);

                totalPages = Math.ceil(data.totalCount/data.pagesize);
                data.totalpages = totalPages;
                $('.moneyctrl_content>ul').html(template('tpl',data));
                $('.selpage').html(template('tpl2',data));
                $('.selpage').val(pageid+1);
                console.log(pageid);
            }
        })
    }
    render();

    // 上一页
    $('.prev').on('click',function () {

        if(pageid==0){
            return;
        }else{
            pageid--;
            render();
        }
    })

    // 下一页
    $('.next').on('click',function () {
        if(pageid==totalPages-1){
            return;
        }else{
            pageid++;
            render();
        }
    })

    // 下拉框
    $('.selpage').on('change',function () {
        pageid = $(this).val()-1;
        render();
    })


})