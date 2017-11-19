
//1. 加载 express 
var express = require('express');
var config = require('./config')
var router = require('./router');
var  path = require('path');
var bodyParser = require('body-parser')

//2. 实例化
var app = express();

//注册路由
// router(app);

//4. 配置模板引擎
//4.1 模板文件的目录
app.set('views',path.join(__dirname,'./views'));
//4.2 自定义 html
app.engine('html',require('ejs').renderFile);
//4.3 开始使用模板引擎
app.set('view engine','html');

//5. body-parser
// urlencoded: 把 post 请求的数据,经过一系列转化,直接转化为对象
//extended: 以前不需要这个参数,查询 -> 对象 qs  第三方模块
// querystring : 查询字符串 --> 对象 
// qs : 拓展的   <=== extended:true
// querystring :非拓展的 <=== extended:false
app.use(bodyParser.urlencoded({extended:false}))


//3. 把路由 router 挂载到 app 上
app.use(router);


//4. 开启服务器
app.listen(config.port,function () {
  //E ADDR IN USE :::8080 
  console.log(`服务器开启了 http://localhost:${ config.port }`)
})