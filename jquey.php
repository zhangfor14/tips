<?php

/**
 * 1. 各种选择器
 */
a	基本选择器  $(#id)   $(.class)   $(tag)   $(*)  $(s1,s2,s3)
b	层次选择器
$(s1  s2)	//在s1内部获得全部的s2节点(不考虑层次)
$(s1 > s2)	//在s1内部获得子元素节点s2
$(s1 + s2)	//在s1后边获得紧紧挨着的第一个兄弟关系的s2节点
$(s1 ~ s2)	//后续全部兄弟关系节点选择器：在s1后边获得全部兄弟关系的s2节点
c	并且选择器
:first  :last
:gt(n)  :lt(n)   :eq(n)
:even 偶数 :odd 奇数

$(s1s2s3) :[并且]节点要符合s1/s2/s3全部的条件
$(s1,s2,s3):[联合]  节点符合s1、s2、s3其中一个条件即可
d	内容过滤选择器
:contains(txt)
:empty
:has(selector)
:parent
e	表单域选中选择器
：checked	//复选框、单选按钮 选中选择器
：selected	//下拉列表 选中选择器

/**
 * 2. 属性操作
 */
$().attr(name)
$().attr(name,value)
$().removeAttr(name)
$().attr(json对象);
$().attr(name,fn)
自定义属性 和 w3c规定的 都可以操作

/**
 * 3. 快捷操作
 */
a)	class属性值快捷操作
$().addClass()   //给class属性“追加”信息值
$().emoveClass() //给class属性“删除”信息值
$().toggleClass() 	//开关效果
b 标签包含内容
$().html();   		//获得节点包含的信息
$().html(信息);  	//设置节点包含的内容
$().text();			//获得节点包含的“文本字符串信息”内容
$().text(信息);		//设置节点包含的内容(有html标签就把“><”符号变为符号实体)

c value属性快捷操作
$().val() 
$().val()  -----   attr(‘value’)
$().val(内容)-----  attr(‘value’,值);
复选框、单选框、下拉列表.val([元素值，元素值，元素值])
d
复选框选中、不选中
复选框.attr(‘checked’,true/false)
复选框.attr(‘checked’)
$('#SelectAll').prop('checked')判断是否选中,值为true/false
$("input[type='checkbox']").prop('checked',true/false); 设置选中还是不选中

/**
 * 4. 加载事件
 */
$(document).ready(function(){})
$().ready(function(){});
$(function(){})

与传统加载事件不同：
① 设置个数:只能设置一个传统方式加载事件是给onload事件属性赋值，多次赋值，后者会覆盖前者

② 执行时机:只要全部内容(文字、图片、样式)在内存里边对应的DOM树结构绘制完毕就给执行，有可能对应的内容在浏览器里边还没有显示。

jquery加载事件原理：其是对DOMContentLoaded的封装。

/**
 * 5. 简单事件设置
 */
$().事件类型(function(){
	$(this).
})
$().事件类型(函数名);
$().事件类型();

事件类型：click、keyup、keydown、mouseover、mouseout、blur、focus、change、submit等等

/**
 * 6 文档操作
 */
a	节点追加

父子：
//主动
//父节点.append()后置
$('#shu').append('<li>马超</li>'); //新节点
$('#shu').append($('#wu li:eq(1)'));  //已有节点追加(物理位置移动)
//父节点.prepend()前置
$('#shu').prepend('<li>诸葛亮</li>');//新节点

//被动
//被追加节点.appendTo(父节点) 后置
$('<li>黄忠</li>').appendTo($('#shu'));//新节点
//prependTo()  前置
$('<li>魏延</li>').prependTo($('#shu'));//新节点
$('#xiang').prependTo($('#shu'));//已有节点追加(物理位置移动)

兄弟：
//兄弟节点.after()  后置
$('#yun').after('<li>黄忠</li>');//新节点
// 兄弟节点.before()  前置
$('#yun').before('<li>诸葛亮</li>');//新节点
$('#shu li:first').after($('#xiang'));//已有节点追加(物理位置移动)
//被动
// 被追加节点.insertAfter(追加节点)  后置
$('<li>马超</li>').insertAfter($('#fei'));//新节点
// insertBefore()  前置
$('<li>司马懿</li>').insertBefore($('#fei'));//新节点
$('#wu li:first').insertBefore($('#bei'));//已有节点追加(物理位置移动)

b  替换和删除

替换： replaceWith()被动   replaceAll()主动
$('<li>马超</li>').replaceAll($('#fei')); //新节点去替换(主动)
$('#bei').replaceWith($('#quan'));//(被动)已有节点去替换,物理位置移动

删除： empty()   remove()
$('#wu').empty(); //清空对应的子节点
$('#bei,#yun').remove(); //删除匹配到的节点。基本选择器的联合选择器 $(s1,s2,s3)

c 复制
被复制节点.clone(true)	//只复制节点(没有事件)
被复制节点.clone(false)	//复制“节点”和其“事件”
4. 属性选择器使用
[name]   [name=value]   
[name^=value]   [name$=value]   [name*=value]
[name!=value]
//① [name] 节点必须有"name"属性
$("[size]").css('background-color','pink');
//② [name=value] 节点必须有name属性，其值等于“value”
$("[size=30]").css('color','red');
//③ [name^=value] 节点必须有name属性，其值以“value”开始
$("[value^=to]").css('font-size','27px');
//④ [name$=value] 节点必须有name属性，其值以“value”结尾
$("[value$=63]").css('width','470px');
//⑤ [name!=value] 
// A.节点如果有name属性，则其值不等于"value"
// B.节点没有name属性
$("[class!=orange]").css('color','blue');
//⑦ [][][][]并且关系，同时满足多个条件
//我们需要的节点：有此class属性，并且属性值不等于"orange"
//$(s1s2s3s4) 获得的节点需要满足s1/s2/s3/s4等多个条件
$("[class][class!=orange]").css('background-color','lightblue');
$("[size][value^=t][name]input").css('width','500px');
//⑥ [name*=value] 节点必须有name属性，其值必须出现"value"字样
$("[class*=an]").css('color','red');
