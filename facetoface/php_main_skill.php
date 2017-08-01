<?php

/**
 * 目标
 */
有高并发、高负载、高可用，分布式、集群系统开发经验者优先。
MySQL索引优化、查询优化和存储优化经验、PHP缓存技术、静态化设计方面的经验

/**
 * 常用工具
 */
环境:				phpstudy2016/php5.6/apache2.4/mysql5.6
框架:				ThinkPHP3.2.3/ThinkPHP5.05
缓存:				Memcache/Redis3.2.1
版本控制器:			TortoiseGit/TortoiseSVN
php编辑器:			Sublime Text3/PhpStrom/EditPlus
mysql工具:			SQLyog/Navicat for Mysql
GIS工具:		    	ArcGis10.2
原型工具:	    	Axure Rp8
远程连接工具:			TeamViewer 11
数据库同步工具:		SyncNavigator
ftp工具:				FlashFXP
网页链接监听:			Fiddler
linux远程管理:		putty1.0
虚拟机:        VMWare
linux版本:      centerOS


/**
 * 常用工具
 */
日期插件: 			bootstrap_datetimepicker
下拉框插件:			chosen_jquey
柱形图折线图插件:		echarts
剪切板插件:			jquery_zclip
树形图插件:			jstree
excel插件:			php_excel
压缩插件:			php_zip
富文本编辑框:			summernote/ueditor_utf8-php
二维码:				phpcode



/**
 * 接口
 */
百度地图
高德地图
百度翻译
有道翻译
天气预报
微信支付(公众号)
支付宝支付(网站)



/**
 * session cookie
 */
cookie 和session 的区别：
1、cookie数据存放在客户的浏览器上，session数据放在服务器上。
2、cookie不是很安全，别人可以分析存放在本地的COOKIE并进行COOKIE欺骗
   考虑到安全应当使用session。
3、session会在一定时间内保存在服务器上。当访问增多，会比较占用你服务器的性能
   考虑到减轻服务器性能方面，应当使用COOKIE。
4、单个cookie保存的数据不能超过4K，很多浏览器都限制一个站点最多保存20个cookie。
cookie 和session 的联系：
session是通过cookie来工作的
session和cookie之间是通过$_COOKIE['PHPSESSID']来联系的，通过$_COOKIE['PHPSESSID']可以知道session的id，从而获取到其他的信息。

/**
 * Mvc是一种设计模型
 */
Mvc的核心思想:将业务逻辑和显示相分离（将程序的输入、处理和输出分离）

M：model 模型    	完成数据的业务逻辑处理
V：view	  视图		完成数据展示（呈现）给用户		模板、视图类
C：control 控制器		完成整体流程调度控制（接收和处理用户请求）用户的所有请应该都提交给控制器取得相应的数据再以相应的视图显示出来


/**
 * 面向对象
 */
是程序的一种设计方式,他利于提高程序的重用性,使程序结构更加清晰.其主要有三大特征:封装,多态,继承.
	封装: private public protected
	继承: 接口继承implement 普通继承 extends
	多态：重新定义或改变类的性质和行为。不同的上下文中，呈现不同的状态，PHP本身就是多态的，因为它是弱类型。
PHP不支持重载实现多态，但是PHP可以变向的实现多态效果。
	OOP有哪些好处？
	可重用
	可维护
	可扩展
	灵活度高


/**
 * 跳转
 */
	PHP页面跳转一、header()函数:
Header（“location：http：//bbs.fsfsfsfs.net”）;
	PHP页面跳转二、Meta标签:
< meta http-equiv="refresh" content="1;url=http://bbs.lampbrother.net">
	PHP页面跳转三、JavaScript:
		< ?php  
$url = "http://bbs.lampbrother.net";  
echo "< script language='javascript' type='text/javascript'>";  
echo "window.location.href='$url'";  
echo "< /script>";  


/**
 * SVN，Git
 */
