/**
 * 模块化开发的四步骤
 * 1. 创建模块 config.js
 * 2. 导出模块  -> 
 * 3. 加载模块
 * 4. 使用模块
 */

/**
 * 导出模块: 
 * 1. 封装什么 `内容  `
 * 2. 需要传什么`参数`  // req,res  如果需要参数 --> 函数
 * 3. 需要加载`其他模块?`
 */

 var fs = require('fs');
 var  path = require('path')
 var URL  = require('url');
 var  querystring = require('querystring');
 var  mime  = require('mime');

 var  handler = require('./handler');

module.exports = function (req,res) {

  //首页
  if (req.url === '/' || req.url === '/index') {


      handler.index(res);

  }
  // 详情页 
  else if (req.url.startsWith('/detail')) {

    handler.detail(req,res);

  }
  //提交页
  else if (req.url === '/submit') {

    handler.submit(res);
  }
  // add get 
  else if (req.url.startsWith('/add') && req.method === 'GET') {
    handler.addGet(req,res);
  }
  // add post 
  else if (req.url === '/add' && req.method === 'POST') {

    handler.addPost(req,res);
  }
  //静态资源 
  else if (req.url.startsWith('/resources')) {

     handler.resources(req,res);
  }
  //404
  else {
    res.end('404 no found page')


  }


}



//******************************************************* */

/**
 * postBody 获取新的 post 传的数据 (req,callbak)
 */
function ml_postBody(req,callback) {
  
     // post 发送的请求,文件是通过 buffer 传输的 ,监听 data end 来获取 buffer
        // 一段一段的传输的 
        //2.1 用一个数组,将来存一段一段的 buffer
        var bufferArr = [];
        //2.2 监听传输的过程
        req.on('data', function (chunk) {
  
          bufferArr.push(chunk);
        })
        //2.3 监听 end, 监听什么时候传输完成
        req.on('end', function () {
          // []  => buffer 
          var buffer = Buffer.concat(bufferArr);
  
          //2.4 buffer 转化为字符串
          var postBody = buffer.toString('utf8');
          // console.log(postBody); // title=123&url=123&text=123
  
          //2.5 转化为对象
          postBody = querystring.parse(postBody);
          console.log(postBody); //{ title: '123', url: '123', text: '123' }
          
          callback(postBody);
        })
  }
  
  /**
   * 写入数据
   */
  function ml_writeData(list,callback) {
    
    fs.writeFile(path.join(__dirname, './data/data.json'), JSON.stringify(list), function (err) {
      if (err) {
        throw err
      }
  
      callback();
    })
  }
  
  
  /**
   * 读取数据 
   *  回调函数  
   */
  function ml_readData(callback) {
  
    fs.readFile(path.join(__dirname, './data/data.json'), 'utf8', function (err, data) {
      if (err && err.code != 'ENOENT') {
        throw err
      }
      
      callback(data);
    })
  
  }
  
  /**
   * 渲染方法 ( 1-路径, 2-res )
   */
  function ml_render(filename, res) {
  
    //1. 读取文件
    fs.readFile(filename, function (err, data) {
  
      if (err) {
        throw err
      }
      //2. 结束响应并响应结果
      res.end(data)
    })
  }

  