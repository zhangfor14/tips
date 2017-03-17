


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