1. Git是分布式的，SVN是集中式的，好处是跟其他同事不会有太多的冲突，自己写的代码放在自己电脑上，一段时间后再提交、合并，也可以不用联网在本地提交；
2. Git下载下来后，在本地不必联网就可以看到所有的log，很方便学习，SVN却需要联网；
3. Git鼓励分Branch，而SVN，说实话，我用Branch的次数还挺少的，SVN自带的Branch merge我还真没用过，有merge时用的是Beyond Compare工具合并后再Commit的；
4. Tortoise也有出Git版本，真是好东西；
5. SVN在Commit前，我们都建议是先Update一下
1．SVN优缺点
优点： 
1、 管理方便，逻辑明确，符合一般人思维习惯。 
2、 易于管理，集中式服务器更能保证安全性。 
3、 代码一致性非常高。 
4、 适合开发人数不多的项目开发。 
缺点： 
1、 服务器压力太大，数据库容量暴增。 
2、 如果不能连接到服务器上，基本上不可以工作，看上面第二步，如果服务器不能连接上，就不能提交，还原，对比等等。 
3、 不适合开源开发


/**
 * XSS SQL注入
 */
XSS过滤
跨站脚本攻击。它指的是恶意攻击者往Web页面里插入恶意html代码，当用户浏览该页之时，嵌入其中Web里面的html代码会被执行，从而达到恶意攻击用户的特殊目的。
htmlentities		:	转换所有的html标记
htmlspecialchars	:	只格式化& ' " < 和 > 这几个特殊符号'
sql注入
所谓SQL注入，就是通过把SQL命令插入到Web表单提交或输入域名或页面请求的查询字符串，最终达到欺骗服务器执行恶意的SQL命令。
addslashes	:	单引号（'）,双引号（"）,反斜杠（\）,NULL前添加反斜杠'


/**
 * php各版本说明
 */

//1.PHP5.2以前
autoload : 如果定义了该函数，那么当在代码中使用一个未定义的类的时候，该函数就会被调用
PDO 和 MySQLi : PHP 的新式数据库访问接口
类型约束 : 通过类型约束可以限制参数的类型
JSON 支持 : 包括 json_encode(), json_decode() 等函数
//2.PHP5.3
弃用的功能，匿名函数，新增魔术方法，命名空间，后期静态绑定，Heredoc 和 Nowdoc, const, 三元运算符简写，Phar
//3.PHP5.4
Short Open Tag, 数组简写形式，Traits, 内置 Web 服务器，细节修改
//4.PHP5.5
yield, list() 用于 foreach, 细节修改
//5.PHP5.6
常量增强(定义常量时允许使用之前定义的常量进行计算,允许常量作为函数参数默认值)，可变函数参数，命名空间支持常量和函数
//6.php7
三元运算符简化:$a = $_GET['a'] ?? 1;它相当于：$a = isset($_GET['a']) ? $_GET['a'] : 1;
函数返回值类型声明/use 可以在一句话中声明多个类或函数或 const 了/标量类型声明


/**
 * tp5 tp3.2
 */
composer API友好性

/**
 * Linux
 */
1.软件安装后使用的用户非常少(公司内部人使用ftp、root管理员使用gcc),就采取二进制码方式安装。
rpm  -ivh  软件包全名
yum  install php
2.软件安装完毕使用者非常多、非常巨大(php、apache、mysql等)，就采取源码编译方式安装。(依赖软件gcc)
./configure         //在解压软件目录内部执行
make               //编译，根据configure的配置信息生成“二进制文件”
make  install        //把生成的二进制文件复制到系统指定目录(本质与rpm安
3.常用命令
Ls查看目录;
Cd目录切换;
Pwd查看操作位置;
Su 切换用户;
Exit退回到原用户;
Whoami 查看当前用户;
Root(3,5) 图形界面与命令行切换;              php中操纵文件夹:
Mkdir [name] 创建目录;                      mkdir(pathname,777,true);
Mv [dir1 dir2] 移动目录;                    Rename(旧地址，新地址);
Cp 复制;
Rm 删除;                                    Rmdir(目标目录);
Cat [name]查看文件内容;
Touch [name] 创建文件;
Echo 追加文件;
find 查找进程
ps kill 杀死进程
ps -A | grep  进程名
service 服务名 start/stop/restart
4.svn
svn checkout svn://192.168.1.1/pro/domain
svn update -r m path
svn resolved

/**
 * php连接mysql
 */
$conn=mysqli_connect($h,$usr,$psw,$db) or die("connect failed");  
mysqli_query("set names utf8",$conn); 
$rs=mysqli_query($sql,$conn);  
foreach ($data=mysqli_fetch_assoc($rs) as $key => $value) {
    # code...
}
mysqli_close($conn);


/**
 * myisam innodb
 */
