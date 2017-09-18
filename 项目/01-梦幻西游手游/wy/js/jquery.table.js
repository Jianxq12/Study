(function($){
    
    $.fn.table=function(option){
        var data=option.data;

        var tabArr=[]; //用数组进行字符串拼接

        //拼接表头
        var head=data[0];
        tabArr.push('<thead>');
        tabArr.push('<tr>');
        for (var i = 0; i < head.length; i++) {
            var obj = head[i];
            tabArr.push('<th>'+obj+'</th>');

        }
        tabArr.push('</tr>');
        tabArr.push('</thead>');

        //拼接表主体
        tabArr.push('<tbody>');
        for (var i = 1; i < data.length; i++) {
            var obj1 = data[i];
            tabArr.push('<tr>');
            for(var k in obj1){
                tabArr.push('<td>'+obj1[k]+'</td>');
            }
            tabArr.push('</tr>');

        }
        tabArr.push('</tbody>');

        var str=tabArr.join(''); //将数组中元素 拼接成字符串

        // console.log(tabArr);
        // console.log(str);

        $(this).html(str);//追加


    }
    
})(window.jQuery)
