//1. 加载  express
var express = require('express')

//2. 实例化
var app = express();

//3. 注册路由
//第一个方式 : app.METHOD  (get/post/put/delete....) 
// 类型:  类型固定
// 匹配路径: 绝对匹配
app.get('/',function (req,res) {
  
  res.send('index');
}) 
app.get('/index',function (req,res) {
  
  res.send('index index');
}) 
app.post('/login',function (req,res) {
  
  res.send('login');
}) 

//第二种方式: app.use()
// 类型:  类型不固定,任意类型
// 匹配路径: req.url 请求路径的 第一部分 与 path 参数 匹配即可
// /index/login/123    /
app.use('/index',function (req,res) {
  
  res.send('index');
})

//第三种方式: app.all()
// 类型:  类型不固定,任意类型
// 匹配路径: 绝对匹配
app.all('/index',function (req,res) {
  
  res.send('all index')
})


//4. 开启服务器
app.listen(8080)