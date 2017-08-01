<?php

/**
 * 零.Tips
 */
1.Laravel 5.1 中文文档:
A.http://www.golaravel.com/laravel/docs/5.1/
B.http://laravel-china.org/docs/5.1
2中国全量镜像:
A.https://pkg.phpcomposer.com/#how-to-install-composer
3.2016 版 Laravel 系列入门教程
A.http://www.golaravel.com/post/2016-ban-laravel-xi-lie-ru-men-jiao-cheng-yi/
4.环境要求:PHP 5.5.9+，MySQL 5.1+


/**
 * 一.composer安装和使用
 */
//1配置wamp开发环境,将php.exe写入环境变量
系统环境变量:C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Program Files (x86\NVIDIA Corporation\PhysX\Common;C:\Program Files\TortoiseSVN\bin;D:\phpStudy\MySQL\bin;D:\phpStudy\MySQL;D:\phpStudy\memcached;C:\Program Files (x86\Git\bin;C:\Program Files\Git\cmd;D:\phpStudy\php56n;C:\Program Files (x86\Microsoft SQL Server\100\Tools\Binn\;C:\Program Files\Microsoft SQL Server\100\Tools\Binn\;C:\Program Files\Microsoft SQL Server\100\DTS\Binn\
php -v 查看是否正确输出版本号
//2.下载composer
在任一文件夹运行一下命令
A.php -r "copy('https://getcomposer.org/installer', 'composer-setup.php';"//下载安装脚本 － composer-setup.php － 到当前目录
B.php composer-setup.php//执行安装过程
C.php -r "unlink('composer-setup.php';"//删除安装脚本
D.已下载最新版本的 composer.phar 文件到当前目录
//3.安装composer到全局
A.进入 PHP 的安装目录
B.将 composer.phar 复制到 PHP 的安装目录下面，也就是和 php.exe 在同一级目录
C.在 PHP 安装目录下新建一个 composer.bat 文件，并将下列代码保存到此文件中
@php "%~dp0composer.phar" %*
//4.检测composer是否安装成功
composer --version 看看是否正确输出版本号
//5.启用国内Packagist镜像,修改 composer 的全局配置文件
composer config -g repo.packagist composer https://packagist.phpcomposer.com
//6.保持 Composer 一直是最新版本
composer selfupdate


/**
 * 二.安装laravel,并运行
 */
1.在终端（Terminal 或 CMD）里切换到你想要放置该网站的目录('D:\WWW'下
2.composer create-project laravel/laravel learnlaravel5
3.当前目录下就会出现一个叫 learnlaravel5 的文件夹
4.运行,http://dy.com/learnlaravel5/public/


/**
 * 三.学习laravel
 */
//1.体验牛逼闪闪的 Auth 系统
A.在终端切换到laravel项目根目录
B.php artisan make:auth
C.http://fuck.io/login进入登录页面

//2.连接数据库,修改配置
A.learnlaravel5 目录下已经有了一个 .env 文件，如果没有，可以复制一份 .env.example 文件重命名成 .env，修改下面几行的值

//3.进行数据库迁移（migration）
A.在终端切换到laravel项目根目录
B.php artisan migrate