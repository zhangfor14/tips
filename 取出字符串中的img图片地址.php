<?php
$match=array();
$test_str='大<span style="font-weight: bold;">发发</span>大发<img src="http://xnfh.tech/Public/Uploads/Temp/2016-04-29/57232f3ba70a5.jpg" style="width: 256px;">发发<span style="color: rgb(255, 0, 0);">地方</span><span style="color: rgb(0, 0, 0); background-color: rgb(0, 0, 0);">发发</span><span style="color: rgb(0, 0, 0);">发</span>';
preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', stripcslashes($test_str), $match);