(function (win, doc) {
    //      2. 创建一个 ImageView 的构造函数, 要求使用下面代码
//  var img = new ImageView();
//  img.set( 'src', '...' );
//  img.appendTo( 'dv' )
// 将图片加到页面 id 为 dv 的 元素中.

    function ImageView(option) {

        this.img = document.createElement("img");
        this.src = option.src || 'images/beauty.jpg'

    }

    ImageView.prototype = {
        set: function (key, value) {
            this.img[key] = this.src;
        },
        appendTo: function (dv) {
            // this.appendTo(dv);
            dv.appendChild(this.img);
        }
    }
    var i = new ImageView({
        src: 'images/php.jpg'
    });
    var dv = document.getElementById('dv');
    // console.log(i.img);
    i.set("src");
    i.appendTo(dv);


})(window, document)

