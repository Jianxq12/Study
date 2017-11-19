
//1. 加载 express
var  express = require('express');
var config = require('./config');
var router = require('./router');
var path = require('path')
var bodyParser = require('body-parser');

var  myBodyParser = require('./my-body-parser');

//2. 实例化 app
var app = express();

//5. 配置模板引擎
//5.1 告诉浏览器模板文件的目录
app.set('views',path.join(__dirname,'./htmls'));
//5.2 创建自定义 html 模板引擎
app.engine('html',require('ejs').renderFile);
//5.3 使用 html 模板引擎
app.set('view engine','html');

//6. 配置 body-parser
// 使用 非拓展的  querystring  req.body
// post -> buffer -> 查询string + querystring -> {}
app.use(bodyParser.urlencoded({extended:false}))

// app.use(myBodyParser);

//3. 挂载路由
app.use('/',router);

//4. 开启服务器并监听
app.listen(config.port,function () {
  console.log(`服务器开启了, http://localhost:${ config.port }`)
})