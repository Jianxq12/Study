
//1. 加载 express
var express = require('express');
var handler = require('./handler')
var  path = require('path');

//2. 生成 router
var router = express.Router();

 //3. 注册路由
router.get('/',handler.index)
router.get('/index',handler.index);

router.get('/detail',handler.detail);

router.get('/submit',handler.submit)

router.get('/add',handler.addGet);

router.post('/add',handler.addPost)

router.use('/resources',express.static(path.join(__dirname,'./resources')));


//4. 导出 router
module.exports = router;
