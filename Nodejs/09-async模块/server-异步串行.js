/**
 * async 异步模块
 * 作用: 解决回调地狱的问题
 * $.ajax(function(){
 *    $.ajax(function(){
 *          $.ajax(function(){
 *               $.ajax(function(){
 *    
 *              })
 *           })
 *     })
 * })
 */


//1. 加载 async 
var async = require('async');
var fs = require('fs');
var path = require('path');

//2. 异步 串行  (同步)
// async.series (tasks,callback) 
async.series({
  a: function (callback) {

    fs.readFile(path.join(__dirname, './a.txt'), 'utf8', function (err, data) {

      setTimeout(function () {

        console.log('aaa');
        callback(err, 'aaa')

      }, 5000);

    })
  },
  b: function (callback) {

    fs.readFile(path.join(__dirname, './b.txt'), 'utf8', function (err, data) {

      console.log('bbb');
      callback(err, 'bbb')
    })
  },
  c: function (callback) {

    fs.readFile(path.join(__dirname, './c.txt'), 'utf8', function (err, data) {

      console.log('ccc');
      callback(err, 'ccc')
    })
  }

}, function (err, res) {

  console.log('有结果了');
  console.log(res);

})

/**
 * 1. 因为使用的 async.series() 是串行的
 * 2. resd 的值: { a: 'aaa', b: 'bbb', c: 'ccc' }
 */









//3. 异步 并行