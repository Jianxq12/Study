//1.加载 http
var http = require('http');
var fs   = require('fs');
var path = require('path');
var mime = require('mime');
var URL  = require('url');
var querystring = require('querystring');


//2. 创建服务器 开启服务器  开始监听
http.createServer(function (req, res) {


  console.log(req.url)

  //首页
  if (req.url === '/' || req.url === '/index') {


    //1. 读取文件
    fs.readFile(path.join(__dirname, './views/index.html'), function (err, data) {

      if (err) {
        throw err
      }
      //2. 结束响应并响应结果
      res.end(data)
    })
  }
  // 详情页 
  else if (req.url== '/detail') {

    //1. 读取
    fs.readFile(path.join(__dirname,'./views/detail.html'),function (err,data) {
      if (err) {
        throw err
      }
    //2. 返回
    res.end(data)
    })

  }
  //提交页
   else if (req.url === '/submit') {

    //1. 读取
    fs.readFile(path.join(__dirname,'./views/submit.html'),function (err,data) {
      
      if (err) {
        throw err
      }

      //2. 返回
      res.end(data);

    })
  }
  // add get 
  else if (req.url.startsWith('/add') && req.method === 'GET') {

    //0.从 data.json里面读取字符串数组  
    fs.readFile(path.join(__dirname,'./data/data.json'),'utf8',function (err,data) {
      
      if (err && err.code != 'ENOENT') {
        throw err
      }
      //1. 把字符串数组 --> 数组 
      var list = JSON.parse(data || '[]');

      //1. 获取对象数据
      //解析url 对象 /add?title=33&url=444&text=44
      var urlObj =  URL.parse(req.url,true);  
      // 数组 添加 新的对象
      list.push(urlObj.query);
    // add?title=33&url=444&text=44'  --> { title:333 }  -> [ {},{} ] --> 字符串
    //  取值: 字符串'[]' --> [] -- [].push(newObj)  --> [] --> 转为字符串写入本地

      //数组  --> 字符串数组 
      // 把字符串数组 写入到 data.json 
      fs.writeFile(path.join(__dirname,'./data/data.json'),JSON.stringify(list),function (err) {
        
        if (err) {
          throw err
        }
  
        console.log('写入成功')
  
          //3. 重定向
          res.statusCode = 301;
          res.statusMessage = 'Moved Permanently';
          res.setHeader('location','/');
          res.end();
  
      })
    })
    
  }
  // add post 
  else if (req.url === '/add' && req.method === 'POST') {

    //1. 从 data.json 里读取 字符串数组
    fs.readFile(path.join(__dirname,'./data/data.json'),'utf8',function (err,data) {
        if (err && err.code != 'ENOENT') {
          throw err
        }

        // 字符串数组 --> 真正的数组
        var list = JSON.parse(data || '[]')

        //2. 获取新的对象 
        // post 发送的请求,文件是通过 buffer 传输的 ,监听 data end 来获取 buffer
        //2.1 用一个数组,将来存一段一段的 buffer
        var bufferArr = [];
        //2.2 监听传输的过程
        req.on('data',function (chunk) {
          
          bufferArr.push(chunk);
        })
        //2.3 监听 end, 监听什么时候传输完成
        req.on('end',function () {
          // []  => buffer 
          var buffer =  Buffer.concat(bufferArr);
          
          //2.4 buffer 转化为字符串
          var postBody = buffer.toString('utf8');
          // console.log(postBody); // title=123&url=123&text=123

          //2.5 转化为对象
          postBody = querystring.parse(postBody);
          console.log(postBody); //{ title: '123', url: '123', text: '123' }

          //3. 数组添加新的对象 
          list.push(postBody);

          //4. 把数组 转为字符串放到 data.json
          fs.writeFile(path.join(__dirname,'./data/data.json'),JSON.stringify(list),function (err) {
            if (err) {
              throw err
            }

            //5. 重定向
            res.statusCode = 301;
            res.statusMessage = 'Moved Permanently';
            res.setHeader('location','/')
            res.end();

          })

        })

    })


    
  }
  //静态资源 
  else if (req.url.startsWith('/resources')) {

    //1. 设置响应头
    res.setHeader('content-type',mime.getType(req.url));

    //2. 读取静态资源文件
    fs.readFile(path.join(__dirname,req.url),function (err,data) {

      if (err) {
        throw err
      }
      
    //3. 返回
    res.end(data)
    })
  }
  //404
   else {
    res.end('404 no found page')
  }

}).listen(8080, function () {
  console.log('开启了')
})


//1. true -> 对象  false -> 不解析还是字符串
//2. querystring.parse() --> 对象
//3. title=111&url=222&text=33  --> 查询字符串