Myisam：数据操作快速的一种引擎，支持全文检索。文件保存在数据库名称为目录名的 
目录中，有3个文件，分别是表定义文件（.frm）、数据文件（.MYD）、索引文件 （.MYI），强调性能，查询效率较高，不支持事务和外键。
Innodb：功能强大的一种引擎，支持事务处理功能，不支持全文检索。文件保存在两个
地方，一个是在数据库名称为目录名的目录中存放表结构文件，它的数据是保存在一个共有的文件中的。
    MyISAM支持表锁，而InnoDB支持行锁。
行级锁，一般是指排它锁，即被锁定行不可进行修改，删除，只可以被其他会话select。行级锁之前需要先加表结构共享锁。
表级锁，一般是指表结构共享锁锁，是不可对该表执行DDL操作，但对DML操作都不限制。 
行级锁之前需要先加表结构共享锁


/**
 * mysql数据库创建
 */
DROP TABLE IF EXISTS `seed`;
CREATE TABLE `seed` (
  `seed_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '播种表自增主键',
  `field_id` int(11) DEFAULT NULL COMMENT '地块id',
  `field_type` tinyint(1) DEFAULT NULL COMMENT '地块品种类型:1为原种，2为杂交种',
  `seed_seeddate` datetime DEFAULT NULL COMMENT '原种,播种日期',
  `seed_density` varchar(20) DEFAULT NULL COMMENT '原种,要求密度',=
  `seed_field_board` text COMMENT '地头插牌,多图',
  KEY `StationID` (`StationID`),
  PRIMARY KEY (`seed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='播种表';


/**
 * mysql执行sql流程
 */
接收sql->编译sql->优化sql->计划任务->执行sql


/**
 * mysql索引优化
 */
1.防止索引失效:
Like %_左原则;字段独立出现在表达式一侧;查找范围过大;前缀索引,前缀数确定;
2.为搜索字段建索引,联合索引
3.EXPLAIN 你的 SELECT 查询

/**
 * mysql查询优化
 */
//建表
1.越小的列会越快
2.选择正确的存储引擎
3.表名前都加一个前缀
4.把IP地址存成 UNSIGNED INT
5.固定长度的表会更快
6.垂直分割
7.not NULL
8.建立索引
//sql
1.当只要一行数据时使用 LIMIT 1
2.SELECT *
3.使用 ENUM 而不是 VARCHAR
4.尽可能的使用 NOT NULL
5.拆分大的 DELETE 或 INSERT 语句
6.当不需要数据时 可以使用select 1 好于Select count(id) 
7.开启慢查询,查看慢查询日志
//查询缓存
1.show variables like 'query_cache%';set global query_cache_size=1024*1024*64;set global query_cache_type=1;
2.select sql_no_cache * from table 不使用查询缓存;reset query cache 清空查询缓存;show status like 'Qcache_%' 查看当前缓存的使用信息：
3.sql语句中不使用now(),rand()等函数

/**
 * mysql存储优化
 */
mysql自带分区:Key(id)主键进行求余分区/Hash(表达式)按照某个整型表达式的值进行分区/Range()范围型条件/List()列表型条件
人为分区:创建结构相同的N张表,自定义分区算法


/**
 * 有高并发、高负载、高可用
 */
1.HTML静态化
2.图片服务器分离,下载服务器分离
3.数据库集群,主从,读写分离
4.缓存,分布式缓存服务器
5.镜像网站
6.负载均衡:有apache实现负载均衡和高并发，有memcache实现负载均衡和高并发
7.禁止外部的盗链 

/**
 * redis memcached
 */
1、Redis和Memcache都是将数据存放在内存中，都是内存数据库。不过memcache还可用于缓存其他东西，例如图片、视频等等；
2、Redis不仅仅支持简单的k/v类型的数据，同时还提供list，set，hash等数据结构的存储；
3、虚拟内存--Redis当物理内存用完时，可以将一些很久没用到的value 交换到磁盘；
4、过期策略--memcache在set时就指定，例如set key1 0 0 8,即永不过期。Redis可以通过例如expire 设定，例如expire name 10；
5、分布式--设定memcache集群，利用magent做一主多从;redis可以做一主多从。都可以一主一从；
6、存储数据安全--memcache挂掉后，数据没了；redis可以定期保存到磁盘（持久化）；
7、灾难恢复--memcache挂掉后，数据不可恢复; redis数据丢失后可以通过aof恢复；
8、Redis支持数据的备份，即master-slave模式的数据备份；
9、应用场景不一样：Redis出来作为NoSQL数据库使用外，还能用做消息队列、数据堆栈和数据缓存等；Memcached适合于缓存SQL语句、数据集、用户临时性数据、延迟查询数据和session等。
$memcache=new Memcache();
$result=$memcache->connect('127.0.0.1','11211');
$memcache->set('dy','fadsfasd');
$get=$memcache->get('dy');

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set("tutorial-name", "Redis tutorial");
$redis->get("tutorial-name");

/**
 * redis 队列解决高并发
 */
lPush/rPush
$redis->lPush(key, value);$redis->rPush(key, value);
在名称为key的 list左边（头）/右边（尾） 添加一个值为value的 元素
lPop/rPop
$redis->lPop('key');
输出名称为key的list左(头)起/右（尾）起的第一个元素，删除该元素


/**
 * 静态化
 */
开启缓冲：ob_start();
获取缓冲内容：ob_get_contents();
清空并关闭该缓冲：ob_end_clean();

添加时生成静态页面
删除时要删除该静态页面
更新时要更新静态页面。

/**
 * 伪静态化
 */
目的：能否提高效率？不能。
SEO：搜索引擎优化。
美化URL，得到更加简洁直观的URL

PHP程序实现:Pathinfo/URL路由/web服务器实现 – 隐藏index.php(Apache重写模块)


/**
 * php代码优化
 */
1.echo比print快。

2.使用echo的多重参数代替字符串连接。

3.在执行for循环之前确定最大循环数，不要每循环一次都计算最大值，最好运用foreach代替。

4.对global变量，应该用完就unset()掉。

5.用单引号代替双引号来包含字符串，这样做会更快一些。因为PHP会在双引号包围的字符串中搜寻变量，单引号则不会。

6.函数代替正则表达式完成相同功能。

7.当执行变量$i的递增或递减时，$i++会比++$i慢一些。这种差异是PHP特有的，并不适用于其他语言，++$i更快是因为它只需要3条指令(opcodes)，$i++则需要4条指令。后置递增实际上会产生一个临时变量，这个临时变量随后被递增。而前置递增直接在原值上递增。

8.使用选择分支语句（switch case）好于使用多个if，else if语句。

9.利用var_dump进行PHP代码调试。如果你在寻找php调试技术，我必须说var_dump应该是你要找的目标，在显示php信息方面这个命令可以满足你的所有需要，而调试代码的多数情况与得到PHP中的数值有关。

10.在包含文件时使用完整路径，解析操作系统路径所需的时间会更少。

11.动辄创建全局数值是一种糟糕的做法，不过有时候实际情况的确又需要这么做。对于数据库表或数据库连接信息使用全局数值是一个不错的想法，但不要在你的PHP代码中频繁使用全局数值。另外，更好的一种做法是把你的全局变量存放在一个config.php文件中。

12.如果你想知道脚本开始执行的时刻，使用$_SERVER[‘REQUEST_TIME’]要好于time()。

13.打开apache的mod_deflate模块。

14.用@屏蔽错误消息的做法非常低效。

15.尽量采用大量的PHP内置函数。

16.递增一个未预定义的局部变量要比递增一个预定义的局部变量慢9至10倍。

17.派生类中的方法运行起来要快于在基类中定义的同样的方法。

18.仅定义一个局部变量而没在函数中调用它，同样会减慢速度（其程度相当于递增一个局部变量）

19.Apache解析一个PHP脚本的时间要比解析一个静态HTML页面慢2至10倍。尽量多用静态HTML页面，少用脚本。

20.正如之前提到的，任何php网站中最重要的部分有99%的可能是数据库。因此，你需要非常熟悉如何正确的使用sql，学会关联表和更多高级的数据库技术。

调用带有一个参数的空函数，其花费的时间相当于执行7至8次的局部变量递增操作。

21.当操作字符串并需要检验其长度是否满足某种要求时，你想当然地会使用strlen()函数。此函数执行起来相当快，因为它不做任何计算，只返回zval结构（C的内置数据结构，用于存储PHP变量）中存储的已知字符串长度。

22.并不是所有情况都必须使用面向对象开发，面向对象往往开销很大，每个方法和对象调用都会消耗很多内存。

23.除非脚本可以缓存，否则每次调用时都会重新编译一次。引入一套PHP缓存机制通常可以提升25%至100%的性能，以免除编译开销。


/**
 * 常用函数
 */
数组
count()     数组的成员数
in_array(needle, haystack)
array_map(callback, arr1)
array_replace(array, array1)
array_splice(input, offset ,(arr))   获取key从start开始的length个数组,arr将以索引数组的形势添加到input中
array_push(array, var)
array_merge(array1,array2)
array_multisort(arr2,SORT_ASC,arr2,SORT_DESC,arr3)
字符串
str_repeat(input, multiplier)  
str_replace(find,replace,string,count)
strlen(string)
explode(,str)       字符串到数组
implode(,str)       数组到字符串
substr(string,start,length)         查找字符串
trim()          去除两边空格
ucfirst(str)     第一个字母大写
ucwords(str)
strtolower(str)  转成小写
strtoupper(string)  转成大写
addslashes(str)  转意字符
htmlspecialchars()  实体转义
strtotime() 时间字符串转换成时间戳
PHP_EOL     换行符
preg_match(a,源)
preg_replace(被,替,源)
文件文件夹
getcwd()    获得当前工作文件夹
file_exists(filename);
is_dir(filename);
is_file(filename);
basename(path);
dirname(path);
sql
concat    mysql中连接字符串
truncate 清空数据库

/**
 * 文件操纵操作
 */
基本操作:
file_put_contents(filename, data);
file_get_contents(filename);
unlink(filename);
高级操作:
$handle=fopen(filename,'a');
$data=fgets($handle);
fclose($handle);


/**
 * 文件 文件夹操纵操作
 */
function del_file($dirName, $cantDeleteFileName='')
{
    $fp = opendir($dirName);
    while ($file = readdir($fp))
    {
        if($file == '.' || $file == '..')
            continue ;
        if($cantDeleteFileName && $file == $cantDeleteFileName)
            continue;
        if(is_dir($dirName. $file))
        {
            del_file($dirName. $file.'/');
            rmdir($dirName . $file);
        }
        else
            unlink($dirName. $file);
    }
    closedir($fp);
}

/**
 * php错误级别
 */
1 E_ERROR 致命的运行时错误（它会阻止脚本的执行）
2 E_WARNING 运行时警告（非致命的错误）
4 E_PARSE 解析错误 
8 E_NOTICE 注意（事情可能是或者可能不是一个问题） 
256 E_USER_ERROR 用户生成的错误消息，由trigger_error()函数生成 
512 E_USER_WARNING 用户生成的警告，由trigger_error()函数生成 
1024 E_USER_NOTICE 用户生成的注意，由trigger_error()函数生成 
2048 E_STRICT 关于兼容性和互操作性的建议 
8191 E_ALL 所有的错误、警告和建议

/**
 * CURL抓取网页内容
 */
curl是利用URL语法在命令行方式下工作的开源文件传输工具
$ch = curl_init() ;                          //初始化curl,并设置请求地址
curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE) ; //设置,数据保存到字符串中返回  
    curl_setopt($ch, CURLOPT_POST, TRUE);//post方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, "pushType=1&user_Id=$user_id");//post数据
