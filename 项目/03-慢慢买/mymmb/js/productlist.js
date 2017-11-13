
$(function () {
    var categoryid = tools.getParam('categoryid');
    var category = tools.getParam('category');
    var pageid = tools.getParam('pageid');
    var totalpages = 1;
    // console.log(categoryid);

    // 获取菜单分类名
    $.ajax({
        type:'get',
        url:obj.base+obj.categoryname,
        dataType:'json',
        data:{
            categoryid:categoryid
        },
        success:function (data) {
            console.log(data);
            $('.product_list_title').html(template('tpl',data));
        }
    })

    // 获取商品列表
    function getproductlist() {
        $.ajax({
            type:'get',
            url:obj.base+obj.productlist,
            dataType:'json',
            data:{
                categoryid:categoryid,
                category:category,
                pageid:pageid
            },
            success:function (data) {
                var pages = Math.ceil(data.totalCount/data.pagesize);
                totalpages=pages;
                data.totalpages=pages;
                data.pageid= pageid;
                data.category=category;
                console.log(data);
                $('.product_list_content').html(template('tpl2',data));
            }
        })
    }
    getproductlist();


    // 点击切换分页
    $('.product_list_content').on('click','.prev',function () {
        // console.log(1);

        if(pageid==1){
            return;
        }else{
            pageid--;
            console.log(pageid);
            getproductlist();
        }

    })

    $('.product_list_content').on('click','.next',function () {
        // console.log(2);

        if(pageid==totalpages){
            return;
        }else {
            pageid++;
            console.log(pageid);
            getproductlist();
        }

    })

    $('.product_list_content').on('change','.selpage',function () {
        // console.log($(this).val());
        pageid = $(this).val();
        getproductlist();
    })
    

    
})
