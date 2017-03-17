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



//CURL函数和参数详解
curl_init()					//创建一个新的CURL资源
curl_setopt()				//设置CURL相应的选项
curl_close()				//关闭curl资源,并释放系统资源
curl_exec()					//抓取url并把它传递给浏览器
curl_getinfo()				//可以使得我们获取接受页面各种信息，你能编辑这些信息通过设定选项的第二个参数，你也可以传递一个数组的形式

CURLOPT_URL					//传递一个URL给CURL
CURLOPT_HEADER 				//是否显示头信息
CURLOPT_FOLLOWLOCATION		//当你把这个参数设置为true时，curl会根据任何重定向命令更深层次的获取转向路径
CURLOPT_MAXREDIRS			//允许你定义跳转请求的最大次数
CURLOPT_AUTOREFERER 		//设置为true时，curl会自动添加Referer header在每一个跳转链接
CURLOPT_POST				//true,启用时会发送一个常规的POST请求
CURLOPT_POSTFIELDS			//似'para1=val1&para2=val2&...'或使用一个以字段名为键值，字段数据为值的数组
CURLOPT_CONNECTTIMEOUT 		//设置curl尝试请求链接的时间
CURLOPT_TIMEOUT 			//设置curl允许执行的时间
CURLOPT_USERAGENT			//它允许你自定义请求是的客户端名称
CURLOPT_RETURNTRANSFER		//true,如果希望获得内容但不输出
CURLOPT_FILETIME			//true,启用时会尝试修改远程文档中的信息。结果信息会通过curl_getinfo()函数的CURLINFO_FILETIME选项返回
CURLOPT_COOKIEJAR			//连接结束后保存cookie信息的文件。
CURLOPT_COOKIEFILE			//包含cookie数据的文件名，cookie文件的格式可以是Netscape格式，或者只是纯HTTP头部信息存入文件。