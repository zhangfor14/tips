<?php

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