$output = curl_exec($ch);     //运行curl,请求网页,获取返回数据
curl_close($ch);

/**
 * apache虚拟主机
 */
#dy.com
<VirtualHost *:80>
    DocumentRoot "D:\WWW"
    ServerName dy.com
    ServerAlias Dy.com
  <Directory "D:\WWW">
      Options +Indexes +FollowSymLinks +ExecCGI
      AllowOverride All
      Order allow,deny
      Allow from all
      Require all granted
  </Directory>
</VirtualHost>

/**
 * include require
 */
1.require 的使用方法如 require("MyRequireFile.php"); 。这个函数通常放在 PHP 程序的最前面，PHP 程序在执行前，就会先读入 require 所指定引入的文件，使它变成 PHP 程序网页的一部份。常用的函数，亦可以这个方法将它引入网页中。
include 使用方法如 include("MyIncludeFile.php"); 。这个函数一般是放在流程控制的处理部分中。PHP 程序网页在读到 include 的文件时，才将它读进来。这种方式，可以把程序执行时的流程简单化。
2.require一个文件存在错误的话，那么程序就会中断执行了，并显示致命错误 
include一个文件存在错误的话，那么程序不会中端，而是继续执行，并显示一个警告错误。 
3. include有返回值，而require没有。


/**
 * 递归,递推
 */
