
//1. 加载 express 
var express = require('express');
var config = require('./config')
var router = require('./router');
var  path = require('path');

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

//3. 把路由 router 挂载到 app 上
app.use(router);


//4. 开启服务器
app.listen(config.port,function () {
  console.log(`服务器开启了 http://localhost:${ config.port }`)
})