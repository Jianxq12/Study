// 加载模块
var path = require('path')
var db = require('./db');

// index
module.exports.index = function (req, res) {

  //1. 从数据库里获取全部数据
  db.findAll('one',function (docs) {

     //2. 渲染
     res.render('index',{ list:docs })
    
  })

}

// detail
module.exports.detail = function (req, res) {

  //1. 获取 _id
 var _id =  db.objectId(req.query._id);

  //2. 可以根据条件查找
  db.findOne('one',_id,function (doc) {

    //3.渲染
    res.render('detail',{ list: doc })
    
  })

}

//submit
module.exports.submit = function (req, res) {

  res.render('submit')
}

//add get
module.exports.addGet = function (req, res) {

  //1. 获取对象
  var obj = {
    title: req.query.title,
    url: req.query.url,
    text: req.query.text
  };

  //2. 插入到数据库
  db.insertOne('one',obj,function () {
    
    //3. 重定向
    res.redirect('/')
  })
}

//add post
module.exports.addPost = function (req, res) {

  //1. 获取新的对象
  var obj = {
    title: req.body.title,
    url: req.body.url,
    text: req.body.text
  }

  //2. 插入到数据库
  db.insertOne('one',obj,function () {
    
    //3. 重定向
    res.redirect('/');
  })
  


}