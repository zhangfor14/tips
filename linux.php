<?php

一.基础操作

    1. 查看目录下有什么文件/目录
        > ls            //list列出目录的文件信息
        > ls  -l        //list -list以“详细信息”查看目录文件
        > ll            //list -list以“详细信息”查看目录文件
        > ls  -a        //list  -all查看目录“全部”(包括隐藏文件)文件
        > ls  -al       //list  -all list 查看目录“全部”(包括隐藏文件)文件,以“详细信息”展示
        > ls  目录      //查看指定目录下有什么文件

    2. 进行目录切换
        > cd  dirname       //进行目录切换
        > cd  ..            //向上级目录切换
        > cd  ~    或 cd     //直接切换到当前用户对应的家目录

    3. 目录相关操作
        1) 创建目录 make directory
        > mkdir  目录名字
        > mkdir -p newdir/newdir/newdir       //递归方式创建多个连续目录

          //新的多级目录数目如果大于等于2个，就要使用-p参数
          mkdir      dir/newdir                //不用-p参数
          mkdir  -p  dir/newdir/newdir         //使用-p参数
          mkdir  -p  newdir/newdir/newdir      //使用-p参数

        2) 移动目录(文件和目录)  move
        > mv  dir1  dir2            //把dir1移动到dir2目录下
        > mv  dir1/dir2  dir3       //把dir2移动到dir3目录下
        > mv  dir1/dir2  dir3/dir4  //把dir2移动到dir4目录下
        > mv  dir1/dir2  ./         //把dir2移动到当前目录下

        3) 改名字  (文件和目录)
        > mv  dir1  newdir          //修改dir1的名字为newdir

        mv是“移动” 和 “改名字” 合并的指令
        > mv  dir1  ./newdir            //dir1移动到当前目录下 并改名字为newdir
        > mv  dir1/dir2  dir3           //dir2移动到dir3目录下， 并改名字为“原名”
        > mv  dir1/dir2  dir3/newdir    //dir2移动到dir3目录下，并改名字为“newdir”
        > mv  dir1/dir2  dir3/dir4      //dir2移动到dir4目录下， 并改名字为“原名”
        > mv  dir1/dir2  dir3/dir4/newdir   //dir2移动到dir4目录下， 并改名字为“newdir”

        4) 复制(改名字)(文件和目录) copy
        ① 文件的复制
        > cp  file1  dir/newfile2         //file1被复制一份到dir目录下，并改名字为“newfile2”
        > cp  file1  dir               //file1被复制一份到dir目录下，并改名字为“原名”
        > cp  dir1/filea  dir2/newfile  //filea被复制一份到dir2目录下，并改名字为“newfile”
        ② 目录的复制(需要设置-r[recursive递归]参数，无视目录的层次)
        > cp -r dir1   dir2             //dir1被复制到dir2目录下,并改名字为"原名"
        > cp -r  dir1/dir2  dir3/newdir  //dir2被复制到dir3目录下,并改名字为"newdir"
        > cp -r  dir1/dir2  dir3/dir4   //dir2被复制到dir4目录下,并改名字为"原名"
        > cp -r  dir1/dir2  dir3/dir4/newdir   //dir2被复制到dir4目录下,并改名字为"newdir"
        > cp -r  dir1  ../../newdir     //dir1被复制到上两级目录下,并改名字为"newdir"

        ⑤ 删除(文件和目录)remove
        > rm  文件
        > rm -r  目录           //-r[recursive递归]递归方式删除目录
        > rm -rf  文件/目录     //-r force  递归强制方式删除文件
                                force强制，不需要额外的提示
          rm  -rf  /

    4. 文件操作
        1) 查看文件内容
            cat  filename       //打印文件内容到输出终端
            more  filename      //通过敲回车方式逐行查看文件的各个行内容
                                //默认从第一行开始查看
                                //不支持回看
                                //q 退出查看

            less                //通过“上下左右”键查看文件的各个部分内容
                                //支持回看
                                //q 退出查看

            head -n filename    //查看文件的前n行内容
            tail -n filename    //查看文件的最末尾n行内容

            wc filename         //查看文件的行数

        2) 创建文件
            > touch  dir1/filename
            > touch  filename
        3) 给文件追加内容
            > echo 内容 > 文件名称      //把“内容”以[覆盖写]方式追加给“文件”
            > echo 内容 >>  文件名称    //把“内容”以[追加]形式写给“文件”
            (如果文件不存在会创建文件)

    5. 查看完整的操作位置&查看当前用户是谁
        > pwd
        > whoami

二.系统操作

    1. 用户操作
        配置文件：/etc/passwd
        1) 创建用户 user add
        ># useradd
        ># useradd  liming          //创建liming用户，同时会创建一个同名的组出来
        ># useradd  -g 组别编号  username   //把用户的组别设置好，避免创建同名的组出来
        ># useradd  -g 组编号  -u 用户编号  -d 家目录   username

        2) 修改用户 user modify
        ># usermod  -g 组编号  -u 用户编号  -d 家目录  -l 新名字  username
        (修改家目录时需要手动创建之)

        3) 删除用户 user delete
        ># userdel  username
        ># userdel -r  username    //删除用户同时删除其家目录

        4) 给用户设置密码，使其登录系统
        > passwd 用户名

    2. 组别操作
        配置文件： /etc/group
        1) 创建组 group add
        ># groupadd  music
        ># groupadd  movie
        ># groupadd  php

        2) 修改组 group modify
        ># groupmod  -g gid  -n 新名字  groupname

        3) 删除组 group delete
        ># groupdel  groupname    //组下边如果有用户存在，就禁止删除

    3. 权限设置chmod
        1).字母相对方式权限的设置
        >#chmod (ugo)(+-)(rwx) 目录 u:当前用户,g:同组用户,o:其他组用户;+-增加减少权限;r:读取权限,w:写权限,x:执行权限
        >#sudo chmod -R ugo+rwx /usr/local/http2/htdocs/ZZYPHP/ //给该目录下所有子文件目录在当前组其他组都有读写执行权限
        //数字绝对方式权限的设置,0:没有权限,1:执行,2:写,3:写执行,4:读,5:读执行,6:读写,7:读写执行
        >#chmod 753 目录      //主人7权限,同组5权限,其他组3权限

    4. 光驱挂载
        > mount   /dev/cdrom  /home/jinnan/rom      //把光驱挂载到rom目录
        > umount  /dev/cdrom                        //(硬件)卸载光驱
        > umount  /home/jinnan/rom                  //(挂载点)卸载光驱
        > eject                                     //弹出光盘

    5. 磁盘操作
        1).df：列出文件系统的整体磁盘使用量
        >df [-ahikHTm] [目录或文件名]
        选项与参数：
            -a ：列出所有的文件系统，包括系统特有的 /proc 等文件系统；
            -k ：以 KBytes 的容量显示各文件系统；
            -m ：以 MBytes 的容量显示各文件系统；
            -h ：以人们较易阅读的 GBytes, MBytes, KBytes 等格式自行显示；
            -H ：以 M=1000K 取代 M=1024K 的进位方式；
            -T ：显示文件系统类型, 连同该 partition 的 filesystem 名称 (例如 ext3) 也列出；
            -i ：不用硬盘容量，而以 inode 的数量来显示
        2).du命令也是查看使用空间的，但是与df命令不同的是Linux du命令是对文件和目录磁盘使用的空间的查看
        >du [-ahskm] 文件或目录名称
        选项与参数：
            -a ：列出所有的文件与目录容量，因为默认仅统计目录底下的文件量而已。
            -h ：以人们较易读的容量格式 (G/M) 显示；
            -s ：列出总量而已，而不列出每个各别的目录占用容量；
            -S ：不包括子目录下的总计，与 -s 有点差别。
            -k ：以 KBytes 列出容量显示；
            -m ：以 MBytes 列出容量显示；
        3).fdisk 是 Linux 的磁盘分区表操作工具。
        >fdisk [-l] 装置名称
        选项与参数：
            -l ：输出后面接的装置所有的分区内容。若仅有 fdisk -l 时， 则系统将会把整个系统内能够搜寻到的装置的分区均列出来。
        4).磁盘格式化
        >mkfs [-t 文件系统格式] 装置文件名
        选项与参数：
            -t ：可以接文件系统格式，例如 ext3, ext2, vfat 等(系统有支持才会生效)

        5).磁盘检验
            fsck（file system check）用来检查和维护不一致的文件系统。若系统掉电或磁盘发生问题，可利用fsck命令对文件系统进行检查
        >fsck [-t 文件系统] [-ACay] 装置名称
        选项与参数：
            -t : 给定档案系统的型式，若在 /etc/fstab 中已有定义或 kernel 本身已支援的则不需加上此参数
            -s : 依序一个一个地执行 fsck 的指令来检查
            -A : 对/etc/fstab 中所有列出来的 分区（partition）做检查
            -C : 显示完整的检查进度
            -d : 打印出 e2fsck 的 debug 结果
            -p : 同时有 -A 条件时，同时有多个 fsck 的检查一起执行
            -R : 同时有 -A 条件时，省略 / 不检查
            -V : 详细显示模式
            -a : 如果检查有错则自动修复
            -r : 如果检查有错则由使用者回答是否修复
            -y : 选项指定检测每个文件是自动输入yes，在不确定那些是不正常的时候，可以执行 # fsck -y 全部检查修复。
        6).磁盘挂载与卸除
        >mount [-t 文件系统] [-L Label名] [-o 额外选项] [-n]  装置文件名  挂载点

