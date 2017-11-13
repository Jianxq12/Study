//功能1：头部的透明度随着滚动的距离增加而增加
//  如果滚动距离超过了600的话，固定0.9  如果没超过600，按照比例计算。

//1. 给window注册onscroll事件
//2. 滚动时，获取到scrollTop值 判断scrollTop与600的关系
//sandbox:沙箱
;(function () {
  var header = document.querySelector(".jd_header");
  window.onscroll = function () {
    //在现代浏览器，获取scrollTop window.pageYOffset
    // ie678获取  通过获取html的scrollTop
    //var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    var scrollTop = window.pageYOffset;
    var opacity = 0;
    if (scrollTop < 600) {
      opacity = scrollTop / 600 * 0.9;
    } else {
      opacity = 0.9;
    }
    //给jd_header设置背景颜色
    header.style.backgroundColor = "rgba(222, 24, 27, " + opacity + ")";
  }
})();

//功能2：
// 动态的设置ul的宽度
;(function () {

  var ul = document.querySelector(".seckill_c ul");
  var lis = ul.querySelectorAll("li");
  //设置ul的宽度
  ul.style.width = lis.length * lis[0].offsetWidth + "px";

})();


//功能3：倒计时功能
// 一个未来的时间 - 一个当前时间  =  时间差
// 把时间差转换成小时，  小时部分
// 把时间差转换成分钟，  分钟部分
// 把时间差转换成秒钟，  秒钟部分
;(function () {
  var spans = document.querySelectorAll(".seckill_time>span:nth-child(odd)");
  var seckillTime = new Date(2017, 9, 19, 17, 12, 0);
  setTime();
  var timer = setInterval(setTime, 1000);

  function setTime() {
    //当前时间
    var nowTime = new Date();

    //把时间差转换成秒数
    var time = parseInt((seckillTime - nowTime) / 1000);

    if (time <= 0) {
      time = 0;
      clearInterval(timer);
    }

    //一个小时 = 3600
    //设置小时部分
    var hour = parseInt(time / 3600);
    spans[0].innerHTML = addZero(hour);

    //设置分钟部分  只关注不满60的那部分
    var minute = parseInt(time / 60) % 60;
    spans[1].innerHTML = addZero(minute);


    //设置秒钟  只关注不满60的那部分
    var second = time % 60;
    spans[2].innerHTML = addZero(second);
  }


  function addZero(n) {
    return n < 10 ? "0" + n : n;
  }

})();


//功能4：京东快报
//思路：
//1. 获取元素， 运动的ul， 获取li的个数， 获取li的高度
//2. 使用过渡进行动画， 开启一个定时器，每2s秒钟设置一下translateY 负值
//3. 当跑到最后一个li的时候，需要瞬间回到第一个li的位置。
;(function () {

  //1. 获取元素
  var ul = document.querySelector(".jd_news>.info>ul");
  var lis = ul.children;
  var liHeight = lis[0].offsetHeight;

  var index = 0;//计数器

  //2. 开启定时器，2秒钟执行一次
  setInterval(function () {

    if (index >= lis.length - 1) {
      //瞬间变回第一个
      index = 0;
      //清除过渡
      ul.style.transition = "none";
      ul.style.webkitTransition = "none";//浏览器兼容

      ul.style.transform = "translateY(-" + index * liHeight + "px)";
      ul.style.webKitTransform = "translateY(-" + index * liHeight + "px)";
    }

// 重绘与回流！！！
    ul.offsetWidth;


    //1. 计数器加1
    index++;
    //2. 给ul添加过渡
    ul.style.transition = "all .2s";
    ul.style.webkitTransition = "all .2s";//浏览器兼容
    //3.设置transform
    ul.style.transform = "translateY(-" + index * liHeight + "px)";
    ul.style.webKitTransform = "translateY(-" + index * liHeight + "px)";

  }, 2000);

  //3. 给ul注册过渡结束事件
  ul.addEventListener("transitionend", function () {
// 过渡结束事件的判断变换可单独写入此处
  });

})();


