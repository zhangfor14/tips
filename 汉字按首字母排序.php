<?php
汉字按首字母排序（javascript，php，mysql实现）
/**
 * 1.javascript实现
 */

1    var a = ["啊","得啊_123","得啊_0124","波啊","婆"];
2    a.sort();                                              //原始数据排序      
3    a.sort(function(a,b){return a.localeCompare(b)});      //指定排序函数
   指定排序函数时，和当前系统的区域设置有关系，如果是按照别的区域设置排序，可改。firefox下通过，360不支持。

 

/**
 * 2. php实现
 */

  1> 网络上很多php的工具类可以将汉字转为拼音；

  2> 将拼音进行排序即可

  另一种则是类似mysql转码方式：

function utf8_array_asort($array) {
	if(!isset($array) || !is_array($array)) {
		return false;
	}
	foreach($array as $k=>$v) {
		$array[$k] = iconv('UTF-8', 'GBK//IGNORE',$v);
	}
	asort($array);
	foreach($array as $k=>$v) {
		$array[$k] = iconv('GBK', 'UTF-8//IGNORE', $v);
	}
	return $array;
}
 

/**
 * 3.mysql实现
 */

 如果当前数据库编码是utf-8，则进行转码，转为gbk，gbk默认汉字按照拼音排序存放：

1 SELECT * FROM　USER　ORDER BY convert(uname using gbk) ASC
如果当前编码为gbk则：

1 SELECT ＊ FROM USER ORDER BY uname ASC