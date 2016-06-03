<?php
/**
 * http://blog.csdn.net/yanhui_wei/article/details/21530811
 *
 *  cURL可以使用URL的语法模拟浏览器来传输数据，
	因为它是模拟浏览器，因此它同样支持多种协议，
	FTP, FTPS, HTTP, HTTPS, GOPHER, TELNET, DICT, FILE 以及 LDAP等协议都可以很好的支持，包括一些：
	HTTPS认证，HTTP POST方法，HTTP PUT方法，FTP上传，keyberos认证，HTTP上传，代理服务器，cookies，用户名/密码认证，
	下载文件断点续传，上传文件断点续传，http代理服务器管道，甚至它还支持IPv6，scoket5代理服务器，通过http代理服务器上传文件
	到FTP服务器等等。
 */

//初始化创建一个新crul资源
$ch = curl_init();
//设置url和相应的设置
curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//只把获取到的内容输入到文件
curl_setopt($ch , CURLOPT_URL , $url);//需要获取的URL地址，也可以在curl_init()函数中设置。
//抓取url并把它传递给浏览器
$res = curl_exec($ch);
$data=json_decode($res);
//关闭curl资源,并释放系统资源
curl_close($ch);
// echo '<pre>';
var_dump($data);