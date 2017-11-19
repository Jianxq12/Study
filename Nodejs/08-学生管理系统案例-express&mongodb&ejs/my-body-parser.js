// post -> buffer -> 查询string + querystring -> {}

var querystring = require('querystring');

module.exports = function (req, res,next) {

  //1. 
  var bufferArr = [];

  //2. data end
  req.on('data', function (chunk) {

    bufferArr.push(chunk);

  });

  //3. 
  req.on('end', function () {

    //bufferArr   buffer 碎片
     var buffer =  Buffer.concat(bufferArr);
     // 转化为查询字符串
     buffer = buffer.toString('utf8'); // title='hah'&url='jd.com'..
     buffer =  querystring.parse(buffer);

     req.body = buffer;

    //  next();

    res.send('ok');

  })
}