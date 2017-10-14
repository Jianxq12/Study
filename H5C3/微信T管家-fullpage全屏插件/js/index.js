/*
* @Author: Administrator
* @Date:   2016-08-18 10:48:02
* @Last Modified by:   Administrator
* @Last Modified time: 2017-10-12 17:16:45
*/

'use strict';
$(function(){

	var page = $('.section');

	/*page.eq(0).addClass('class_name');*/

    $('#feifei').fullpage({
    	/*是否显示项目导航 默认值是false*/
    	navigation : true,
    	/*滚动的速度*/
    	scrollingSpeed : 700,
    	/*定义锚链接*/
    	anchors: ['page1', 'page2', 'page3', 'page4','page5', 'page6'],
    	/* 循环滚动 无缝 */
    	continuousVertical : true,
    	/* 设置菜单导航 值对应菜单盒子的ID值*/
    	menu: '#menu',
    	/*滚动到某一屏后的回调函数，接收 anchorLink 和 index 两个参数，
    	anchorLink 是锚链接的名称，index 是序号，从1开始计算*/
    	afterLoad: function(anchorLink, index){
			/*alert('我到达了第'+index+'屏了，index是从1开始计算哟！！！')*/
			var i = index - 1;
			page.eq(i).addClass('comeout').siblings().removeClass('comeout');
		},
			// 滚动前的回调函数，接收 index、nextIndex 和 direction 3个参数：
			// index 是离开的“页面”的序号，从1开始计算；

			// nextIndex 是滚动到的“页面”的序号，从1开始计算；

			// direction 判断往上滚动还是往下滚动，值是 up 或 down。
		onLeave: function(index,nextIndex , direction){
			/*alert('我现在是在'+index+'屏，即将去往'+nextIndex+'屏，方向是'+direction+'哟！！')*/
			/*var i = nextIndex - 1;
			page.eq(i).addClass('comeIn').siblings().removeClass('comeIn');*/
		},
    });
});