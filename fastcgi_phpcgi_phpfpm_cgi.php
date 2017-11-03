<?php

/**
 * 1.简
 */
1.cgi
一种语言无关的协议,用来沟通程序(如PHP, Python, Java)和Web服务器(Apache2, Nginx).
CGI就是规定要传哪些数据、以什么样的格式传递给后方服务器处理这个请求的协议。
url要有吧,查询字符串也得有吧,POST数据也要有,HTTP header不能少吧,好的,CGI就是规定这些
2.Fastcgi
Fastcgi是CGI的升级版,理论上任何语言编写的程序都可以通过Fastcgi来提供Web服务。
Fastcgi的特点是会在一个进程中依次完成多个请求,以达到提高效率的目的,大多数Fastcgi实现都会维护一个进程池。
相对于cgi提高性能,那么CGI程序的性能问题在哪呢？"PHP解析器会解析php.ini文件,初始化执行环境",就是这里了。
	标准的CGI对每个请求都会执行这些步骤（不闲累啊！启动进程很累的说！）,所以处理每个时间的时间会比较长。
	这明显不合理嘛！那么Fastcgi是怎么做的呢？首先,Fastcgi会先启一个master,解析配置文件,初始化执行环境,
	然后再启动多个worker。当请求过来时,master会传递给一个worker,然后立即可以接受下一个请求。
	这样就避免了重复的劳动,效率自然是高。而且当worker不够用时,master可以根据配置预先启动几个worker等着；
	当然空闲worker太多时,也会停掉一些,这样就提高了性能,也节约了资源。这就是fastcgi的对进程的管理。
3.php-fpm
而PHP-fpm就是针对于PHP的,Fastcgi的一种实现,他负责管理一个进程池,来处理来自Web服务器的请求。目前,PHP-fpm是内置于PHP的。
但是PHP-fpm仅仅是个“PHP Fastcgi 进程管理器”, 它仍会调用PHP解释器本身来处理请求,PHP解释器(在Windows下)就是php-cgi.exe.

/**
 * 2.例
 */
你(PHP)去和爱斯基摩人(web服务器,如 Apache、Nginx)谈生意

你说中文(PHP代码),他说爱斯基摩语(C代码),互相听不懂,怎么办？那就都把各自说的话转换成英语(FastCGI 协议)吧。

怎么转换呢？你就要使用一个翻译机(PHP-FPM)
(当然对方也有一个翻译机,那个是他自带的)

我们这个翻译机是最新型的,老式的那个（PHP-CGI）被淘汰了。不过它(PHP-FPM)只有年轻人（Linux系统）会用,老头子们（Windows系统）不会摆弄它,只好继续用老式的那个。