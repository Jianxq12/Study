

var fs = require('fs');
var path = require('path')
var URL = require('url');
var querystring = require('querystring');
var mime  = require('mime')

// module.exports = {}
module.exports.index = function (res) {

  //1. 从 data.json 里获取数据
  fs.readFile(path.join(__dirname, './data/data.json'), 'utf8', function (err, data) {

    if (err && err.code != 'ENOENT') {
      throw err
    }

    //
    var list = JSON.parse(data || '[]');
    //2. 渲染页面
    res.ml_render(path.join(__dirname, './views/index.html'), list);

  })

}

//详情页
module.exports.detail = function (req, res) {

  //1.从 data.json 里获取字符串数组
  fs.readFile(path.join(__dirname, './data/data.json'), 'utf8', function (err, data) {

    if (err) {
      throw err
    }

    //2. 字符串数组 -> 真正的数组
    var list = JSON.parse(data || '[]');
    //3. 获取 id
    var urlObj = URL.parse(req.url, true);
    var id = urlObj.query.id;

    //4. 通过遍历 找到数组里 与 id对应的 元素对象
    for (var i = 0; i < list.length; i++) {
      var element = list[i];
      if (id == element.id) {

        //5. 拿到这个对象,然后进行模板赋值
        res.ml_render(path.join(__dirname, './views/detail.html'), element);

        break;
      }
    }
  })
}

//提交
module.exports.submit = function (res) {

  res.ml_render(path.join(__dirname, './views/submit.html'));
}

//add get
module.exports.addGet = function (req, res) {


  //0.从 data.json里面读取字符串数组  

  ml_readData(function (data) {



    //1. 把字符串数组 --> 数组 
    var list = JSON.parse(data || '[]');

    //1. 获取对象数据
    //解析url 对象 /add?title=33&url=444&text=44
    var urlObj = URL.parse(req.url, true);
    // 数组 添加 新的对象
    urlObj.query.id = list.length;
    list.push(urlObj.query);
    // add?title=33&url=444&text=44'  --> { title:333 }  -> [ {},{} ] --> 字符串
    //  取值: 字符串'[]' --> [] -- [].push(newObj)  --> [] --> 转为字符串写入本地

    //数组  --> 字符串数组 
    // 把字符串数组 写入到 data.json 
    ml_writeData(list, function () {

      //3. 重定向
      res.statusCode = 301;
      res.statusMessage = 'Moved Permanently';
      res.setHeader('location', '/');
      res.end();

    })
  })


}

// add post
module.exports.addPost = function (req, res) {

  //1. 从 data.json 里读取 字符串数组 
  ml_readData(function (data) {

    // 字符串数组 --> 真正的数组
    var list = JSON.parse(data || '[]')


    ml_postBody(req, function (postBody) {

      //3. 数组添加新的对象 
      postBody.id = list.length;
      list.push(postBody);

      //4. 把数组 转为字符串放到 data.json
      ml_writeData(list, function () {

        //5. 重定向
        res.statusCode = 301;
        res.statusMessage = 'Moved Permanently';
        res.setHeader('location', '/')
        res.end();

      })

    })

  })



}

//静态资源
module.exports.resources = function (req,res) {
  //1. 设置响应头
  res.setHeader('content-type', mime.getType(req.url));

  //2. 读取静态资源文件
  // ml_render(path.join(__dirname, req.url), res);
  res.ml_render(path.join(__dirname, req.url));

}



//******************************************************* */

/**
 * postBody 获取新的 post 传的数据 (req,callbak)
 */
function ml_postBody(req, callback) {

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
function ml_writeData(list, callback) {

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