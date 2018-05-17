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

    6. linux启动项管理
        ># ntsysv

    7. 设备管理,包括防火墙
        ># setup

    8. 查看网络信息
    	># ifconfig

    9. 查看服务是否启动
    	>#ps -A | grep 服务名(模糊查询)

    10. 杀死进程
    	>#ps killall  httpd  杀死全部的httpd进程

    11. 寻找进程安装目录
        >#find / -name opensslv.h

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



