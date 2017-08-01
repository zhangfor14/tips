<?php

/**
 * 目标
 */
有高并发、高负载、高可用，分布式、集群系统开发经验者优先。
MySQL索引优化、查询优化和存储优化经验、PHP缓存技术、静态化设计方面的经验

/**
 * 有高并发、高负载、高可用
 */
1.HTML静态化
2.图片服务器分离
3.数据库集群,主从,读写分离
4.缓存,分布式缓存服务器
5.镜像网站
6.负载均衡:有apache实现负载均衡和高并发，有memcache实现负载均衡和高并发
7.禁止外部的盗链 

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
//sql
1.当只要一行数据时使用 LIMIT 1
2.SELECT *
3.使用 ENUM 而不是 VARCHAR
4.尽可能的使用 NOT NULL
5.拆分大的 DELETE 或 INSERT 语句
6.当不需要数据时 可以使用select 1 好于Select count(id) 
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