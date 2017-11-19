//1 加载 express
var express = require('express');
var hanlder = require('./handler');

//2. 获取 router
var router = express.Router();

//3. 配置路由
//3. 注册路由
router.get('/', hanlder.index);
router.get('/index', hanlder.index);

router.get('/students', hanlder.students);

router.get('/info', hanlder.info);

// add 页面
router.get('/add', hanlder.showAdd);

router.post('/add', hanlder.submitAdd);

//edit
router.get('/edit',hanlder.showEdit);

router.post('/edit', hanlder.submitEdit);

// 删除
router.get('/delete', hanlder.delete);


// 错误
//  cannot GET
router.use('/',function (req,res,next) {

    // res.send('你找不到了吧,吼吼')

  console.log('你找不到了吧')

  next();
})



//4.
module.exports = router;