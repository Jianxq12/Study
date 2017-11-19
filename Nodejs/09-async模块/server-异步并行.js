//1. 加载 
var async = require('async');
var fs = require('fs');
var  path = require('path');

//2. 使用  异步 并行  
// async.parallel ( tasks , callback )
//注意: callback(err,data);
async.parallel({
  a:function (callback) {
    fs.readFile(path.join(__dirname,'./a.txt'),function (err,data) {
      
      console.log('aaa');
      callback(err,'aaa');
    })
  },
  b:function (callback) {
    fs.readFile(path.join(__dirname,'./b.txt'),function (err,data) {
      
      console.log('bbb');
      callback(err,'bbb');
    })
  },
  c:function (callback) {
    fs.readFile(path.join(__dirname,'./c.txt'),function (err,data) {
      
      console.log('ccc');
      callback(err,'ccc');
    })
  }

},function (err,res) {

  //1. a b c 三者的完成时间,不确定
  //2. res 是 abc 全部执行完回调,才会执行当前结果
  //3. 使用场景: 三个请求没有互相依赖的情况下
  console.log('有结果了');
  console.log(res);
  
})
/**
 * 串行
 * 1.10s
 * 2.10s
 * 3.10s
 * 4. 渲染  >= 30s
 * 
 * 并行
 * 1.10s
 * 2.10s
 * 3.10s
 * 4. 渲染 10 =< time  
 */