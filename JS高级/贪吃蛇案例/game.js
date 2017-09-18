(function (window) {
    function Game(map) {
        this.map = map;
        this.food = new Food({
            map : this.map
        });
        this.snake = new Snake({
            map : this.map
        });

        this.bindKeyEvent();

    }


    Game.prototype = {
        startGame : function () {
            var that = this;
            var timer = setInterval(function () {
                that.snake.move(that.food);
                if(that.snake.body[0].x < 0 || that.snake.body[0].x >= map1.offsetWidth / that.snake.width || that.snake.body[0].y < 0 || that.snake.body[0].y >= map1.offsetHeight / that.snake.height){
                    clearInterval(timer);
                    alert("Game Over");
                }

                for(var i = 3;i < that.snake.body.length;i++){
                    if(that.snake.body[0].x == that.snake.body[i].x && that.snake.body[0].y == that.snake.body[i].y){
                        clearInterval(timer);
                        alert("Game Over");
                    }
                }

            },200)
        },

        bindKeyEvent :function () {
            var that = this;
            document.onkeyup = function (e) {
                switch (e.keyCode){
                    case 37 :
                        if(that.snake.direction != "right"){
                            that.snake.direction = "left";
                        }
                        break;
                    case 38 :
                        if(that.snake.direction != "down"){
                            that.snake.direction = "up";
                        }
                        break;
                    case 39 :
                        if(that.snake.direction != "left"){
                            that.snake.direction = "right";
                        }
                        break;
                    case 40 :
                        if(that.snake.direction != "up"){
                            that.snake.direction = "down";
                        }
                }
            }
        }
    }


    window.Game = Game;
})(window)


