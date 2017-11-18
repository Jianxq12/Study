
var _ = require('underscore')
var  fs = require('fs');

// module.exports = {}

module.exports = function (res) {


  res.ml_render = function (filename, tplData) {

    //1. 读取文件
    fs.readFile(filename, function (err, data) {
      if (err) {
        throw err
      }

      var html = data;
      // 静态资源是不需要转化为字符串的
      if (tplData) {

        //1. 模板字符串
        // console.log(data);
        html = data.toString('utf8');
        //2. 模板函数
        var fn = _.template(html);
        //3. 传值
        html = fn({
          list: tplData
        })
      }

      //2. 结束响应并响应结果
      res.end(html);
    })
  }

}