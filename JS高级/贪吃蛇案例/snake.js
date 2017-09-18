(function (window) {
    function Snake(options) {
        this.width = options.width || 20;
        this.height = options.height || 20;
        this.headColor = options.headColor || "blue";
        this.bodyColor = options.bodyColor || "skyblue";
        this.map = options.map;
        
        //body数组中存储的是每一个小节的蛇相关的信息
        this.body = [
            {x: 3, y: 1, color: this.headColor},
            {x: 2, y: 1, color: this.bodyColor},
            {x: 1, y: 1, color: this.bodyColor}
        ]
        this.elements = [];
        this.direction = "right";
        this.render();
    }

    Snake.prototype = {
        render: function () {

            //遍历存有每小节蛇的对象的数组
            //每个小节蛇 都包含 这个一小节蛇的坐标、颜色
            for (var i = 0; i < this.body.length; i++) {
                var smallSnake = this.body[i];
                
                //为每一个小节的蛇，创建一个对应的div
                this.element = document.createElement("div");
                this.element.style.width = this.width + "px";
                this.element.style.height = this.height + "px";
                this.element.style.backgroundColor = smallSnake.color;
                
                // 将当前小节蛇的元素保存到 this.elements数组中 方便以后操作
                this.elements.push(this.element);
                
                //设置位置
                this.element.style.position = "absolute";
                this.element.style.left = smallSnake.x * this.width + "px";
                this.element.style.top = smallSnake.y * this.height + "px";
                this.map.appendChild(this.element);
            }
        },

        move: function (food) {

            //蛇身体移动的代码
            for(var i = this.body.length - 1;i > 0;i--){
                this.body[i].x = this.body[i - 1].x;
                this.body[i].y = this.body[i - 1].y;
            }

            //判断蛇移动之后，是否吃到了食物
            //判断蛇头的位置和食物的位置是否重合
            if(this.body[0].x == food.x && this.body[0].y == food.y){
                this.body.push({
                    x : this.body[this.body.length - 1].x,
                    y : this.body[this.body.length - 1].y,
                    color : this.bodyColor
                })
                food.render();
            }

            //蛇头移动的代码
            switch (this.direction){
                case "right":
                    this.body[0].x++;
                    break;
                case "left":
                    this.body[0].x--;
                    break;
                case "up":
                    this.body[0].y--;
                    break;
                case "down":
                    this.body[0].y++;
            }

            //将之前显示出来的蛇删掉
            //删除map中的蛇对应的div
            for (var i = 0;i < this.elements.length;i++){
                this.map.removeChild(this.elements[i]);
            }

            //存储所有div的数组，清空
            this.elements = [];
            this.render();
        }
    }
    
    
    window.Snake = Snake;
})(window)




