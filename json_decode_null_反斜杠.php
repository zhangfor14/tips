<?php


/**
 * [$str 解决json_decode 返回null]
 * @var [type]
 */



$str = stripslashes(html_entity_decode($str)); //$str是传递过来的json字符串

html_entity_decode(); //函数的作用是把 HTML 实体转换为字符。 htmlentities()的反函数
stripslashes(); //函数的作用是删除反斜杠。  addslashes()的反函数


//正则替换斜杠
$str = preg_replace("/([\x{4e00}-\x{9fa5}])\\\\([\x{4e00}-\x{9fa5}])/iu","$1/$2",$str);
//使用反斜线, 必须使用4个("\\\\", 译注: 因为这首先是php的字符串, 经过转义后, 是两个, 再经过 正则表达式引擎后才被认为是一个原文反斜线)