递推:小->大
递归:大->小





/**
 * php设计模式
 */
1.所谓单例模式，即在应用程序中只会有这个类的一个实例存在。
通常单例模式用在仅允许数据库访问对象的实例中，从而防止打开多个数据库连接。
一是某个类只能有一个实例；
二是它必须自行创建这个实例；
三是它必须自行向整个系统提供这个实例。
2.工厂模式:
抽象基类：类中定义抽象一些方法，用以在子类中实现
继承自抽象基类的子类：实现基类中的抽象方法
工厂类：用以实例化所有相对应的子类
3.观察者模式
观察者模式属于行为模式，是定义对象间的一种一对多的依赖关系，以便当一个对象的状态发生改变时，所有依 赖于它的对象都得到通知并自动刷新。
4.策略模式
 在此模式中，算法是从复杂类提取的，因而可以方便地替换

/**
 * 网络协议编程
 */
0.TCP/IP协议:
A.物理层->链路层(硬件)->网络层(数据包,IP)->传输层(TCP,UDP)->会话层->表示层->虚拟层(socket)->应用层(FTP,DNS,HTTP)
B.IP协议:在于把各种数据包准确无误的传递给对方，其中两个重要的条件是IP地址，和MAC地址
C.TCP协议:如果说IP协议是找到对方的详细地址。那么TCP协议就是把安全的把东西带给对方。
D.DNS：DNS(Domain names System) 和HTTP协议一样是处于应用层的服务，提供域名到IP地址之间的解析服务。
E.HTTP协议:(超文本传输协议)通过URL客户向服务器请求服务时，只需传送请求方法和路径,http请求由三部分组成，分别是：请求行、消息报头、请求正文

