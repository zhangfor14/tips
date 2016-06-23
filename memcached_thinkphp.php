thinkphp中清除所有缓存

//删除memcache数据缓存 
$memcache=\Think\Cache::getInstance();
$memcache->clear();