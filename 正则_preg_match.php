<?php

/**
 * 1.js正则语法
 */
/****match*****/
var reg=/^[A-Z]{2}\d{12}$/
var isMatch = str.match(reg);//失败返回NULL,成功返回数组
/***test******/
var reg =new RegExp("a");//最简单的正则表达式,将匹配字母a 
var reg=new RegExp("a","i");//第二个参数,g （全文查找）,i （忽略大小写） ,m （多行查找)
例如，下面的两条语句是等价的：  
var reg=new RegExp("\\w+");  
var reg=/\w+;
var isMatch = reg.test(str);//返回 Boolean，查找对应的字符串中是否存在模式。

/**
 *2.php正则语法 
 */
preg_match() 函数用于进行正则表达式匹配，成功返回 1 ，否则返回 0 。
preg_match( string pattern, string subject [, array matches ] )
pattern	正则表达式
subject	需要匹配检索的对象
matches	可选，存储匹配结果的数组， $matches[0] 将包含与整个模式匹配的文本，$matches[1] 将包含与第一个捕获的括号中的子模式所匹配的文本，以此类推

/**
 * 3.正则示例
 */
1.查找字符串中的<img src="" alt="">
preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', stripcslashes($test_str), $match);

2.手机号正则
$preg_match='/^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/';

3.数字小数点正则
$preg_match="/^[+-]?\d+(\.\d+)?$/";

4.姓名
$preg_match="/^[\x80-\xff]{6,26}$/"; //2-8个中文
$preg_match='/^[\x80-\xff]{6,26}$|^([A-Za-z]*\s?[A-Za-z]*)*$/';

5.匹配汉字
preg_match("/[\x7f-\xff]/", $title);
