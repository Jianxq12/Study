// 加载
var mongodb = require('mongodb')
var config = require('./config');


/**
 * 连接数据库
 */
function ml_connectDB(callback) {


  //2.1 连接对象
  var mc = mongodb.MongoClient;
  //2.2 连接字符串
  var url = config.dbUrl;
  //2.3 开始连接
  mc.connect(url, function (err, db) {
    if (err) {
      throw err
    }

    callback(db);
  })
}

// return
// 在`异步`里返回数据,,,使用 callback
module.exports.findAll = function (collectionName, callback) {

  //1.1 连接对象
  ml_connectDB(function (db) {

    //1.4 获取全部数据
    db.collection(collectionName).find().toArray(function (err, docs) {
      if (err) {
        throw err
      }

      //1.5 关闭数据库
      db.close();

      //返回数据
      callback(docs);

    })
  })
}

module.exports.findOne = function (collectionName, _id, callback) {
  //2.1 连接对象
  ml_connectDB(function (db) {
    //2.4 根据已有条件进行条件查询
    db.collection(collectionName).findOne({
      _id: _id
    }, function (err, doc) {

      if (err) {
        throw err
      }

      //2.5 关闭数据库
      db.close();

      //返回
      callback(doc);

    })
  })

}


module.exports.insertOne = function (collectionName, obj, callback) {

  //2.1 连接对象
  ml_connectDB(function (db) {

    //2.4 插入数据
    db.collection(collectionName).insertOne(obj, function (err) {
      if (err) {
        throw err
      }

      //2.5 关闭数据库
      db.close();

      //执行回调
      callback()
    })
    
  })


}

// 传进来一个字符串 id  --> objectId
module.exports.objectId = function (idStr) {
  // var _id = mongodb.ObjectId(req.query._id);

  return mongodb.ObjectId(idStr);
}