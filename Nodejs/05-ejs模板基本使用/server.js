
//1. 加载  ejs
var ejs = require('ejs')
var path = require('path');

//2. 使用
// ejs.renderFile(filename, data, options, function(err, str){   //str 就是新的 html
//   // str => Rendered HTML string 
// });

//1. 模板字符串
var filename = path.join(__dirname,'./index.html');

//2. ejs 进行渲染
ejs.renderFile(filename,{ name: 'Jianxq'},function (err,str) {

  if (err) {
    throw err
  }

  console.log(str);
})


