function myAnimate(element,target,step){
  step = step || 40;
  if(element.timer){
    clearInterval(element.timer);
  }
  element.timer = setInterval(function () {
    var leader = element.offsetLeft;
    // alert(leader);
    if(leader > target){
      step = - Math.abs(step);
    }
    if (Math.abs(target - leader) > Math.abs(step)) {
      leader += step;
    }else{
      leader = target;
      clearInterval(element.timer);
    }
    element.style.left = leader + "px";
  }, 15);
}