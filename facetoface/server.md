/**
 * window
 */
1.mysql
A.安装
C:\Program Files\MySQL\MySQL Server 5.7\bin\mysqld.exe" --defaults-file="C:\ProgramData\MySQL\MySQL Server 5.7\my.ini" MySQL57
mysqld --install "MySQL Server 5.7" --defaults-file=C:\ProgramData\MySQL\MySQL Server 5.7\my.ini
B.删除
mysqld remove "MySQL Server 5.7"

2.apache
httpd -k install -n apache1 　／＊安装好了apache1的服务＊／
httpd -k install -n apache2 　／＊安装好了apache2的服务＊／
httpd -k uninstall -n apache1  ／＊删除了apache1的服务＊／
httpd -k uninstall -n apache2  ／＊删除了apache2的服务＊／

3.memcached
memcached.exe -d install 
memcached.exe -d uninstall 

4.redis
安装服务:redis-server --service-install redis.windows-service.conf --loglevel verbose
卸载服务:redis-server --service-uninstall
开启服务:redis-server --service-start
停止服务:redis-server --service-stop

5.mongodb
安装：mongod.exe --dbpath "C:\MongoDB\db" --logpath "C:\mongodb\log.txt" --install --serviceName "MongoDB"
详细:mongod.exe --bind_ip yourIPadress --logpath "G:\phpStudy\mongodb-win32-i386-2.0.3\log.txt" --logappend --dbpath "G:\phpStudy\mongodb-win32-i386-2.0.3\db" --port yourPortNumber --serviceName "MongoDB" --serviceDisplayName "MongoDB" --install

卸载：mongod.exe --remove --serviceName "MongoDB"
