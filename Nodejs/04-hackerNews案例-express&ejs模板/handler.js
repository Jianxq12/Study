
// 加载模块
var  path = require('path')

// index
module.exports.index = function (req,res) {
  
  // res.send('index');

  //1. 响应 index 页面
  // 这个方法只能渲染静态页面,,不能赋值,只能单纯的展示
  // res.sendFile( path.join(__dirname,'./views/index.html'))

  //1. 需要数据 
  //2. 模板引擎
  //3. 数据复制模板引擎

  //2. 可以传值 ,但是必须配合模板引擎使用
  // 配合 模板引擎  jade ejs 
  // res.render(path.join(__dirname,'./views/index.html'))

  var list = [{
    title:'Jianxq',
    url:'Jianxq.com',
    text:'她在学习呢'
  },{
    title:'Jianxq1',
    url:'Jianxq1.com',
    text:'她也在学习呢'
  }]

  res.render('index',{ list: list });

}

// detail
module.exports.detail = function (req,res) {
  
  res.send('detail')
}

//submit
module.exports.submit = function (req,res) {
  
  res.send('submit');
}

//add get
module.exports.addGet = function (req,res) {
  res.send('addGet')
}

//add post
module.exports.addPost = function (req,res) {
  
  res.send('addPost')
}