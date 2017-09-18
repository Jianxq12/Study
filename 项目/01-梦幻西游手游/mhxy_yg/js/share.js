/**
 * Created by Administrator on 2017/9/2 0002.
 */

$(function () {
    $(".share_button .more").mouseenter(function () {
        $(".share_more").show();
    }).mouseleave(function () {
        $(".share_more").hover(function () {
            $(".share_more").show();
        },function () {
            $(".share_more").delay(1000).hide();
        })

        $(".share_more").delay(1000).hide();


    })
})