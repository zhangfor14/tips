<?php
/**
 * [thinkphp中memcache用法一]
 * @var [type]
 */
$memcache=\Think\Cache::getInstance();
$memcache->set('dy1','php381');
$memcache->set('dy2','php382');
$get1=$memcache->get('dy1');
$get2=$memcache->get('dy2');
$memcache->delete('dy1');
$memcache->delete('dy2');
$memcache->clear();
/**
 * [thinkphp中memcache用法二]
 * @var [type]
 */
$memcache=new \Think\Cache\Driver\Memcache();
$memcache->set('dy1','php381');
$memcache->set('dy2','php382');
$get1=$memcache->get('dy1');
$get2=$memcache->get('dy2');
$memcache->delete('dy1');
$memcache->delete('dy2');
$memcache->clear();
/**
 * [thinkphp中memcache用法三]
 * @var [type]
 */
S('dy1','php381');
S('dy2','php382');
S('dy1');
S('dy2');
S('dy1',null);
S('dy2',null);
/**
 * [非框架中memcache用法]
 * @var [type]
 */
$memcache=new Memcache();
$host="127.0.0.1";
$port="11211";
$result=$memcache->connect($host,$port);
$memcache->set('dy1','php38',0,time()+3600*10);
$memcache->set('dy2','php38',0,time()+3600*10);
$get1=$memcache->get('dy1');
$get2=$memcache->get('dy2');
$memcache->delete('dy1');
$memcache->delete('dy2');
$memcache->flush();
