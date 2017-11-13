
//功能1：jd_checkbox的功能
;(function () {

  //1. 按钮能够点击，点击能够切换。
  var all = document.querySelectorAll(".jd_checkbox");
  //2. 注册点击事件
  all.forEach(function (e, i) {

    e.addEventListener("click", function () {
      //原生js的classList：add remove toggle contains
      //jquery:addClass removeClass toggleClass hasClass
      this.classList.toggle("checked");
    });

    all[i].addEventListener("selectstart" ,function (e) {
      e.preventDefault();//阻止浏览器的默认行为
    });

  });


  var title = document.querySelector(".goods_title .jd_checkbox");
  var others = document.querySelectorAll(".goods_content .jd_checkbox");
  title.addEventListener("click", function () {

    //判断title是否有checked类，如果有，让others中所有的都有这个类，否则，都没有
    if (title.classList.contains("checked")) {

      for (var i = 0; i < others.length; i++) {
        others[i].classList.add("checked");
      }

    } else {
      for (var i = 0; i < others.length; i++) {
        others[i].classList.remove("checked");
      }
    }

  });

})();



//功能2：删除功能
;(function () {

  var rubbishes = document.querySelectorAll(".rubbish");
  var mask = document.querySelector(".jd_mask");
  var cancel = mask.querySelector(".cancel");
  var confirm = mask.querySelector(".confirm");

  var title = null;//记录了每次点击的那个盖子。
  var id = "";

  //点击垃圾桶翻盖
  for(var i = 0; i < rubbishes.length; i++) {
    rubbishes[i].addEventListener("click", function () {
      //让遮罩层显示出来
      mask.style.display = "block";
      //让垃圾桶的盖子翻起来
      title =  this.children[0];
      id = this.dataset.id;
      title.style.transition = "all .5s";
      title.style.transform = "rotate(20deg)";
      title.style.transformOrigin = "right bottom";

    });
  }

  //点击取消功能
  cancel.addEventListener("click", function () {
    mask.style.display = "none";
    title.style.transform = "rotate(0deg)";
  });

  //点击确定按钮，删除垃圾桶所在的那个goods_content
  confirm.addEventListener("click", function () {

    mask.style.display = "none";

    //删除掉这件商品
    var goods = document.querySelector(".jd_goods");
    var item = document.getElementById(id);
    goods.removeChild(item);

  });

})();
