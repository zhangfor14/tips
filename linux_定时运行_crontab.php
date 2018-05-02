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


//以下为示例
#同步时钟
*/30 * * * * ntpdate 210.72.145.44

MAILTO=""

#清理业务垃圾日志
#仅仅保留3天
0 3 * * * find /data/web/web/Application/Runtime/Logs/* -type f -mtime +3 -exec rm -rf {} \;



#stop ruthout service
#0 3 * * * /data/batstop 
#start ruthout service
#1 3 * * * /data/batstart
#backup mysql data
1 2 * * * /data/mysqlbackup.sh

#cut nginx log
0 0 * * * /bin/bash /opt/rh/cut_log.sh

#parse nginx access log
#0 1 * * * /opt/remi/php54/root/usr/bin/php /data/RuthServer/crontab/parse_www_log.php
#0 1 * * * /opt/remi/php54/root/usr/bin/php /data/RuthServer/crontab/parse_api_log.php

#statistic
0 1 * * * /opt/remi/php54/root/usr/bin/php /data/RuthServer/crontab/stats.php

#恢复php-fpm
15 1 * * * /sbin/service php-fpm restart

#清理svn 三天前备份
0 3 * * * find /data/svn_bk/* -type d -mtime +3 -exec rm -rf {} \;

#一分钟去拉取一次用户的提交信息
*/1 * * * * sleep 10 && /usr/bin/python /root/code_db/download_from_wx.py >>/root/code_db/meeting_id.log
*/1 * * * * sleep 20 && /usr/bin/python /root/code_db/download_from_wx.py >>/root/code_db/meeting_id.log
*/1 * * * * sleep 30 && /usr/bin/python /root/code_db/download_from_wx.py >>/root/code_db/meeting_id.log
*/1 * * * * sleep 40 && /usr/bin/python /root/code_db/download_from_wx.py >>/root/code_db/meeting_id.log
*/1 * * * * sleep 50 && usr/bin/python /root/code_db/download_from_wx.py >>/root/code_db/meeting_id.log

#定时执行付费问答，1提示专家24小时未回复 2提示用户专家36小时内回复了 3提示用户由于专家超36小时未回复，退款
*/1  * * * *  /usr/bin/curl "http://server.ruthout.com/?mod=qa&act=remindAsk&do=remindAskUser"
*/2  * * * *  /usr/bin/curl "http://server.ruthout.com/?mod=qa&act=remindAsk"

#对微课视频进行10%截取，用于微课分享
*/1 * * * * /usr/bin/python /root/soft/ffmpeg_process.py

#用于1分钟查询一次未解决的问题
*/2 * * * * python /root/soft/cmd_exec_worker/post_ask_reminder.py

#防止gearman/openoffice server挂掉，如果挂掉就重启
*/1 * * * * /bin/sh /root/soft/script/gearman_check.sh

#清理cached的缓存，每1个小时清洗一次
#0 */1 * * * sync;echo 3 > /proc/sys/vm/drop_caches

#文档转码,pdf和swf，每2分钟一次
*/2 * * * * python /root/soft/cmd_exec_worker/doc_2pdf_2swf_oo.py

#用户注册同步，从ruth到fmalldb
*/5 * * * * python /root/soft/cmd_exec_worker/db_sync_2fmall.py

#扫描nginx 日志，查询攻击的地址，然后nginx封闭IP一天
*/5 * * * * /bin/sh /root/soft/cmd_exec_worker/nginx_monitor/ip_blocks.sh
*/2 * * * * /bin/sh /root/soft/cmd_exec_worker/nginx_monitor/ip_blocks_server.sh
#*/5 * * * * /bin/sh /root/soft/cmd_exec_worker/nginx_monitor/ip_blocks_wap.sh

#解封被封掉的IP
0 1 * * * /bin/sh /root/soft/cmd_exec_worker/nginx_monitor/clear_ips.sh

#签到人数 0点-8点，11点-17点，每3秒增加2人
#每3秒调用一次
#* * * * * /bin/sh /usr/local/crontab/crontab_sign_data.sh
#* * * * * sleep 3;curl http://www.ruthout.com/index.php/ApiUser/addSignData
#* * * * * sleep 3; /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * *  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 3 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 6 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 9 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 12 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 15 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 18 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 21 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 24 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 27 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 30 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 33 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 36 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 39 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 42 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 45 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 48 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 51 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 54 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
*/1 * * * * sleep 57 &&  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/addSignData"
#每晚11点执行 一次清理昨天签到假数据
#00 23 * * * /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/deleSinFakeData"
#每20秒执行一下定时发帖检查，如果有定时发贴，则进行发贴
*/1 * * * * sleep 20 &&  /usr/bin/curl "http://admin.priv.ruthout.com/admin.php/Crontab/doAddCrontabCircleTopic"
*/1 * * * * sleep 40 &&  /usr/bin/curl "http://admin.priv.ruthout.com/admin.php/Crontab/doAddCrontabCircleTopic"

#每天早上7点执行一次投票数量随机加5-10次 (2017-09-22日前)
#00 07 * * * /usr/bin/curl "http://www.ruthout.com/TempVoteDraw/addRandVote"

#最赞hr活动，每一分钟执行一次给审核通过的专家发送短信通知
#*/1  * * * *  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/sendExamieHrPassMsg"

#峰会报名活动，每一分钟执行一次给审核通过的用户发送短信通知
#*/1  * * * *  /usr/bin/curl "http://www.ruthout.com/index.php/ApiCrontab/sendExamieMeetingEnroll"

#峰会报名活动，每一分钟执行一次给审核用户发微信消息通知
#*/1  * * * *  /usr/bin/curl "http://www.ruthout.com/Enrollmeeting2/pushEnrollStateWxMsg"

#峰会邀约报名，每一分钟执行一次被邀约人报名成功，更新分享表报名状态，并发给邀约者收益微信通知
#*/1  * * * *  /usr/bin/curl "http://www.ruthout.com/Enrollmeeting2/updateShreWx"

#峰会邀约报名，每一分钟执行一次峰会提现处理,发放微信现金红包
*/1  * * * *  /usr/bin/curl "http://www.ruthout.com/Wxhongbao/sendHongBao"

#sync;echo 3 > /proc/sys/vm/drop_caches

#定时执行hr_sas项目更新，如果有新版本则更新，没有则不更新
* * * * * /bin/sh /data/soft/cmd_exec_worker/svn_up_hr_sas/crontab_up.sh

#建立索引
0 2 * * * /usr/java/jdk1.7.0_65/bin/java -cp /data/ruth_rpc/search-index-1.0-jar-with-dependencies.jar com.ruthout.index.CreateQASearchIndex >>/data/ruth_rpc/index.log

#峰会每天微信对账信息
#0 2 * * * /usr/bin/python /root/code_db/WxpayAPI_php_log.py


