// 添加插件
$.fn.extend({
	waterfall:function(){
		// console.log('我自己写的瀑布流插件');

		// 步骤1
		/*
			为了 计算 获取一些必须知道的值
			容器的宽度 .items的 宽度
			子元素的宽度 .child().width()
			每一行放置的元素个数  计算间距
		*/
		// 定义$_变量 方便 观察
		var  $_this = this;
		// 父盒子宽度
		var totalWidth =$_this.width();

		// 子元素宽度
		var itemWidth = $_this.children('.item').width();

		// 每一行的个数 4.1  4.9
		var colNum =Math.floor(totalWidth / itemWidth);

		// 间距 (总宽度 - 个数*子元素宽度)/(个数-1)
		var margin = (totalWidth - itemWidth*colNum)/(colNum-1);

		// 步骤2
		/*	1. 准备一个 数组 数组元素的个数 跟 每一行的个数一致
				里面是默认值(比如是10 或者是margin)
			2. 循环所有 .item 子元素
				获取子元素的高度
				通过在步骤1中定义的 数组 获取 最小的值
				根据获取的 最小索引值 计算top 以及left
			3.修改步骤1中定义的 数组 对应索引的值 即可
		*/

		// 步骤2.1 准备高度数组
		// 高度数组
		var heightArr = [];

		// 循环为 高度数组 赋值 初始值
		for (var i = 0; i < colNum; i++) {
			heightArr[i] = margin;
		}


		// 步骤 2.2 循环子元素 获取数组中最小的索引
			// 修改当前循环的元素的 top 以及 left值

		// jq中 循环数组的方法
		$_this.children('.item').each(function(index, element) {
			// console.log(index+'||'+element);

			// 获取当前循环的子元素高度
			var currentHeight = $(element).height();

			// 计算 该元素放在哪个位置
			// 先假设索引为0的是最小值
			var minIndex = 0;
			var minHeight =heightArr[0];
			for (var i = 0; i < heightArr.length; i++) {
				// 和假设的最小值进行比较
				if (heightArr[i]<minHeight) {
					// 替换一下
					minHeight = heightArr[i];
					minIndex = i;
				}
			}

			// 循环完毕 最小的高度以及最小的索引值
			// 设置给当前循环的子元素
			// top 高度为计算出来的最小高度
			// left 左间距为 宽度*索引 +索引*间距
			$(element).css({
				top:minHeight,
				left:minIndex*itemWidth+minIndex*margin
			});

			// 步骤2.3 修改 步骤1中 创建的 高度数组

			// 修改 minIndex 对应的值即可
			minHeight+=currentHeight; //加上自己的高度
			minHeight+=margin;

			// 赋值给高度数组
			heightArr[minIndex]=minHeight;

		});



		//步骤3 
		/*
			修改父盒子的高度
			获取高度数组中最大的值
			修改父盒子的高度为计算出来的最大值
		*/
		var maxHeight = heightArr[0];

		for (var i = 0; i < heightArr.length; i++) {
			if(heightArr[i]>maxHeight){
				// 将更大的值保存起来
				maxHeight = heightArr[i];
			}
		}

		// 循环完毕以后 最大值就有了
		$_this.height(maxHeight);
	}
})