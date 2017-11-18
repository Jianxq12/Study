
//1. 加载  
var express = require('express');
// var ejs = require('ejs')
var  path = require('path')

//2. 实例化
var app = express();

//5. 配置
// views: 固定名
// html 所在的文件夹目录
// 告诉浏览器 html 文件在哪个目录下 ( 放模板文件的目录)
app.set('views', path.join(__dirname,'./htmls'))

// 自定义一个自己的模板引擎
app.engine('html',require('ejs').renderFile)

//开始使用模板引擎
// view engine : 固定名
// 使用哪个模板引擎 ejs
app.set('view engine','html'); 


//3. 注册路由
app.get('/',function (req,res) {
  

  //1. render +ejs
  // res.render(path.join(__dirname,'./htmls/index.ejs'))

  // 第一个参数: 刚才指定文件夹目录下的一个文件名 不写后缀,不写路径
  // 第二个参数: 参数
  res.render('index', {name:' Jianxq'});

})

//4. 开启服务器
app.listen(8080)