/**
 * socket
 */
1.Socket就是套接字。客户端与服务器之间通信用的。Socket接口是TCP/IP网络的API，Socket接口定义了许多函数或例程，程序员可以用它们来开发
TCP/IP网络上的应用程序。要学Internet上的TCP/IP网络编程，必须理解Socket接口。
2.socket通信是一种基于TCP/IP协议的通信模式,而其中的TCP协议和UDP协议是与之最关系最密切的两个。TCP/IP协议族包括运输层、网络层、链路层。TCP与UDP处于运输层,并列关系
3.Socket是应用层与TCP/IP协议族通信的中间软件抽象层，它是一组接口.运输层与应用层之间的抽象层.
4.服务器端先初始化Socket，然后与端口绑定(bind)，对端口进行监听(listen)，调用accept阻塞，等待客户端连接。在这时如果有个客户端初始化一个Socket，然后连接服务器(connect)，如果连接成功，这时客户端与服务器端的连接就建立了。客户端发送数据请求，服务器端接收请求并处理请求，然后把回应数据发送给客户端，客户端读取数据，最后关闭连接，一次交互结束
5.和普通http接口相比,socket连接成功后可以相互交换数据,http接口只能请求->响应

/**
 * webservice socket
 * 我的系统中没有使用到webservice的开发，但是我掌握webservice开发的概念和流程
 */
1.socket:是一种协议，采用tcp或udp协议通信,用于底层的数据传输2进制的数据传输,更底层;
2.webservice:采用HTTP协议通信，传输的是HTML文本,Soap作为数据格式(SOAP是一种基于HTTP的协议 常用于实现webservice数据传输)。WebService是一种跨编程语言和跨操作系统平台的远程调用技术
3.WebService流程:就是一些站点开放一些服务出来, 也可以是你自己开发的Service, 也就是一些方法, 通过URL,指定某一个方法名,发出请求,站点里的这个服务(方法),接到你的请求,根据传过来的参数,做一些处理,然后把处理后的结果以XML形式返回来给你,你的程序就解析这些XML数据,然后显示出来或做其它操作。
4.WebService实现不同语言间的调用，是依托于一个标准，webservice是需要遵守WSDL（web服务定义语言）/SOAP（简单请求协议）规范的。
WebService=WSDL+SOAP+UDDI（webservice的注册）
5.soap请求是HTTP POST的一个专用版本，遵循一种特殊的xml消息格式Content-type设置为: text/xml任何数据都可以xml化。
6.web service 相对于 http (post/get)接口:
1).接口中实现的方法和要求参数一目了然
2).不用担心大小写问题
3).不用担心中文urlencode问题
4).代码中不用多次声明认证(账号,密码)参数
5).传递参数可以为数组，对象等...
6).由于要进行xml解析，速度可能会有所降低
7).httpservice通过post和get得到你想要的东西,webservice就是使用soap协议得到你想要的东西，相比httpservice能处理些更加复杂的数据类型
8).WebService跨域跨平台,http接口不跨域

