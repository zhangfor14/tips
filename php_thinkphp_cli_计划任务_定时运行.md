/**
 * thinkphp cli
 */
thinkphp3.2的cli模式支持，但是官方文档却没有明确的使用文档，网上出现很多相关提问，部分解决办法本人测试发现有报错。通过查看核心代码了解到cli模式的真正的使用方法，已经在生产环境使用。

方法/步骤
1
新建一个入口文件命名cli.php 内容跟index.php不变，增加代码定义当前入口文件调用使用命令行模式define(‘APP_MODE’,'cli'); 
2
对APP的路径定义，还有框架引入的路径，从相对路径改成绝对路径，如：define('APP_PATH',dirname(__FILE__).'/Application/');
3
在路径 /ThinkPHP/Mode 下面有个文件，名字叫做common.php ，复制一份出来，命名为cli.php，然后把里面引入日志类的代码注释或者删除掉：即干掉 
'Think\Log'               => CORE_PATH . ‘Log'.EXT,
END
注意事项
删除缓存下面的所有缓存——记得是所有
​以后cli模式调用的时候，就用cli.php入口文件，比如定时任务 0 * * * * * php /www/index.php home/article/get ，如果是web服务访问，则依然使用index.php文件

/**
 * .bat文件
 */
@echo off
D:
cd D:\WWW\MeteoPlatform
D:\phpStudy\php53\php.exe cli.php /Admin/Gridmeteo/index
::pause

/**
 * windows计划任务
 */
点击开始菜单--选择控制面板--选择管理工具--选择计划任务--来到任务计划面板--新创建一个计划任务--输入一个名称--切换到操作并点击新建--然后再浏览里面找到你需要执行的程序；--如果你是批处理的话也是可以的--切换到触发器--点击创建--在执行时间里面设置一个时间--创建完成之后回到任务计划管理器