三.系统命令

    1. 用户切换
        > su -  或  su - root       //向root用户切换
        > exit          //退回到原用户

        > su 用户名     //普通用户切换

        多次使用su指令，会造成用户的“叠加”：
        (su和exit最好匹配使用)
        jinnan--->root--->jinnan--->root--->jinnan

    2. 图形界面 与 命令界面 切换
        root用户可以切换
        ># init 3
        ># init 5

    3. 查看一个指令对应的执行程序文件在哪,查看指令可设置的参数
        > which  指令    #查看指令位置
        > man 指令       #查看指令参数'

    4. 使用root用户去执行命令
        > sudo 指令
        eg.sudo passwd root

    5. 系统/服务重启

        1). 系统重启命令 & 关机命令：

        	1)、reboot  重启

        	2)、shutdown -r now 立刻重启(root用户使用)

        	3)、shutdown -r 10 过10分钟自动重启(root用户使用)

        	4)、shutdown -r 20:35 在时间为20:35时候重启(root用户使用)


        	1)、halt   立刻关机

        	2)、poweroff  立刻关机

        	3)、shutdown -h now 立刻关机(root用户使用)

        	4)、shutdown -h 10 10分钟后自动关机

        2). 启动,重启,停止服务
            ># service 服务名 start/stop/restart

        3).nginx服务器,启动,停止,重启
            0)检查nginx配置文件是否正确
            nginx -t -c /usr/nginx/conf/nginx.conf 或 /usr/nginx/sbin/nginx -t
            1)启动
            nginx -c /usr/local/nginx/conf/nginx.conf 或 usr/local/nginx/sbin/nginx -c /usr/local/nginx/conf/nginx.conf
            /usr/sbin/nginx -c /etc/nginx/nginx.conf
            2)停止
            A.查询主进程号:ps -ef | grep nginx
            B.停止主进程号:
            从容停止Nginx：kill -QUIT 主进程号
            快速停止Nginx：kill -TERM 主进程号
            强制停止Nginx：kill -9 主进程号
            3)平滑重启
            kill -HUP 住进称号或进程号文件路径 或 /usr/local/nginx/sbin/nginx -s reload
            /usr/sbin/nginx -c /etc/nginx/nginx.conf -s reload

        4).apache服务器,启动,停止,重启
            0)检查配置文件
            /usr/local/apache2/bin/apachectl configtest
            1)启动
            /usr/local/apache2/bin/apachectl start apaceh
            2)停止
            /usr/local/apache2/bin/apachectl stop
            3)重启
            /usr/local/apache2/bin/apachectl restart

        5).mysql服务器,启动,停止,重启
            1)启动
            /etc/inint.d/mysqld start
            2)停止
            /etc/inint.d/mysqld stop
            3)重启
            /etc/inint.d/mysqld restart

        6).php-fpm服务,启动,停止,重启
            1)启动
            /etc/inint.d/php-fpm start
            2)停止
            /etc/inint.d/php-fpm stop
            3)重启
            /etc/inint.d/php-fpm restart

    6. linux启动项管理
        ># ntsysv

    7. 设备管理,包括防火墙
        ># setup

    8. 查看网络信息
    	># ifconfig

    9. 查看服务是否启动
    	>#ps -A | grep 服务名(模糊查询)

    10.查看进程
        1).查看进程
        >#ps -ef | grep nginx
        2).查看端口下进程
        >#netstat -tln | grep 端口号
        >#sudo lsof -i:端口号
        >#sudo kill -9 端口号

    11. 杀死进程
    	>#ps killall  httpd  杀死全部的httpd进程

    12. 寻找进程安装目录
        >#find / -name opensslv.h

    13. 环境变量
        1). 永久添加环境变量(影响当前用户)
        #vim ~/.bashrc
        export PATH=$PATH:/usr/local/nginx/sbin/
        保存，退出，然后运行：
        #source /etc/profile
        2).永久添加环境变量(影响所有用户)
        # vim /etc/profile
        在文档最后，添加:
        export PATH=$PATH:/usr/local/nginx/sbin/
        保存，退出，然后运行：
        #source /etc/profile

        echo ${/usr/local/nginx/sbin/#/deletion_name:}

    14. host
        host文件位置：/etc/hosts
        vim /etc/hosts即可编辑

    15. 防火墙（centos7）
        启动：systemctl start firewalld
        查看状态：systemctl status firewalld
        停止： systemctl disable firewalld
        禁用： systemctl stop firewalld

        查看所有打开的端口： firewall-cmd --zone=public --list-ports
        开启端口：
        firewall-cmd --zone=public --add-port=80/tcp --permanent    （--permanent永久生效，没有此参数重启后失效）
        重新载入
        firewall-cmd --reload
        查看
        firewall-cmd --zone= public --query-port=80/tcp
        删除
        firewall-cmd --zone= public --remove-port=80/tcp --permanent
        显示状态： firewall-cmd --state

    16.IP地址
        A.查看所使用的网卡名称
        #>ifconfig -a
        #############################
        ens32:  flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
                inet 192.168.2.40  netmask 255.255.255.0  broadcast 192.168.2.255
                inet6 fe80::20c:29ff:fece:fc3c  prefixlen 64  scopeid 0x20<link>
                ether 00:0c:29:ce:fc:3c  txqueuelen 1000  (Ethernet)
                RX packets 17403  bytes 1453165 (1.3 MiB)
                RX errors 0  dropped 0  overruns 0  frame 0
                TX packets 1107  bytes 201665 (196.9 KiB)
                TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
        #############################
        当前使用网卡:ens32,ip地址为:192.168.2.40
        B.查看网卡配置
        vim /etc/sysconfig/network-scripts/ifcfg-ens32
        cd /etc/sysconfig/network-scripts
        HWADDR=00:50:56:28:22:ff
        C.修改配置(dhcp)
        HWADDR=物理网卡地址
        BOOTPROTO=dhcp改为BOOTPROTO=static
        IPADDR=192.168.2.40
        NETMASK=255.255.255.0
        NM_CONTROLLED=no
        rm -rf /etc/udev/rules.d/70-persistent-net.rules
        D.重启服务
        service network restart

三.系统查看
    # uname -a # 查看内核/操作系统/CPU信息
    # head -n 1 /etc/issue # 查看操作系统版本
    # cat /proc/cpuinfo # 查看CPU信息
    # hostname # 查看计算机名
    # lspci -tv # 列出所有PCI设备
    # lsusb -tv # 列出所有USB设备
    # lsmod # 列出加载的内核模块
    # env # 查看环境变量 资源
    # free -m # 查看内存使用量和交换区使用量
    # df -h # 查看各分区使用情况
    # du -sh # 查看指定目录的大小
    # grep MemTotal /proc/meminfo # 查看内存总量
    # grep MemFree /proc/meminfo # 查看空闲内存量
    # uptime # 查看系统运行时间、用户数、负载
    # cat /proc/loadavg # 查看系统负载 磁盘和分区
    # mount | column -t # 查看挂接的分区状态
    # fdisk -l # 查看所有分区
    # swapon -s # 查看所有交换分区
    # hdparm -i /dev/hda # 查看磁盘参数(仅适用于IDE设备)
    # dmesg | grep IDE # 查看启动时IDE设备检测状况 网络
    # ifconfig # 查看所有网络接口的属性
    # iptables -L # 查看防火墙设置
    # route -n # 查看路由表
    # netstat -lntp # 查看所有监听端口
    # netstat -antp # 查看所有已经建立的连接
    # netstat -s # 查看网络统计信息 进程
    # ps -ef # 查看所有进程
    # top # 实时显示进程状态 用户
    # w # 查看活动用户
    # id # 查看指定用户信息
    # last # 查看用户登录日志
    # cut -d: -f1 /etc/passwd # 查看系统所有用户

    # cut -d: -f1 /etc/group # 查看系统所有组
    # crontab -l # 查看当前用户的计划任务 服务
    # chkconfig –list # 列出所有系统服务
    # chkconfig –list | grep on # 列出所有启动的系统服务 程序
    # rpm -qa # 查看所有安装的软件包

四.软件安装

    0.下载到本地
        >#wget 地址

    1.rpm方式安装软件：
        >#rpm  -ivh  软件包全名          //安装软件
        >#rpm  -q   软件包名(完整)    //query查看软件是否有安装
        >#rpm  -e   软件包名 (完整)      //卸载软件
        >#rpm  -ql  软件包名 (完整)      //query all  软件安装目录
        >#rpm  -qa                      //query all  查看系统里边全部rpm方式安装的软件
        >#rpm  -qa  |  grep ftpd(部分名字)          //模糊查找指定软件ftpd是否有安装
        软件包全名 = 软件包名+软件版本+支持的系统+支持cpu型号+文件后缀

    2.yum安装
        1.列出所有可更新的软件清单命令：yum check-update
        2.更新所有软件命令：yum update
        3.仅安装指定的软件命令：yum install <package_name>
        4.仅更新指定的软件命令：yum update <package_name>
        5.列出所有可安裝的软件清单命令：yum list
        6.删除软件包命令：yum remove <package_name>
        7.查找软件包 命令：yum search <keyword>
        8.清除缓存命令:
            yum clean packages: 清除缓存目录下的软件包
            yum clean headers: 清除缓存目录下的 headers
            yum clean oldheaders: 清除缓存目录下旧的 headers
            yum clean, yum clean all (= yum clean packages; yum clean oldheaders) :清除缓存目录下的软件包及旧的headers

    3.安装ssh
        1).安装ssh
        >#yum install ssh
        2).启动ssh
        >#service sshd start
        3).登录远程服务器
        >#ssh -p 50022 my@127.0.0.1
        -p 后面是端口
        my 是服务器用户名
        127.0.0.1 是服务器 ip

    4.安装memcached
        详细文章:http://blog.sina.com.cn/s/blog_4829b9400101piil.html
        1).下载最新版memcached
        >#wget http://memcached.org/files/memcached-1.4.20.tar.gz
        2).下载libevent
        >#wget https://github.com/downloads/libevent/libevent/libevent-2.0.21-stable.tar.gz
        3).安装libevent
        >#rpm -qa|grep libevent//查看系统是否带有该安装软件，如果有执行命令:
        >#rpm -e libevent-1.4.13-4.el6.x86_64 --nodeps//（由于系统自带的版本旧，忽略依赖删除）
        >#tar zxvf libevent-2.0.21-stable.tar.gz
        >#cd libevent-2.0.21-stable
        >#./configure --prefix=/usr/local/libevent
        >#make && make install
        4).安装memcached
        >#tar zxvf memcached-1.4.2.tar.gz
        >#cd memcached-memcached-1.4.2
        >#./configure --prefix=/usr/local/memcached --with-libevent=/usr/local/libevent/
        >#make && make install
        5).启动&配置memcache
        >#/usr/local/memcached/bin/memcached -d -m 256 -u root -l 127.0.0.1 -p 11211 -c 1024 –P /tmp/memcached.pid
        >#kill `cat /tmp/memcached.pid` //停止服务
        6).将memchace添加到启动项中
        #在/etc/rc.d/rc.local中加入一行
        #/usr/local/memcached/bin/memcached -d -m 256 -u apache -l 127.0.0.1 -p 11211 -c 1024
        7).php扩展安装
        >#wget http://blog.s135.com/soft/linux/nginx_php/memcache/memcache-2.2.5.tgz  //编译安装需下载
        //安装依赖软件
        ># wget http://ftp.gnu.org/gnu/m4/m4-1.4.9.tar.gz
        ># tar -zvxf m4-1.4.9.tar.gz
        ># cd m4-1.4.9/
        ># ./configure && make && make install
        ># cd ../
        ># wget http://ftp.gnu.org/gnu/autoconf/autoconf-2.62.tar.gz
        ># tar -zvxf autoconf-2.62.tar.gz
        ># cd autoconf-2.62/
        ># ./configure && make && make install
        //使用php自带pecl安装扩展
        ># /usr/local/servers/php5/bin/pecl install memcache
        //在php.ini中添加extension=memcache.so,重启apache #/usr/local/http2/bin/apachectl restart

    5.安装svn
        编译安装:http://www.iitshare.com/linux-svn-installation-and-configuration.html
        yum安装:http://www.cnblogs.com/davidgu/archive/2013/02/01/2889457.html

        1).查看是否安装了svn工具
        命令：rpm -qa | grep subversion //如果服务器已经安装了则不需要进行安装，如果没有安装可以进行全新的安装
        2).安装svn
        >#yum -y install subversion
        3).svn命令
        //path是服务器上的目录,http://www.jb51.net/os/RedHat/2461.html
            A.将文件checkout到本地目录
            >#svn checkout path
            >#svn co                            //简写
            B.将改动的文件commit到版本库
            >#svn commit -m “LogMessage“ [-N] [--no-unlock] PATH
            //如果在提交的时候提示过期的话，是因为冲突，需要先update，修改文件，然后清除svn resolved，最后再提交commit)
            >#svn ci                            //简写
            C.更update到某个版本
            >#svn update -r m path
            >#svn up                            //简写
            >#svn update                        //如果后面没有目录，默认将当前目录以及子目录下的所有文件都更新到最新版本。
            >#svn update -r 200 test.php        //将版本库中的文件test.php还原到版本200
            >#svn update test.php               //更新，于版本库同步。
            D.解决冲突
            >#svn resolved PATH                 //移除工作副本的目录或文件的“冲突”状态
            E.查看文件或目录的状态
            >#svn status path                   //目录下的文件和子目录的状态，正常状态不显示
            >#svn status -v path                //显示文件和子目录状态
            F.修改远程url地址
            >#svn switch --relocate svn://101.201.49.72/repos/web  svn://svn.ruthout.com/repos/web
            G.查看svn信息
            >#svn info
        4).版本库维护
            1.环境
            centos5.5

            2.安装svn
            yum -y install subversion

            3.配置

            建立版本库目录
            mkdir /www/svndata

            svnserve -d -r /www/svndata

            4.建立版本库

            创建一个新的Subversion项目
            svnadmin create /www/svndata/oplinux

            配置允许用户rsync访问
            cd /www/svndata/oplinux/conf

            vi svnserve.conf
            anon-access=none
            auth-access=write
            password-db=passwd

            注：修改的文件前面不能有空格，否则启动svn server出错

            vi passwd
            [users]
            #<用户1> = <密码1>
            #<用户2> = <密码2>
            david=123456

            5.客户端连接
            svn co svn://ip/oplinux
            用户名密码:123456

            ===============================================================

            6.实现SVN与WEB同步,可以CO一个出来,也可以直接配在仓库中

            1)设置WEB服务器根目录为/www/webroot

            2)checkout一份SVN

            svn co svn://localhost/oplinux /data/www/webroot

            修改权限为WEB用户

            chown -R apache:apache /www/webroot/oplinux

            3)建立同步脚本

            cd /data/www/svndata/dykind/hooks/

            cp post-commit.tmpl post-commit

            编辑post-commit,在文件最后添加以下内容

            export LANG=en_US.UTF-8
            SVN=/usr/bin/svn
            WEB=/www/webroot/
            $SVN update $WEB –username rsync –password rsync
            chown -R apache:apache $WEB

            增加脚本执行权限

            chmod +x post-commit

    6.使用vim
        #打开创建
        >vim filename //打开vim并创建名为filename的文件
        #vim模式
        正常模式（按Esc或Ctrl+[进入） 左下角显示文件名或为空
        插入模式（按i键进入） 左下角显示--INSERT--
        可视模式（不知道如何进入） 左下角显示--VISUAL--
        #退出
        >:wq 保存并退出
        >ZZ 保存并退出
        >:q! 强制退出并忽略所有更改
        >:e! 放弃所有修改，并打开原来文件。
        #插入命令
        i 在当前位置生前插入
        I 在当前行首插入
        a 在当前位置后插入
        A 在当前行尾插入
        o 在当前行之后插入一行
        O 在当前行之前插入一行
        #光标移动
        在命令行模式下输入G  可以直接跳转到页面的底部
        在命令行模式下输入1G 可以跳转到页面的头部位置
        >:52    //跳到指定行，冒号+行号，回车，比如跳到240行就是 :240回车
        >52G    //跳到指定行，冒号+行号，回车，比如跳到240行就是 :240回车
        Ctrl + e 向下滚动一行
        Ctrl + y 向上滚动一行
        Ctrl + d 向下滚动半屏
        Ctrl + u 向上滚动半屏
        Ctrl + f 向下滚动一屏
        Ctrl + b 向上滚动一屏
        #撤销
        u 撤销（Undo）
        U 撤销对整行的操作
        Ctrl + r 重做（Redo），即撤销的撤销。
        #执行shell命令
        :!command
        :!ls 列出当前目录下文件
        :!perl -c script.pl 检查perl脚本语法，可以不用退出vim，非常方便。
        :!perl script.pl 执行perl脚本，可以不用退出vim，非常方便。
        :suspend或Ctrl - Z 挂起vim，回到shell，按fg可以返回vim。

    7.redis安装
        0)链接
            https://blog.csdn.net/yjqyyjw/article/details/73293455
        1)下载安装
            $.wget http://download.redis.io/releases/redis-4.0.6.tar.gz 或 wget http://182.150.63.148:8090/redis/redis-stable.tar.gz
            $.tar -zxvf redis-4.0.6.tar.gz
            $.cd redis-4.0.6
            $.make
            $.cd src
            $.make install PREFIX=/usr/local/redis
        2)配置
            A.复制配置
            $.cp redis.conf /usr/local/redis/etc/redis.conf
            B.启动服务
            $./usr/local/redis/bin/redis-server /usr/local/redis/etc/redis.conf
            第一个是启动redis服务器
            第二个是启动服务器所需的配置
            C.修改配置
            $.vim /usr/local/redis/etc/redis.conf
            将daemonize的值改为yes
            pidfile默认值是pidfile /var/run/redis_6379.pid
            添加密码
            requirepass dy123456
            D.复制服务启动脚本
            复制服务启动脚本
            $.cp redis_init_script /etc/init.d/redis
        3)服务(centos7以下)
            A.开机启动
            $.vim /etc/rc.local 加入 usr/local/redis/bin/redis-server /usr/local/redis/etc/redis-conf
            B.停止服务
            $./usr/local/redis/bin/redis-cli shutdown或者pkill redis-server
            C.客户端连接
            /usr/local/redis/bin/redis-cli
        4)服务(centos7以上)
            A.添加服务,开机启动
                vim /etc/init.d/redis #查看脚本内容(注意添加密码授权)
                #################编辑内容 start############################
                    #!/bin/bash
                    # chkconfig:   2345 90 10

                    # description:  Redis is a persistent key-value database
                    PATH=/usr/local/bin:/sbin:/usr/bin:/bin
                    REDISPORT=6379
                    EXEC=/usr/local/redis/bin/redis-server
                    RESDISPASSWORD=dy123456
                    REDIS_CLI=/usr/local/redis/bin/redis-cli
                    PIDFILE=/var/run/redis_6379.pid
                    CONF="/usr/local/redis/etc/redis.conf"
                    case "$1" in
                        start)
                            if [ -f $PIDFILE ]
                            then
                                echo "$PIDFILE exists, process is already running or crashed"
                            else
                                echo "Starting Redis server..."
                                $EXEC $CONF
                            fi
                            if [ "$?"="0" ]
                            then
                                echo "Redis is running..."
                            fi
                            ;;
                        stop)
                            if [ ! -f $PIDFILE ]
                            then
                                echo "$PIDFILE does not exist, process is not running"
                            else
                                PID=$(cat $PIDFILE)
                                echo "Stopping ..."
                                $REDIS_CLI -a $RESDISPASSWORD  -p $REDISPORT shutdown
                                while [ -x ${PIDFILE} ]
                                do
                                echo "Waiting for Redis to shutdown ..."
                                sleep 1
                                done
                                echo "Redis stopped"
                            fi
                            ;;
                        restart|force-reload)
                            ${0} stop
                            ${0} start
                            ;;
                        *)
                            echo "Usage: /etc/init.d/redis {start|stop|restart|force-reload}" >&2
                            exit 1
                    esac
                #################编辑内容 end  ############################
                chmod a+x /etc/init.d/redis
                chkconfig --add redis
                chkconfig redis on
            B.操作
                /etc/init.d/redis start
                /etc/init.d/redis restart
                /etc/init.d/redis stop

    8.git
        A.安装
            yum git
        B.常用命令
            git init  #在本地新建一个repo,进入一个项目目录,执行git init,会初始化一个repo,并在当前文件夹下创建一个.git文件夹.
            git clone url newname #clone下来的repo会以url最后一个斜线后面的名称命名,创建一个文件夹,如果想要指定特定的名称
            git status: #查询repo的状态
            git status -s: #-s表示short, -s的输出标记会有两列,第一列是对staging区域而言,第二列是对working目录而言.
            git add#在提交之前,Git有一个暂存区(staging area),可以放入新添加的文件或者加入新的改动. commit时提交的改动是上一次加入到staging area中的改动,而不是我们disk上的改动.
            git add .#会递归地添加当前工作目录中的所有文件.
            git commit#提交已经被add进来的改动.
            git commit -m #"the commit message"
            git commit -a #会先把所有已经track的文件的改动add进来,然后提交(有点像svn的一次提交,不用先暂存). 对于没有track的文件,还是需要git add一下.
            git commit --amend #增补提交. 会使用与当前提交节点相同的父节点进行一次新的提交,旧的提交将会被取消.
            git push [alias] [branch]#将会把当前分支merge到alias上的[branch]分支.如果分支已经存在,将会更新,如果不存在,将会添加这个分支
            git pull origin 分支#会首先执行git fetch,然后执行git merge,把取来的分支的head merge到当前分支.这个merge操作会产生一个新的commit
            git log#show commit history of a branch
            git diff#此命令比较的是工作目录中当前文件和暂存区域快照之间的差异,也就是修改之后还没有暂存起来的变化内容.
        C.生成ssh-key
            ssh-keygen -t rsa -C "wdyxzkq@163.com" -b 4096
            回车知道看到图案
            vim /root/.ssh/id_rsa.pub
            复制公钥添加至账户sshkey

            使用Tortoisegit生成key,查看地址:https://blog.csdn.net/m0_37727560/article/details/79408251

    9.docker
        A.安装
            a.准备工作
                uname -r 3.10.0-327.el7.x86_64
                Docker 运行在 CentOS 7 上，要求系统为64位、系统内核版本为 3.10 以上。
                Docker 运行在 CentOS-6.5 或更高的版本的 CentOS 上，要求系统为64位、系统内核版本为 2.6.32-431 或者更高版本。
            b.移除旧的版本：
                $ sudo yum remove docker \
                                  docker-client \
                                  docker-client-latest \
                                  docker-common \
                                  docker-latest \
                                  docker-latest-logrotate \
                                  docker-logrotate \
                                  docker-selinux \
                                  docker-engine-selinux \
                                  docker-engine
            c.安装一些必要的系统工具：
                sudo yum install -y yum-utils device-mapper-persistent-data lvm2
            d.添加软件源信息：
                sudo yum-config-manager --add-repo http://mirrors.aliyun.com/docker-ce/linux/centos/docker-ce.repo
            e.更新 yum 缓存：
                sudo yum makecache fast
            f.安装 Docker-ce：
                sudo yum -y install docker-ce
            g.启动 Docker 后台服务
                sudo systemctl start docker 或 service docker start
            h.验证是否安装成功
                docker version# 或者$ docker info
            i.测试运行 hello-world
                [root@runoob ~]# docker run hello-world
            j.工作目录
                cd /var/lib/docker/

    10.docker-compose
        A.pip安装
            a.安装python-pip
                yum -y install epel-release
                yum -y install python-pip
            b.安装docker-compose
                pip install docker-compose
            c.报错(Cannot uninstall ‘requests’. It is a distutils installed project and thus we cannot accurately determine which files belong to it which would lead to only a partial uninstall.),解决办法
                pip install docker-compose --ignore-installed requests
            d.查看是否安装成
                docker-compose version
        B.常用命令
            a.查看启动的容器:docker ps -a
            b.进入swoft容器:docker exec -it swoft bash
            c.启动容器:docker-compose up -d swoft
            d.停止容器:docker-compose stop swoft

    11.swoft
        A.安装
            a.composer安装
                composer create-project swoft/swoft swoft
                cd swoft
                composer install --no-dev # 不安装 dev 依赖会更快一些
            b.手动安装
                git clone https://github.com/swoft-cloud/swoft
                cd swoft
                composer install --no-dev # 不安装 dev 依赖会更快一些
                cp .env.example .env
                vim .env # 根据需要调整启动参数
            c.Docker方式安装
                docker run -p 80:80 swoft/swoft
            d.Docker-Compose 安装
                git clone https://github.com/swoft-cloud/swoft
                cd swoft
                修改docker-compose.yml
                ########################################
                version: '3'
                services:
                    swoft:
                        container_name: swoft
                        image: swoft/swoft
                        ports:
                            - "80:80"
                        #volumes:
                        #   - ./:/var/www/swoft
                        stdin_open: true0
                        tty: true
                        command: /bin/bash
                ########################################
                docker-compose up -d
        B.安装依赖
            composer install --no-dev # 不安装 dev 依赖会更快一些
            cp .env.example .env
            vim .env # 根据需要调整启动参数
        C.启动
            a.HTTP 服务器
                // 启动服务，根据 .env 配置决定是否是守护进程
                php bin/swoft start
                // 守护进程启动，覆盖 .env 守护进程(DAEMONIZE)的配置
                php bin/swoft start -d
                // 重启
                php bin/swoft restart
                // 重新加载
                php bin/swoft reload
                // 关闭服务
                php bin/swoft stop
            b.WebSocket服务器
                // 启动服务，根据 .env 配置决定是否是守护进程
                php bin/swoft ws:start
                // 守护进程启动，覆盖 .env 守护进程(DAEMONIZE)的配置
                php bin/swoft ws:start -d
                // 重启
                php bin/swoft ws:restart
                // 重新加载
                php bin/swoft ws:reload
                // 关闭服务
                php bin/swoft ws:stop
            c.RPC 服务器
                // 启动服务，根据 .env 配置决定是否是守护进程
                php bin/swoft rpc:start
                // 守护进程启动，覆盖 .env 守护进程(DAEMONIZE)的配置
                php bin/swoft rpc:start -d
                // 重启
                php bin/swoft rpc:restart
                // 重新加载
                php bin/swoft rpc:reload
                // 关闭服务
                php bin/swoft rpc:stop

