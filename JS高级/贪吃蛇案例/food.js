(function (window) {
    function Food(options) {
        this.width = options.width || 20;
        this.height = options.height || 20;
        this.backgroundColor = options.backgroundColor || "yellow";
        this.x = 0;
        this.y = 0;
        this.map = options.map;
        //创建一个div，用这个div来代表食物
        this.element = document.createElement("div");
        this.init();

    }

    Food.prototype = {
        //将在对象创建完成之后要做的所有的工作，全部封装到这个函数中
        //避免将其直接放在构造函数中，导致构造函数中的代码结果过于混乱的问题
        init: function () {
            this.element.style.width = this.width + "px";
            this.element.style.height = this.height + "px";
            this.element.style.backgroundColor = this.backgroundColor;
            this.render();
        },

        render:function () {
            this.x = utils.getRandom(0,this.map.offsetWidth / this.width);
            console.log(this.element.offsetHeight);
            this.y = utils.getRandom(0,this.map.offsetHeight / this.height);
            this.element.style.position = "absolute";
            this.element.style.left = this.x*this.width + "px";
            this.element.style.top = this.y*this.height + "px";
            this.map.appendChild(this.element);
        }
    }
    
    
    window.Food = Food;
})(window)


