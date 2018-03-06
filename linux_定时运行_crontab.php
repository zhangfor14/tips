<?php


/**
 * 1.综述
 */
所有用户定义的 crontab 都被保存在/var/spool/cron 目录中

首先说说cron,它是一个linux下的定时执行工具。根用户以外的用户可以使用 crontab 工具来配置 cron 任务。
所有用户定义的 crontab 都被保存在/var/spool/cron 目录中，并使用创建它们的用户身份来执行。
要以某用户身份创建一个 crontab 项目，登录为该用户，然后键入 crontab -e 命令来编辑该用户的 crontab。
该文件使用的格式和 /etc/crontab 相同。当对 crontab 所做的改变被保存后，
该 crontab 文件就会根据该用户名被保存，并写入文件 /var/spool/cron/username 中。
cron 守护进程每分钟都检查 /etc/crontab 文件、etc/cron.d/ 目录、以及 /var/spool/cron 目录中的改变。
如果发现了改变，它们就会被载入内存。这样，当某个 crontab 文件改变后就不必重新启动守护进程了。

/**
 * 2.安装
 */
安装crontab:
yum install crontabs

/**
 * 3.常用操作
 */
/sbin/service crond status //查看crontab服务状态
/sbin/service crond start //启动服务
/sbin/service crond stop //关闭服务
/sbin/service crond restart //重启服务
/sbin/service crond reload //重新载入配置

ntsysv //查看crontab服务是否已设置为开机启动，执行命令
chkconfig –level 35 crond on //加入开机自动启动

/**
 * 4.crontab命令
 */
1)基础构造
功能说明：设置计时器。

语　　法：crontab [-u <用户名称>][配置文件] 或 crontab [-u <用户名称>][-elr]

补充说明：cron是一个常驻服务，它提供计时器的功能，
让用户在特定的时间得以执行预设的指令或程序。
只要用户会编辑计时器的配置文件，就可以使 用计时器的功能。其配置文件格式如下：

Minute Hour   Day  Month DayOFWeek Command
分钟   小时   日   月    星期      命令

*       *      *    *     *        *

第1列表示分钟1～59 每分钟用*或者 */1表示
第2列表示小时1～23（0表示0点）
第3列表示日期1～31
第4列 表示月份1～12
第5列标识号星期0～6（0表示星期天）
第6列要运行的命令

记住几个特殊符号的含义:
“*”代表取值范围内的数字,
“/”代表”每”,
“-”代表从某个数字到某个数字,
“,”分开几个离散的数字

说明：你可以用whereis php查找php执行文件位置

说明：test.php必须为可执行文件：chmod +x test.php

2).将shell加入crontab:
crontab -e
写入:* * * * * /usr/bin/php -f /root/test.php >> test.log

3).删除crontab内容里的任务
sed -i '/test2.sh/d' /var/spool/cron/root
sed -i "http://pctest.ruthout.com/index.php/Empty/test" /var/spool/cron/crontabs/root

4).查看任务
crontab -l


/**
 * 5.示例
 */
30 21 * * * /etc/init.d/nginx restart
每晚的21:30重启 nginx。

* * * * * /usr/bin/php -f /root/test.php >> test.log
每一分钟执行/root/test.php文件，将结果输出到test.log中

00 23 * * * /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/deleSinFakeData"
每晚11点执行 一次清理昨天签到假数据

*/1 * * * * sleep 3 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 6 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
......
签到人数，每3秒增加2人