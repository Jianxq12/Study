 $(function(){

 	// 获取屏幕的高度
 	var screenHeight = $(window).height();  // clientWidth

 	// 节流阀
 	var flag1 = false;
 	var flag2 = false;
 	var flag3 = false;
 	var flag4 = false;

 	$('.next').click(function(){
 		$.fn.fullpage.moveSectionDown();
 	})

 	// 初始化fullpage
	$('#fullpage').fullpage({
		// 显示侧边导航
		navigation : true,
		// 滚动速度
		scrollingSpeed : 1000,
		/*滚动到某一屏后的回调函数，接收 anchorLink 和 index 两个参数，anchorLink 是锚链接的名称，index 是序号，从1开始计算*/
		afterLoad : function(anchorLink ,index){
			if(index == 2 && flag1 == false){
				flag1 = true;
				// 代表进入第二屏 开始执行动画
				$('.two-search-wrap').show().animate({
					marginLeft : 0
				},800,function(){
					// 动画结束之后让沙发显示
					$('.two-words').fadeIn(function(){
						// 淡入之后让$('.two-search-wrap')移动并且缩小
						// 如果用animate去缩放宽度和高度，会带来缩放不统一，所以我们利用一个奇淫技巧：换图片
						$('.two-search-wrap').hide();
						$('.two-search-copy').show().animate({
							bottom: 450,
							marginLeft : 200,
							width : 150
						});
						/*图片的show和隐藏如果需要动画一定要给图片加上width和height属性*/
						$('.two-sofa').show(600,function(){
							$('.cover').show();
							$('.two-only-sofa').show();
							// 让next显示
							$('.next').fadeIn();
							// $('.section').eq(index - 1).addClass('finish');
							// $.fn.fullpage.setAllowScrolling(true);
						});
					});

				})
			}
 
			if(index == 7){
				$('.seven-star').animate({
					width : 120
				},500,function(){
					$('.seven-good').fadeIn(function(){
						// 让next显示
						$('.next').fadeIn();
						// $('.section').eq(index - 1).addClass('finish');
						// $.fn.fullpage.setAllowScrolling(true);
					});
				})
			}
			if(index == 8){
				/*$('.eight-go').mouseenter(function(){
					$('.eight-go-gif').show();
				}).mouseleave(function(event) {
					$('.eight-go-gif').hide();
				});*/
 				$('.sc').hover(function(){
 					// 当hover的参数只有一个匿名函数的时候，代表进入和离开都会执行这个函数
 					$('.eight-go-gif').toggle();
 				})


 				// 让小手跟随鼠标移动
 				// 1、绑定mousemove事件
 				// 2、获取鼠标的坐标
 				$(document).mousemove(function(event){
 					var x = event.clientX;
 					// 这里有一个坑，就是小手一直跟随着鼠标导致鼠标不能触发到对应元素的点击事件
 					var y = event.clientY + 10;
 					// 极值判断
 					if(y <= screenHeight - $('.eight-hand').height()){
 						y = screenHeight - $('.eight-hand').height();
 					}

 					// 将坐标复制给这个小手的top和left
 					$('.eight-hand').css({
 						top : y,
 						left : x
 					})
 				})

 				// 点击再来一次
 				// （1）回到第一屏
 				// （2）让所有的动画回到初始位置
 				$('.eight-again').click(function(){
 					// （1）回到第一屏
 					$.fn.fullpage.moveTo(1);
 					// （2）让所有的动画回到初始位置 
 					// JQ的动画本质上就是操作属性（行内属性）
 					// 只需要将做了动画的元素的行内样式全部清除掉，那么所有的动画的位置都没有了
 					$('img,.move').attr('style','');
 					// 复原所有flag
 					flag1 = false;
 					flag2 = false;
 					flag3 = false;
 					flag4 = false;
 				})
			}
		},
		/*滚动前的回调函数，接收 index、nextIndex 和 direction 3个参数：index 是离开的“页面”的序号，从1开始计算；nextIndex 是滚动到的“页面”的序号，从1开始计算；direction 判断往上滚动还是往下滚动，值是 up 或 down。*/
		onLeave : function(index,nextIndex,direction){

			// 让next隐藏掉
			$('.next').fadeOut();
			// 停止滚动
			/*$.fn.fullpage.setAllowScrolling(false);
			if(direction == 'up' || $('.section').eq(index - 1).hasClass('finish') || index == 1 || index == 8){
				$.fn.fullpage.setAllowScrolling(true);
			}*/

			

			// alert('我现在在' + index + '屏，我即将去往' + nextIndex + '屏');
			if(index == 2 && nextIndex == 3 && flag2 == false){
				flag2 = true;
				// 当从第二屏滑动到第三屏的时候触发
				// 让第二屏的沙发显示，白底显示
				$('.two-only-sofa').show().animate({
					bottom : -(screenHeight - 250),
					width : 207,
					marginLeft : -125
				},800,function(){
					// 让main-size-white和main-btn-white淡入
					$('.main-size-white,main-btn-white').fadeIn(function(){
						// 让next显示
						$('.next').fadeIn();
						// $('.section').eq(index - 1).addClass('finish');
						// $.fn.fullpage.setAllowScrolling(true);
					});
				});
			}

			if(index == 3 && nextIndex == 4 && flag3 == false){

				flag3 = true;

				// 当从第三屏滑动到第四屏的时候触发
				// 让第三屏的横沙发隐藏 斜沙发显示
				$('.two-only-sofa').hide();
				$('.three-rotate-sofa').show().animate({
					bottom : -(screenHeight - 240),
					marginLeft : -145
				},1000,'easeOutBounce',function(){
					// 隐藏第三屏的斜沙发 显示第四屏的斜沙发
					$(this).hide();
					$('.four-rotate-sofa').show();
					$('.four-car-wrap').animate({
						left : '100%'
					},1500,'easeInElastic',function(){
						$(this).hide();
						$('.four-add,.four-txt,.four-words-color').fadeIn(800,function(){
							// 让next显示
							$('.next').fadeIn();
							// $('.section').eq(index - 1).addClass('finish');
							// $.fn.fullpage.setAllowScrolling(true);
						});
					})
				})
			}

			if(index == 4 && nextIndex == 5 && flag4 == false){
				flag4 = true;
				// 从第四屏到第五屏
				// 让小手滑动上来
				$('.five-hand').animate({
					bottom : 0
				},500,function(){
					// 让深色的鼠标淡入进来
					$('.five-mouse-active').fadeIn(function(){
						$('.five-order').animate({
							bottom : 365
						},500)
						$('.five-sofa').animate({
							bottom : 90
						},500,function(){
							$('.five-words ').fadeIn(function(){
								// 让next显示
								$('.next').fadeIn();
								// $('.section').eq(index - 1).addClass('finish');
								// $.fn.fullpage.setAllowScrolling(true);
							});
						})
					})
				})
			}


			// 第六屏的过程
			// 1、让第五屏的沙发掉下来（注意层级）
			// 2、让盒子移动过去接住沙发（注意动画不同步，还要注意先掉到第六屏返回第五屏的情况）
			// 3、让沙发隐藏，盒子直接掉入小车
			// 4、让背景移动到100% （backgroundPositionX）
			// 5、让man出现 （注意：定位有初始的中间为基准点变到right为基准点）
			// 6、woman、门、请收货、都应该以right为基准值去定位（为了防止缩小之后woman、门、请收货、和背景图片的位置跑偏）
			// 7、剩余动画


			if(index == 5 && nextIndex == 6){
				// 即将进入到第六屏
				// 让第五屏的沙发掉下来 （小细节：这里需要添加一个stop(true)清掉动画队列，因为如果不清除，沙发掉下来和盒子的移动不同步）
				$('.five-sofa').stop(true).animate({
					bottom : -(screenHeight - 460),
					width : 40
				},500,function(){
					// 一旦掉下来就立马隐藏掉
					$(this).hide();
				})
				// 让盒子接住沙发
				$('.six-box').animate({
					marginLeft : -210
				},500,function(){
					// 让盒子移动到车里面去
					$(this).animate({
						bottom : 5
					},500,function(){
						// 让地址显示出来
						$('.six-add').fadeIn();
						// 让背景图片往左走
						// backgroundPosition的移动JQ默认只能是单个方向
						$('.section6').animate({
							backgroundPositionX: '100%'
						},2000,function(){
							// 让快递员出现
							$('.six-man').show().animate({
								bottom : 117,
								width : 252
							},500,function(){
								// 让快递员往前走一小步
								// 并且将之前以中间为基准点改为以right为基准点
								$('.six-man').animate({
									transform : 'none',
									right : 568,
									marginRight : 0
								},400,function(){
									// 门显示出来
									$('.six-door').fadeIn(function(){
										// 小姑娘出来
										$('.six-woman').fadeIn(function(){
											// 小姑娘往前移动一下
											$(this).animate({
												right : 330
											},function(){
												// 请收货出现
												$('.six-get').fadeIn();
												// 文字出现
												$('.six-words').show().animate({
													marginLeft : -100
												},500,'easeOutBounce',function(){
													// 让next显示
													$('.next').fadeIn();
													// $('.section').eq(index - 1).addClass('finish');
													// $.fn.fullpage.setAllowScrolling(true);
												})
											})
										})
									})
								})
							})
						})
					})
				})
			}

		}

	});

 	// 解绑掉点击事件
 	$(document).off('click','#fp-nav a');

});