//功能5：轮播图功能
//思路：
//1. 获取元素  运动的ul， 获取li的个数， 获取li的宽度
//2. 使用过渡进行动画， 开启一个定时器， 每2s中设置一下translateX  负值
//3. 动画结束时，判断是否是最后一张图片，如果是，瞬间变成第二张
;(function () {
  var ul = document.querySelector(".jd_banner>ul");
  var lis = ul.children;
  var width = lis[0].offsetWidth;
  var ol = document.querySelector(".jd_banner>ol");
  var points = ol.children;

  //计数器
  var index = 1;
  var timer = setInterval(function () {

    //1.1 计数器+1
    index++;
    //1.2 添加过渡
    addTransition();
    //1.3 设置translateX
    setTranslate(-index * width);
  }, 1000);
  ul.addEventListener("transitionend", function () {
    if (index >= lis.length - 1) {
      //1. 计时器 = 1
      index = 1;
    }
    //如果往左跑时，
    if (index <= 0) {
      index = lis.length - 2;
    }

    removeTransition();
    setTranslate(-index * width);

    //同步小圆点：让index-1对应的小圆点亮起来
    for (var i = 0; i < points.length; i++) {
      points[i].classList.remove("now");
    }
    points[index - 1].classList.add("now");

  });
  //给ul注册touch相关的事件
  var startX = 0;
  var startTime = 0;//开始时间
  ul.addEventListener("touchstart", function (e) {
    //1 记录手指开始滑动时的位置
    //2 清除定时器
    startX = e.changedTouches[0].clientX;
    startTime = new Date();
    clearInterval(timer);
  });
  ul.addEventListener("touchmove", function (e) {

    //1. 计算滑动的距离
    //2. 让ul跟着跑，
    //3. 移除过渡
    var distance = e.changedTouches[0].clientX - startX;
    removeTransition();
    setTranslate(-index * width + distance);

  });
  ul.addEventListener("touchend", function (e) {

    //1. 计算结束时的距离

    //如果滑动时间<300ms 要求滑动距离只要过了30px就行。
    //2. 判断距离是否超过屏幕的1/3，说明滑动是成功，如果是正值，去上一张，否则下一张。
    //3. 如果不超过1/3， 吸附回来。
    //4. 添加过渡
    //5. 开启定时器
    var distance = e.changedTouches[0].clientX - startX;
    var moveTime = new Date() - startTime;
    console.log(moveTime);
    if (Math.abs(distance) >= width / 3 || (moveTime <= 300 && Math.abs(distance) >= 30) ) {
      //说明滑动成功了
      if (distance > 0) {
        index--;
      }
      if (distance < 0) {
        index++;
      }
    }
    addTransition();
    setTranslate(-index * width);

    timer = setInterval(function () {
      //1.1 计数器+1
      index++;
      //1.2 添加过渡
      addTransition();
      //1.3 设置translateX
      setTranslate(-index * width);
    }, 1000);


  });

  //给window添加onresize事件，修改width的值
  window.addEventListener("resize", function () {
    clearInterval(timer);

    width = lis[0].offsetWidth;
    removeTransition();
    setTranslate(-index * width);

    timer = setInterval(function () {

      //1.1 计数器+1
      index++;
      //1.2 添加过渡
      addTransition();
      //1.3 设置translateX
      setTranslate(-index * width);
    }, 1000);
  });

  function addTransition() {
    ul.style.transition = "all .2s";
    ul.style.webKitTransition = "all .2s";
  }
  function removeTransition() {
    ul.style.transition = "none";
    ul.style.webKitTransition = "none";
  }
  function setTranslate(value) {
    ul.style.transform = "translateX(" + value + "px)";
    ul.style.webkitTransform = "translateX(" + value + "px)";
  }

}());