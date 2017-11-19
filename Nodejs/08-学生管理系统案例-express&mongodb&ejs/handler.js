/**
 * 业务模块
 */
var db = require('./db');
var async = require('async');

// 常量 字符串
const DB_URL = 'mongodb://127.0.0.1:27017/sms';
// 只负责集合名称
const STUDENTS_COL = 'students';
const CITIES_COL = 'cities';
const MAJORS_COL = 'majors';

module.exports.index = function (req, res) {

  // render 要配合模板引擎 ejs 使用 即时不传值
  res.render('index');
}

//students
module.exports.students = function (req, res) {

  //1. 先从数据库 获取全部的数据
  db.findAll(STUDENTS_COL, function (err, docs) {
    if (err) {
      throw err;
    }

    //2. 渲染
    res.render('students', {
      list: docs
    })
  })
}

//详情页
module.exports.info = function (req, res) {

  //1. 获取 _id
  // var _id = req.query._id;
  // var _id =  mongodb.ObjectId(req.query._id);
  var _id = db.ml_ObjectId(req.query._id);

  //2. 查询单条数据
  db.findOne(STUDENTS_COL, _id, function (err, doc) {

    if (err) {
      throw err;
    }

    //3. 渲染
    res.render('info', {
      item: doc
    });

  })

}

// 显示 add 页面
module.exports.showAdd = function (req, res) {

  //1. 获取 cities 集合 里的全部数据
  db.findAll(CITIES_COL, function (err, data_cities) {

    if (err) {
      throw err;
    }

    //2. 获取 majors 集合 里的全部数据
    db.findAll(MAJORS_COL, function (err, data_majors) {

      if (err) {
        throw err;
      }

      //3. 渲染
      res.render('add', {
        cities: data_cities,
        majors: data_majors
      })

    })
  })
}

// 提交 add
module.exports.submitAdd = function (req, res) {

  //1. 获取对象
  console.log(req.body);
  var obj = {
    sno: req.body.sno,
    sname: req.body.sname,
    sgender: req.body.sgender == 'M' ? '男' : '女',
    sbirthday: req.body.sbirthday,
    sphone: req.body.sphone,
    saddr: req.body.saddr,
    smajor: req.body.smajor
  }

  //2. 插入到数据库
  db.insertOne(STUDENTS_COL, obj, function (err) {
    if (err) {
      throw err;
    }

    //3. 重定向
    res.redirect('/students');

  })
}

// 显示编辑页面
module.exports.showEdit = function (req, res) {

  //方法 async.parallel( tasks , 回调 )
  async.parallel({

    one:function (callback) {
      db.findAll(CITIES_COL, function (err, data_cities) {
        console.log('data_cities');
        callback(err,data_cities);
      })      
    },
    two:function (callback) {
      db.findAll(MAJORS_COL,function (err,data_majors) {
        console.log('data_majors')
        callback(err,data_majors);
      })
    },
    three:function (callback) {
      //获取_ id
      var _id = db.ml_ObjectId(req.query._id);
      //查询单条数据
      db.findOne(STUDENTS_COL,_id,function (err,doc) {
        console.log('doc');
        callback(err,doc);
      })
    }

  },function (err,result) {

    console.log('有结果了')
    console.log(res);

    // 开始渲染
    res.render('edit',{ cities: result.one, majors: result.two, item:result.three })
  })

}

// 提交编辑页面
module.exports.submitEdit = function (req,res) {

  //1. 获取 post 请求的 对象
  console.log(req.body);
  var  obj = {
    sno: req.body.sno,
    sname:req.body.sname,
    sgender:req.body.sgender == 'M' ? '男' : '女',
    sbirthday:req.body.sbirthday,
    sphone:req.body.sphone,
    saddr:req.body.saddr,
    smajor:req.body.smajor
  }
  //2. 更新
  //2.1 获取 _id
  var _id = db.ml_ObjectId(req.body._id);
  //2.2 更新
  db.updateOne(STUDENTS_COL,_id,obj,function (err) {

    if (err) {
      throw err;
    }

    //3. 重定向
    res.redirect('/students')
    
  })


}

// 处理删除
module.exports.delete = function (req,res) {

   //1. 获取 _id
   var _id =  db.ml_ObjectId(req.query._id);

   //2. 删除
  db.deleteOne(STUDENTS_COL,_id,function (err) {
    if (err) {
      throw err;
    }

    //3. 重定向
    res.redirect('/students');
    
  })

}