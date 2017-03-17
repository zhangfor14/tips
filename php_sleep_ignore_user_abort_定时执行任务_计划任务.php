<?php

/**********1.bat脚本*******************************/
#1、写一个PHP程序，命名为test.php，内容如下所示：
$fp = fopen("test.txt", "a+");
fwrite($fp, date("Y-m-d H:i:s") . " 成功成功了！\n");
fclose($fp);
#2、新建Bat文件，命名为test.bat,内容如下所示：
D:\php\php.exe -q D:\website\test.php  //相应目录自己改上
#3、建立WINDOWS计划任务：
/*
开始–>控制面板–>任务计划–>添加任务计划
浏览文件夹选择上面的bat文件
设置时间和密码（登陆WINDOWS的）
保存即可了。
*/
#4、over! 可以右键计划任务点“运行”试试

/*********2.ignore_user_abort浏览器刷新**********************************/
#tips
ignore_user_abort() 可以实现当客户端关闭后仍然可以执行PHP代码，可保持PHP
进程一直在执行，可实现所谓的计划任务功能与持续进程，只需要开启执行脚本，除非 apache等服务器重启或有脚本有输出，该PHP
脚本将一直处于执行的状态，初看很实用，不过代价是一个PHP执行脚本的持续进程，开销很大，但却可以 实现很多意想不到的功 能。

/**
 * [sleepphp 定时执行任务]
 * @return [type] [description]
 */
public function sleepphp(){
    ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
    set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
    $interval=1*30;// 每隔半分钟运行
    include './isContiue.php';
    M()->db(1,"mysql://root:root@localhost:3306/dy")->query("SELECT * FROM `sleepphp` LIMIT 1");
    do{
        //这里是你要执行的代码
        include './isContiue.php';
        $sql="INSERT INTO `sleepphp` VALUES (NULL,'".date('Y-m-d H:i:s')."')";
        M()->db(1)->query($sql);
        echo $sql;
        sleep($interval);// 等待时间
    }while(true);
}

//isContiue.php文件内容
return TRUE;//TRUE执行脚本,FALSE退出脚本

/*********3.crontab命令**********************************/
#什么是Cygwin
/*
Cygwin是一个在windows平台上运行的类UNIX模拟环境，是cygnus solutions公司开发的自由软件（该公司开发的著名工具还有eCos，不过现已被Redhat收购）。它对于学习UNIX/Linux操作环境，或者从UNIX到Windows的应用程序移植，或者进行某些特殊的开发工作，尤其是使用GNU工具集在Windows上进行嵌入式系统开发，非常有用。随着嵌入式系统开发在国内日渐流行，越来越多的开发者对Cygwin产生了兴趣。
*/