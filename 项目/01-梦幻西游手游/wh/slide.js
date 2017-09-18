/**
 * Created by pc on 2017/9/6.
 */
$(function () {
   var spans = $('.sli1 span');
    for(var i = 0 ; i < spans.length; i++) {
        // $(spans[i]).css("backgroundImage", "images/4f9.jpg");
        spans[i].style.backgroundImage="images/4f9.jpg"
        spans[i].style.left = 106 * i + "px";
        if(i >= 5) {
              spans[i].style.left =(i - 5)* 106 +"px";
              spans[i].style.top = +"px";
        }
        if(i >= 10) {
            spans[i].style.left =(i - 10)* 106 +"px";
            spans[i].style.top = 107*2+"px";
        }
    }


      var timer = 0;
      timer = setInterval(function () {
         var pos = Math.random()*15;
          console.log(1);
          for(var i = 0;i < spans.length; i ++) {
              // $(spans[i]).css("transform", "translateX100px");
              // spans[i].style.transform = "translateX(100px)";
               spans[i].style.transformStyle = "flat";
          }


    },2000)


})
