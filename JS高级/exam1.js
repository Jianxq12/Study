
(function (window,document) {
    /*
     1. 假定从 服务器端取得数据:
     var responseText =
     '纪明杰,m,1973-3-31,2005-1-15,四川省  阿坝藏族羌族自治州,Corey1973****@yahoo.cn,1319856****;' +
     '邓健柏,m,1975-11-30,2008-1-15,广东省  潮州市,Andrew1975****@yeah.net,1388854****;' +
     '濮阳语儿,f,1984-1-31,2012-5-15,安徽省  巢湖市,Charlotte1984****@yahoo.cn,1391870****;' +
     '嵇志强,m,1979-7-31,2007-12-15,河南省  漯河市,Levi1979****@21cn.com,1591810****;' +
     '居博超,m,1986-12-31,2008-5-15,江苏省  南通市,Enoch1986****@yahoo.com.cn,1382514****;' +
     '窦弘文,m,1974-2-28,2007-5-15,贵州省  安顺市,Bartholomew1974****@yeah.net,1595328****;' +
     '邰浩然,m,1989-4-30,2009-2-15,广东省  茂名市,King1989****@yahoo.com.cn,1382430****;' +
     '弓天磊,m,1986-12-31,2005-11-15,安徽省  黄山市,Bowen1986****@yahoo.cn,1584443****';

     要求在页面中生成表格展示该数据
     */

    var responseText =
        '纪明杰,m,1973-3-31,2005-1-15,四川省  阿坝藏族羌族自治州,Corey1973****@yahoo.cn,1319856****;' +
     '邓健柏,m,1975-11-30,2008-1-15,广东省  潮州市,Andrew1975****@yeah.net,1388854****;' +
     '濮阳语儿,f,1984-1-31,2012-5-15,安徽省  巢湖市,Charlotte1984****@yahoo.cn,1391870****;' +
     '嵇志强,m,1979-7-31,2007-12-15,河南省  漯河市,Levi1979****@21cn.com,1591810****;' +
     '居博超,m,1986-12-31,2008-5-15,江苏省  南通市,Enoch1986****@yahoo.com.cn,1382514****;' +
     '窦弘文,m,1974-2-28,2007-5-15,贵州省  安顺市,Bartholomew1974****@yeah.net,1595328****;' +
     '邰浩然,m,1989-4-30,2009-2-15,广东省  茂名市,King1989****@yahoo.com.cn,1382430****;' +
     '弓天磊,m,1986-12-31,2005-11-15,安徽省  黄山市,Bowen1986****@yahoo.cn,1584443****';

    // console.log(responseText);

    var arr = responseText.split(";");
    // console.log(arr);
    // console.log(arr[0].split(","));

    var newArr = [];

    var table = document.createElement("table");
    document.body.appendChild(table);

    var tbody = document.createElement("tbody");
    table.appendChild(tbody);

    for (var i = 0; i < arr.length; i++) {
        newArr.push(arr[i].split(","));
        var tr = document.createElement("tr");
        tbody.appendChild(tr);

        // console.log(newArr);
        for (var j = 0; j < newArr[i].length; j++) {
            var td = document.createElement("td");
            td.innerHTML = (newArr[i][j]);
            tr.appendChild(td);
        }
    }
})(window,document)