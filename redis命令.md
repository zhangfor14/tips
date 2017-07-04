


/**
 * 1.下载
 */
https://github.com/MSOpenTech/redis/tags

/**
 * 2.安装服务
 */
进入文件夹
redis-server --service-install redis.windows-service.conf --loglevel verbose

/**
 * 3.常用的redis服务命令。
 */

卸载服务：redis-server --service-uninstall

开启服务：redis-server --service-start

停止服务：redis-server --service-stop


/**
 * 4.php使用
 */

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
echo "Connection to server sucessfully";
//设置 redis 字符串数据
$redis->set("tutorial-name", "Redis tutorial");
// 获取存储的数据并输出
echo "Stored string in redis:: " . $redis->get("tutorial-name");