五.lnmp安装
    参考文档
    nginx11+php5.6+mysql5.6   https://blog.csdn.net/sturdygrass/article/details/51750108
    nginx12+php7.2+mysql5.7   https://blog.csdn.net/linyunping/article/details/79738324
    init.sh

    1.nginx
        0.准备工作
            1). yum update
            2). yum install -y gcc gcc-c++
                yum install -y pcre pcre-devel openssl openssl-devel zlib zlib-devel psmisc
        1).添加专用分组和用户
            groupadd www
            useradd -g www www
            vim /etc/passwd
            然后找到有 www 那一行，把它修改为(后面由/bin/bash改为/sbin/nologin)：
        2).选择目录下载编译文件,解压,编译,安装
            官网下载(http://nginx.org/en/download.html) 或 wget http://182.150.63.148:8090/LNMP/nginx-1.12.2.tar.gz
            tar zxf  nginx-1.12.2.tar.gz
            cd nginx-1.12.2
            ./configure --user=www --group=www --prefix=安装目录/nginx --with-http_stub_status_module --with-http_ssl_module --with-http_v2_module --with-http_gzip_static_module --with-ipv6 --with-http_sub_module --sbin-path=安装目录/nginx/sbin/nginx
            make
            make install
        3).配置nginx
            mv 安装目录/nginx/conf/nginx.conf{,.bak}
            wget http://182.150.63.148:8090/tars/config/nginx.conf  -P 安装目录/nginx/conf/
            wget http://182.150.63.148:8090/tars/config/enable-php.conf -P 安装目录/nginx/conf/
            mkdir -pv 安装目录/nginx/conf/vhosts

            支持php,在启动php-fpm之后修改
            ######################################
            location / {
                index  index.html index.htm index.php;
                #autoindex  on;
            }
            location ~ \.php(.*)$ {
                fastcgi_pass   127.0.0.1:9000;
                fastcgi_index  index.php;
                fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
                fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_param  PATH_INFO  $fastcgi_path_info;
                fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
                include        fastcgi_params;
            }
            ######################################
        4).手动启动服务
            安装目录/nginx/sbin/nginx
            安装目录/nginx/sbin/nginx -s reload
            安装目录/nginx/sbin/nginx -t
            安装目录/nginx/sbin/nginx -t -s reload
        5).开机启动添加
            Centos 系统服务脚本目录：
            用户（user）
            用户登录后才能运行的程序，存在用户（user）
            /usr/lib/systemd/
            系统（system）
            如需要开机没有登陆情况下就能运行的程序，存在系统服务（system）里
            /lib/systemd/system/
            服务以.service结尾。
            vim /lib/systemd/system/nginx.service
            ####################内容 start####################
                [Unit]
                Description=nginx
                After=network.target
                [Service]
                Type=forking
                ExecStart=/usr/local/nginx/sbin/nginx
                ExecReload=/usr/local/nginx/sbin/nginx -s reload
                ExecStop=/usr/local/nginx/sbin/nginx -s stop
                PrivateTmp=true
                [Install]
                WantedBy=multi-user.target
            ######################内容 end#####################
            设置开机启动
            systemctl enable nginx.service
        6).查看nginx版本,测试
            安装目录/nginx/sbin/nginx -v
            curl localhost
        7).查看进程
            ps -ef | grep nginx
        8).开启对外端口(centos7以上)
            开启端口：
            firewall-cmd --zone=public --add-port=80/tcp --permanent    （--permanent永久生效，没有此参数重启后失效）
            重新载入
            firewall-cmd --reload
        9).配置虚拟域名,添加host
            配置虚拟域名
            #####################################################
            server {
                    listen       80;
                    server_name  www.dy.cn dy.cn;
                    root   /data/website;
                    location / {
                        index  index.html index.htm index.php;
                        autoindex  on;
                    }
                    location ~ \.php(.*)$ {
                        fastcgi_pass   127.0.0.1:9000;
                        fastcgi_index  index.php;
                        fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
                        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                        fastcgi_param  PATH_INFO  $fastcgi_path_info;
                        fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
                        include        fastcgi_params;
                    }
            }
            #####################################################
            添加host:vim /etc/hosts即可编辑
        10).添加环境变量
            # vim /etc/profile
            在最后，添加:
            export PATH="/data/webserver/nginx/sbin:$PATH" #添加的路径
            保存，退出，然后运行：
            #source /etc/profile
            不报错则成功。
        11).nginx管理的几种方式
            # 启动Nginx
            /usr/local/nginx/sbin/nginx
            # 从容停止Nginx：
            kill -QUIT 主进程号 # 如上一步中的 ps 命令输出的 29151，就是 Nginx的主进程号
            # 快速停止Nginx：
            kill -TERM 主进程号
            # 强制停止Nginx：
            pkill -9 nginx
            # 平滑重启nginx
            /usr/nginx/sbin/nginx -s reload
    2.php
        0).准备工作
            yum -y install composer libjpeg-devel libxml2-devel libpng-devel freetype-devel curl-devel libicu-devel epel-release libmcrypt-devel libxslt libxslt-devel autoconf git supervisor openssh-clients  lftp lrzsz lftp telnet
        1).选择目录下载编译文件,解压,编译,安装
            A.wget -c http://cn2.php.net/distributions/php-7.1.3.tar.gz 或 http://cn2.php.net/distributions/php-7.2.9.tar.gz
            B.tar zxf php-7.2.9.tar.gz
            C.cd php-7.2.9
            D.  ./configure    --prefix=安装目录/php   --with-config-file-path=安装目录/php/etc   --with-config-file-scan-dir=安装目录/php/conf.d   --enable-fpm   --with-fpm-user=www   --with-fpm-group=www   --enable-mysqlnd   --with-mysqli=mysqlnd   --with-pdo-mysql=mysqlnd   --with-iconv-dir   --with-freetype-dir=安装目录/freetype   --with-jpeg-dir   --with-png-dir   --with-zlib   --with-libxml-dir=/usr   --enable-xml   --disable-rpath   --enable-bcmath   --enable-shmop   --enable-sysvsem   --enable-inline-optimization   --with-curl   --enable-mbregex   --enable-mbstring   --enable-intl   --with-mcrypt   --enable-ftp   --with-gd   --enable-gd-native-ttf   --with-openssl   --with-mhash   --enable-pcntl   --enable-sockets   --with-xmlrpc   --enable-zip   --enable-soap   --with-gettext   --disable-fileinfo   --enable-opcache   --with-xsl
            E.make && make install
        2).查看版本
            /usr/local/php7/bin/php -v
        3).查看,修改配置
            查看配置
            /usr/local/php7/bin/php -i | grep php.ini
            从解压缩文件夹复制
            cp 安装目录/php/etc/php-fpm.conf.default 安装目录/php/etc/php-fpm.conf
            cp 安装目录/php/etc/php-fpm.d/www.conf.default 安装目录/php/etc/php-fpm.d/www.conf
            sed -i 's/user = nobody group = nobody/user = www group = www/' 安装目录/php/etc/php-fpm.d/www.conf
            sed -i 's/;pid = run/pid = run/' 安装目录/php/etc/php-fpm.conf
            cp 解压文件夹/php-7.2.9/php.ini-production 安装目录/php/etc/php.ini
            cp 解压文件夹/php-7.2.9/sapi/fpm/init.d.php-fpm /etc/init.d/php-fpm
            mv 安装目录/php/etc/php-fpm.conf{,.bak}
            wget http://182.150.63.148:8090/tars/config/php-fpm.conf -P 安装目录/php/etc/
            chmod 755 /etc/init.d/php-fpm
            /etc/init.d/php-fpm start
            rm -rf /usr/bin/php
            cp 安装目录/php/bin/php /usr/bin/
            安装目录/nginx/sbin/nginx -s reload
            修改composer为国内源:composer config -g repo.packagist composer https://packagist.phpcomposer.com

            nginx打开php文件报错:access denied解决
            php.ini文件修改cgi.fix_pathinfo从0改为1(让php可以解析路径)
        4).安装php-fpm,启动
            chmod 755 /etc/init.d/php-fpm
            /etc/init.d/php-fpm start
            chkconfig --add php-fpm
            chkconfig php-fpm on
        5).查看进程
            ps -ef | grep php-fpm
        6).php-fpm管理
            /etc/init.d/php-fpm start
            /etc/init.d/php-fpm restart
            /etc/init.d/php-fpm stop
        7).安装扩展
            -A.PECL
                //php版本 > 7
                $ wget http://pear.php.net/go-pear.phar
                $ php go-pear.phar

                //php版本 < 7
                $ yum install php-pear
                //否则会报错PHP Parse error:  syntax error, unexpected //'new' (T_NEW) in /usr/share/pear/PEAR/Frontend.php on //line 91
            A.redis
                a.进入预定目录,下载,解压,进入文件夹
                wget https://codeload.github.com/phpredis/phpredis/zip/develop 或 https://github.com/phpredis/phpredis
                unzip phpredis-develop.zip
                cd phpredis-develop
                b.生成configure配置文件
                php安装目录/bin/phpize
                c.编译安装
                ./configure --with-php-config=php安装目录/bin/php-config(如果找不见php-config,则使用 find / -name 'php-config')
                make && make install
                d.配置php.ini
                配置php.ini
                在extension后添加
                extension=redis.so
                e.查看结果
                重启php:/etc/init.d/php-fpm restart
                检查:
                [root@test etc]# /usr/local/php-7.1/bin/php -m|grep redis
                redis
                或直接看phpinfo.php查找redis
            B.libxls
                wget http://182.150.63.148:8090/tars/libxlsxwriter.tar.gz -P 解压目录
                tar zxf 解压目录/libxlsxwriter.tar.gz -C 解压目录
                cd 解压目录/libxlsxwriter
                make && make install
            C.php-excel#
                wget http://182.150.63.148:8090/tars/php-ext-excel-export.tar.gz -P 解压目录
                tar zxf 解压目录/php-ext-excel-export.tar.gz -C 解压目录
                cd 解压目录/php-ext-excel-export
                php安装目录/php/bin/phpize
                ./configure --with-php-config=php安装目录/php/bin/php-config
                make && make install
            D.php-fileinfo
                cd 解压目录/php-7.2.9/ext/fileinfo/
                php安装目录/php/bin/phpize
                ./configure --with-php-config=php安装目录/php/bin/php-config
                make && make install
            E.mongo
                wget http://182.150.63.148:8090/tars/mongodb-1.3.4.tgz -P 解压目录
                tar zxf 解压目录/mongodb-1.3.4.tgz  -C 解压目录
                cd 解压目录/mongodb-1.3.4
                php安装目录/php/bin/phpize
                ./configure --with-php-config=php安装目录/php/bin/php-config
                make && make install
            F.ImageMagick
                wget http://182.150.63.148:8090/tars/ImageMagick-7.0.7-21.tar.gz -P 解压目录
                tar zxf 解压目录/ImageMagick-7.0.7-21.tar.gz -C 解压目录
                cd 解压目录/ImageMagick-7.0.7-21
                ./configure --prefix=$APPDIR/imagemagick
                make && make install
                wget http://182.150.63.148:8090/tars/imagick-3.4.3.tgz -P 解压目录
                tar zxf 解压目录/imagick-3.4.3.tgz -C 解压目录
                cd 解压目录/imagick-3.4.3
                php安装目录/php/bin/phpize
                ./configure --with-php-config=php安装目录/php/bin/php-config --with-imagick=$APPDIR/imagemagick
                make && make install
            G.swoole
                A.方法一
                pecl install swoole 或 /data/webserver/php/bin/pecl install swoole
                B.方法二
                wget -O swoole-src-4.2.1.tar.gz https://codeload.github.com/swoole/swoole-src/tar.gz/v4.2.1
                tar zxf swoole-src-4.2.1.tar.gz
                cd swoole-src-4.2.1
                php安装目录/bin/phpize
                ./configure --with-php-config=/data/webserver/php/bin/php-config
                make clean
                make && make install
                C.添加扩展
                php.ini添加extension=swoole.so
                D.重启php-fpm
                /etc/init.d/php-fpm restart
            H.hiredis
                wget https://github.com/redis/hiredis/archive/v0.13.3.zip 或 wget -O hiredis-0.13.3 https://github.com/redis/hiredis/releases
                yum -y install unzip
                unzip v0.13.3.zip
                cd hiredis-0.13.3/
                make && make install
                ldconfig
                #加php-fpm环境变量
                vim /etc/profile
                #最后一行加入
                export PATH="$PATH:/data/webserver/php/sbin/:/data/webserver/php/bin/"
                #重新设置环境变量
                source /etc/profile
                #查看环境变量是否成功
                export
                #启动异步redis客户端
                重新编译安装swoole，在configure指令中加入--enable-async-redis
                #重新安装swoole可能遇到的问题
                php-m 发现swoole消失或者是通过php --ri swoole没有显示async redis client 或 redis client
                vi ~/.bash_profile
                在最后一行添加 export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/lib
                source ~/.bash_profile
                重新编译安装swoole即可
                /etc/init.d/php-fpm restart
                最好是重启一下服务器

            mv php安装目录/php/etc/php.ini{,.bak}
            wget http://182.150.63.148:8090/tars/config/php.ini -P  php安装目录/php/etc/
            /etc/init.d/php-fpm restart
    3.mysql
        0).准备工作
            yum -y install sysstat cmake flex bison autoconf gcc-c++ automake bzip2-devel ncurses-devel zlib-devel libjpeg-devel libpng-devel libtiff-devel freetype-devel libXpm-devel gettext-devel pam-devel libtool libtool-ltdl openssl openssl-devel fontconfig-devel libxml2-devel curl-devel libicu libicu-devel
        1).添加专用分组和用户
            groupadd mysql
            /usr/sbin/useradd -r -g mysql -s /bin/false mysql
        2).选择目录下载编译文件,解压,编译,安装
            A.下载
            官网下载(https://dev.mysql.com/downloads/mysql/5.7.html#downloads)(选择RedHat Enterprise Linux 7 / Oracle Linux 7 (Architecture Independent), RPM Package)
            或 wget http://182.150.63.148:8090/LNMP/mysql-5.7.20.tar.gz -P 解压缩文件夹
            或 wget http://repo.mysql.com//mysql57-community-release-el7-7.noarch.rpm
            或 wget http://cdn.mysql.com//Downloads/MySQL-5.7/mysql-community-server-5.7.18-1.el7.x86_64.rpm
            wget http://182.150.63.148:8090/LNMP/boost_1_59_0.tar.gz -P 解压缩文件夹
            B.解压
            tar zxf mysql-5.7.20.tar.gz -C 解压缩文件夹
            tar zxf boost_1_59_0.tar.gz -C 解压缩文件夹
            mkdir -pv 安装目录/{mysql,tmp_db,database}
            C.编译&安装
            mkdir -pv /var/lib/mysql
            chown -R mysql:mysql /var/lib/mysql
            chown -R mysql:mysql 安装目录/
            cd 解压缩文件夹/mysql-5.7.20
            cmake -DCMAKE_INSTALL_PREFIX=安装目录/mysql  -DMYSQL_DATADIR=安装目录/database -DMYSQL_UNIX_ADDR=/var/lib/mysql/mysql.sock -DDEFAULT_CHARSET=utf8 -DDEFAULT_COLLATION=utf8_general_ci -DMYSQL_TCP_PORT=3306 -DMYSQL_USER=mysql -DWITH_MYISAM_STORAGE_ENGINE=1 -DWITH_INNOBASE_STORAGE_ENGINE=1 -DWITH_ARCHIVE_STORAGE_ENGINE=1 -DWITH_BLACKHOLE_STORAGE_ENGINE=1 -DWITH_MEMORY_STORAGE_ENGINE=1 -DENABLE_DOWNLOADS=1 -DDOWNLOAD_BOOST=0 -DWITH_BOOST=解压缩文件夹/boost_1_59_0 -DSYSTEMD_PID_DIR=/var/run/mysql.pid -DSYSCONFDIR=/etc/my.cnf
            make && make install
            chmod 750 安装目录/database
        3).初始化
            安装目录/mysql/bin/mysqld --initialize --user=mysql
            注意此处或给出默认登陆密码
            cp 安装目录/mysql/bin/mysql /usr/sbin/
            cp 解压缩文件夹/mysql-5.7.20/support-files/mysql.server /etc/init.d/mysqld
            chmod +x /etc/init.d/mysqld
            chkconfig --add mysqld
            chkconfig mysqld on
        4).修改配置
            在安装目录下添加配置文件
            ###############################################
                [mysql]
                # 设置mysql客户端默认字符集
                default-character-set=utf8
                [mysqld]
                #设置3306端口
                port = 3306
                # 设置mysql的安装目录
                basedir=/data/LPDB/mysql/
                # 设置mysql数据库的数据的存放目录
                datadir=/data/LPDB/database/
                # 允许最大连接数
                max_connections=200
                # 服务端使用的字符集默认为8比特编码的latin1字符集
                character-set-server=utf8
                # 创建新表时将使用的默认存储引擎
                default-storage-engine=INNODB

                skip-grant-tables
            ###############################################
        5).启动
            /etc/init.d/mysqld start
        6).查找当前配置路径
            # which mysqld
            /usr/local/mysql/bin/mysqld
            # /usr/local/mysql/bin/mysqld --verbose --help |grep -A 1 'Default options'
            2016-06-02 16:49:39 0 [Note] /usr/local/mysql/bin/mysqld (mysqld 5.6.25-log) starting as process 8253 ...
            2016-06-02 16:49:41 8253 [Note] Plugin 'FEDERATED' is disabled.
            Default options are read from the following files in the given order: 默认的选项是按照给定的顺序读取从以下文件:
            /etc/mysql/my.cnf /etc/my.cnf ~/.my.cnf
        7).设置默认密码
            在配置文件中添加配置项:skip-grant-tables(没有配置文件则在安装目录下创建my.cnf
                ###############################################
                    [mysql]
                    # 设置mysql客户端默认字符集
                    default-character-set=utf8
                    [mysqld]
                    #设置3306端口
                    port = 3306
                    # 设置mysql的安装目录
                    basedir=/data/LPDB/mysql/
                    # 设置mysql数据库的数据的存放目录
                    datadir=/data/LPDB/database/
                    # 允许最大连接数
                    max_connections=200
                    # 服务端使用的字符集默认为8比特编码的latin1字符集
                    character-set-server=utf8
                    # 创建新表时将使用的默认存储引擎
                    default-storage-engine=INNODB

                    skip-grant-tables
                ###############################################
                )
            update mysql.user set authentication_string=password('root') where User='root' and Host='localhost';
            flush privileges;
            去掉skip-grant-tables配置项
        8).初始化密码(报错:mac mysql error You must reset your password using ALTER USER statement before executing this statement.)
            step 1: SET PASSWORD = PASSWORD('your new password');
            step 2: ALTER USER 'root'@'localhost' PASSWORD EXPIRE NEVER;
            step 3: flush privileges;
        9).开启远程登陆
            1. 打开/etc/mysql/mysql.conf.d/mysqld.cnf, 注掉 "bind-address = 127.0.0.1",
            2. 重启mysql service "/etc/init.d/mysql restart"
            3. 执行: mysql> GRANT ALL PRIVILEGES ON *.* TO 'USERNAME'@'%' IDENTIFIED BY 'PASSWORD' WITH GRANT OPTION;
            注意: 这里的USERNAME是你的数据库账户，PASSWORD是你的数据库密码
            例如: mysql> GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root' WITH GRANT OPTION;
            4. 执行: mysql> flush privileges;
            5. 退出mysql命令行，执行：　mysql -u root -h 192.168.0.1 -p
        10).开启对外端口(centos7以上)
            开启端口：
            firewall-cmd --zone=public --add-port=3306/tcp --permanent    （--permanent永久生效，没有此参数重启后失效）
            重新载入
            firewall-cmd --reload
        11).php-fpm管理
            /etc/init.d/mysqld start
            /etc/init.d/mysqld restart
            /etc/init.d/mysqld stop
