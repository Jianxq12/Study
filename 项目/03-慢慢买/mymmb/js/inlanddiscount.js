
$(function () {
    window.onload = function () {

    var ul =document.querySelector('.indiscount>ul');

    function render() {
        $.ajax({
            type:'get',
            url:obj.base+obj.inlanddiscount,
            dataType:'json',
            success:function (data) {
                console.log(data);
                $('.indiscount>ul').html(template('tpl',data));
            }
        })
    }
    render();

    window.onscroll=function () {

        var scrollTop = window.pageYOffset;
        var pageHeight = window.innerHeight;
        var offsetTop = document.querySelector('.mmb_footer').offsetTop +50;
        // console.log(scrollTop,pageHeight,offsetTop);
        if(scrollTop+pageHeight>=offsetTop){
            // console.log(1);


                $.ajax({
                type:'get',
                url:obj.base+obj.inlanddiscount,
                dataType:'json',
                success:function (data) {
                    console.log(data);

                    var result = data.result;
                        for(var i =0;i<4;i++){


                            var li = document.createElement('li');
                            var str =
                                '<a href="#">'+
                                '<div class="pic">'+
                                result[i].productImg+
                                '</div>'+
                                '<p class="info">'+result[i].productName+'</p>'+
                                '<p class="price">'+result[i].productPrice+'</p>'+
                                '<p class="from">'+
                                '<span>'+result[i].productFrom+'</span>&nbsp;|&nbsp;'+
                                '<span>'+result[i].productTime+'</span>'+
                                '</p>'+
                                '</a>';
                            li.innerHTML=str;

                            ul.appendChild(li);
                        }
                }

            })
        }
    }
    }
})