//1.加载 http
var http = require('http');

// var mie = require('');
//3.  加载模块
var config = require('./config');
var context = require('./context');
var router = require('./router');

//2. 创建服务器 开启服务器  开始监听
http.createServer(function (req, res) {

  // 渲染
  context(res);


  //路由
  router(req,res);

}).listen(config.port, function () {
  console.log('开启了')
})