/**
 * xhtml
 */
XHTML 指可扩展超文本标签语言（EXtensible HyperText Markup Language）。
XHTML 的目标是取代 HTML。
XHTML 与 HTML 4.01 几乎是相同的。
XHTML 是更严格更纯净的 HTML 版本。
XHTML 是作为一种 XML 应用被重新定义的 HTML。
XHTML 是一个 W3C 标准。

/**
 * xml json
 */
(1).XML定义
扩展标记语言 (Extensible Markup Language, XML) ，用于标记电子文件使其具有结构性的标记语言，可以用来标记数据、定义数据类型，是一种允许用户对自己的标记语言进行定义的源语言。 XML使用DTD(document type definition)文档类型定义来组织数据;格式统一，跨平台和语言，早已成为业界公认的标准。
XML是标准通用标记语言 (SGML) 的子集，非常适合 Web 传输。XML 提供统一的方法来描述和交换独立于应用程序或供应商的结构化数据。

(2).JSON定义
JSON(JavaScript Object Notation)一种轻量级的数据交换格式，具有良好的可读和便于快速编写的特性。可在不同平台之间进行数据交换。JSON采用兼容性很高的、完全独立于语言文本格式，同时也具备类似于C语言的习惯(包括C, C++, C#, Java, JavaScript, Perl, Python等)体系的行为。这些特性使JSON成为理想的数据交换语言。
JSON基于JavaScript Programming Language , Standard ECMA-262 3rd Edition - December 1999 的一个子集。

2.XML和JSON优缺点

(1).XML的优缺点
<1>.XML的优点
　　A.格式统一，符合标准；
　　B.容易与其他系统进行远程交互，数据共享比较方便。
<2>.XML的缺点
　　A.XML文件庞大，文件格式复杂，传输占带宽；
　　B.服务器端和客户端都需要花费大量代码来解析XML，导致服务器端和客户端代码变得异常复杂且不易维护；
　　C.客户端不同浏览器之间解析XML的方式不一致，需要重复编写很多代码；
　　D.服务器端和客户端解析XML花费较多的资源和时间。

(2).JSON的优缺点
<1>.JSON的优点：
　　A.数据格式比较简单，易于读写，格式都是压缩的，占用带宽小；
　　B.易于解析，客户端JavaScript可以简单的通过eval()进行JSON数据的读取；
　　C.支持多种语言，包括ActionScript, C, C#, ColdFusion, Java, JavaScript, Perl, PHP, Python, Ruby等服务器端语言，便于服务器端的解析；
　　D.在PHP世界，已经有PHP-JSON和JSON-PHP出现了，偏于PHP序列化后的程序直接调用，PHP服务器端的对象、数组等能直接生成JSON格式，便于客户端的访问提取；
　　E.因为JSON格式能直接为服务器端代码使用，大大简化了服务器端和客户端的代码开发量，且完成任务不变，并且易于维护。
<2>.JSON的缺点
　　A.没有XML格式这么推广的深入人心和喜用广泛，没有XML那么通用性；
　　B.JSON格式目前在Web Service中推广还属于初级阶段。


/**
 * nginx apache
 */
1.nginx 相对 apache 的优点：轻量级，同样起web 服务，比apache 占用更少的内存及资源抗并发，nginx 处理请求是异步非阻塞的，而apache 则是阻塞型的，在高并发下nginx 能保持低资源低消耗高性能高度模块化的设计，编写模块相对简单社区活跃，各种高性能模块出品迅速啊
2.apache 相对nginx 的优点：rewrite ，比nginx 的rewrite 强大模块超多，基本想到的都可以找到少bug ，nginx 的bug 相对较多超稳定
3、最核心的区别在于apache是同步多进程模型，一个连接对应一个进程；nginx是异步的，多个连接（万级别）可以对应一个进程 .
4、nginx的优势是处理静态请求，cpu内存使用率低，apache适合处理动态请求，所以现在一般前端用nginx作为反向代理抗住压力，apache作为后端处理动态请求