
//加载
var mongodb = require('mongodb');

const DB_URL = 'mongodb://127.0.0.1:27017/sms';



function ml_connectDB(callback) {

   //1.1 连接对象
   var mc = mongodb.MongoClient;
   //1.2 连接字符串
   var url = DB_URL;
   //1.3 开始连接
   mc.connect(url,function (err,db) {
     if (err) {
       throw err;
     }

     //返回
     callback(db);
    })

}



// 查询全部
/**
 * 查询全部 (1-集合名称 2-callback)
 */
module.exports.findAll = function (collectionName,callback) {

  //1.1 连接对象

  ml_connectDB(function (db) {

    //1.4 操作(查询全部数据)
    db.collection(collectionName).find().toArray(function (err,docs) {

      //1.5 关闭数据库
      db.close();

      //返回数据
      callback(err,docs);

    });
  })

}

//查询单条
/**
 * 查询单条 (1-col 2-_id 3-callback)
 */
module.exports.findOne = function (collectionName,_id,callback) {


  ml_connectDB(function (db) {

    //2.4 查询单条数据
    db.collection(collectionName).findOne({_id},function (err,doc) {

      //2.5 关闭数据库
      db.close();

      //返回
      callback(err,doc);

    });
  });
}

//字符串 id  => objectId 的 id
module.exports.ml_ObjectId = function (idStr) {
  
   return  mongodb.ObjectId(idStr);
}

/**
 *  插入单条数据 (1-col 2-obj 3-callback)
 */
module.exports.insertOne = function (collectionName,obj,callback) {


  ml_connectDB(function (db) {

    //2.4 插入单条数据
    db.collection(collectionName).insertOne(obj,function (err) {

      //2.5 关闭数据库
      db.close();

      // 返回
      callback(err);

    });

  });
  
}

/**
 *  更新数据 (1-col 2-id 3-obj 4-callbak)
 */
module.exports.updateOne = function (collectionName,_id,obj,callback) {


  ml_connectDB(function (db) {
   
    //4. 更新
    db.collection(collectionName).updateOne({_id},obj,function (err) {

      //5. 关闭数据库
      db.close()

      //返回
      callback(err);
    })
  })
}


/**
 * 删除单条数据 (1-col 2-id 3-callback)
 */
module.exports.deleteOne = function (collectionName,_id,callback) {


  ml_connectDB(function (db) {
 
     //2.4 删除 单条
     db.collection(collectionName).deleteOne({_id},function(err){

        //2.5 关闭数据库
        db.close();

        //返回
        callback(err);
      })

    })
}