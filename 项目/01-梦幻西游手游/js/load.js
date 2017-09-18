$(function () {
    setText();
    function setText(text) {
        var count = 0;
        var timer = setInterval(function () {
            count++;
            $(".load-txt").text(count+"%");
            if(count == 100){
                clearInterval(timer);
                location.href = "video.html";
            }
        },50)
    }
});









