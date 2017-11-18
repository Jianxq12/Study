/**
 * express + ejs 使用赋值
 * //1. 安装 ejs
 * //2. 配置
 * // 告诉浏览器 模板文件的目录
 * app.set('views', path.join(__dirname,'./htmls'))
 * // 开始使用 ejs 这个模板引起过  .ejs
 *  app.set('view engine','ejs');
 * 
 * //3. 使用
 * // index 就是刚才指定的 目录下的文件名
 * res.render('index',{name:'123'})
 */

//1. 加载  
var express = require('express');
// var ejs = require('ejs')
var  path = require('path')

//2. 实例化
var app = express();

//5. 配置
// views: 固定名
// html 所在的文件夹目录
// 告诉浏览器  html 文件在哪个目录下 ( 放模板文件的目录)
app.set('views', path.join(__dirname,'./htmls'))

//开始使用模板引擎
// view engine : 固定名
// 使用哪个模板引擎 ejs
app.set('view engine','ejs'); 


//3. 注册路由
app.get('/',function (req,res) {
  

  //1. render +ejs
  // res.render(path.join(__dirname,'./htmls/index.ejs'))

  // 第一个参数: 刚才指定文件夹目录下的一个文件名 不要写后缀,不要写路径
  // 第二个参数: 参数
  res.render('index', {name:' Jianxq'});

})

//4. 开启服务器
app.listen(8080)