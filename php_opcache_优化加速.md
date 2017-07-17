一.php.ini

[opcache]
; dll地址
zend_extension=php_opcache.dll
; 开关打开
opcache.enable=1
; 开启CLI
opcache.enable_cli=1
; 可用内存, 酌情而定, 单位为：Mb
opcache.memory_consumption=528
; Zend Optimizer + 暂存池中字符串的占内存总量.(单位:MB)
opcache.interned_strings_buffer=8
; 对多缓存文件限制, 命中率不到 100% 的话, 可以试着提高这个值
opcache.max_accelerated_files=10000
; Opcache 会在一定时间内去检查文件的修改时间, 这里设置检查的时间周期, 默认为 2, 定位为秒
opcache.revalidate_freq=1
; 打开快速关闭, 打开这个在PHP Request Shutdown的时候回收内存的速度会提高
opcache.fast_shutdown=1


二.配置说明
[opcache]
zend_extension = "G:/PHP/php-5.5.6-Win32-VC11-x64/ext/php_opcache.dll"
 
; Zend Optimizer + 的开关, 关闭时代码不再优化.
opcache.enable=1
 
; Determines if Zend OPCache is enabled for the CLI version of PHP
opcache.enable_cli=1
 
 
; Zend Optimizer + 共享内存的大小, 总共能够存储多少预编译的 PHP 代码(单位:MB)
; 推荐 128
opcache.memory_consumption=64
 
; Zend Optimizer + 暂存池中字符串的占内存总量.(单位:MB)
; 推荐 8
opcache.interned_strings_buffer=4
 
 
; 最大缓存的文件数目 200  到 100000 之间
; 推荐 4000
opcache.max_accelerated_files=2000
 
; 内存“浪费”达到此值对应的百分比,就会发起一个重启调度.
opcache.max_wasted_percentage=5
 
; 开启这条指令, Zend Optimizer + 会自动将当前工作目录的名字追加到脚本键上,
; 以此消除同名文件间的键值命名冲突.关闭这条指令会提升性能,
; 但是会对已存在的应用造成破坏.
opcache.use_cwd=0
 
 
; 开启文件时间戳验证 
opcache.validate_timestamps=1
 
 
; 2s检查一次文件更新 注意:0是一直检查不是关闭
; 推荐 60
opcache.revalidate_freq=2
 
; 允许或禁止在 include_path 中进行文件搜索的优化
;opcache.revalidate_path=0
 
 
; 是否保存文件/函数的注释   如果apigen、Doctrine、 ZF2、 PHPUnit需要文件注释
; 推荐 0
opcache.save_comments=1
 
; 是否加载文件/函数的注释
;opcache.load_comments=1
 
 
; 打开快速关闭, 打开这个在PHP Request Shutdown的时候会收内存的速度会提高
; 推荐 1
opcache.fast_shutdown=1
 
;允许覆盖文件存在（file_exists等）的优化特性。
;opcache.enable_file_override=0
 
 
; 定义启动多少个优化过程
;opcache.optimization_level=0xffffffff
 
 
; 启用此Hack可以暂时性的解决”can’t redeclare class”错误.
;opcache.inherited_hack=1
 
; 启用此Hack可以暂时性的解决”can’t redeclare class”错误.
;opcache.dups_fix=0
 
; 设置不缓存的黑名单
; 不缓存指定目录下cache_开头的PHP文件. /png/www/example.com/public_html/cache/cache_ 
;opcache.blacklist_filename=
 
 
; 通过文件大小屏除大文件的缓存.默认情况下所有的文件都会被缓存.
;opcache.max_file_size=0
 
; 每 N 次请求检查一次缓存校验.默认值0表示检查被禁用了.
; 由于计算校验值有损性能,这个指令应当紧紧在开发调试的时候开启.
;opcache.consistency_checks=0
 
; 从缓存不被访问后,等待多久后(单位为秒)调度重启
;opcache.force_restart_timeout=180
 
; 错误日志文件名.留空表示使用标准错误输出(stderr).
;opcache.error_log=
 
 
; 将错误信息写入到服务器(Apache等)日志
;opcache.log_verbosity_level=1
 
; 内存共享的首选后台.留空则是让系统选择.
;opcache.preferred_memory_model=
 
; 防止共享内存在脚本执行期间被意外写入, 仅用于内部调试.
;opcache.protect_memory=0


三.使用
实际上，对于Opcache的使用，主要体现在其提供的几个函数：
1、opcache_get_configuration；
形式:array opcache_get_configuration(void);
获取设置的缓存配置信息，以数组形式返回配置信息、黑名单及版本号。
 
2、opcache_get_status；
形式:array opcache_get_status(void);
获取设置的缓存状态信息。
 
3、opcache_invalidate；
形式:boolean opcache_invalidate (string);
该函数的作用是使得指定脚本的字节码缓存失效。如果force 没有设置或者传入的是 FALSE，那么只有当脚本的修改时间 比对应字节码的时间更新，脚本的缓存才会失效。
 
4、opcache_reset;
形式:boolean opcache_reset(void);
该函数将重置整个字节码缓存。在调用 opcache_reset() 之后，所有的脚本将会重新载入并且在下次被点击的时候重新解析。
 
5、opcache_compile_file；
形式:boolean opcache_compile_file (string);
无需运行，就可以编译并缓存脚本。
 
6、opcache_is_script_cached
形式:boolean opcache_is_script_cached (string);
判断某个脚本是否已经缓存到Opcache。
 
下面我编写一个PHP脚本，囊括上面的几个函数的封装，这样也方便日后对Opcache的维护和管理，具体如下：
<?php
/**
 * 这个文件是对opcache优化器的几个
 * 函数的封装，作为一个工具脚本使用
 */
 
if(!extension_loaded("ZendOpcache")) {
      echo "You do nothave the Zend OPcache extension loaded , please open it up,then retry!";
}
 
/**
 * 函数操作封装类
 * 数组形式的结果，会转为json格式返回,不做显示上的处理
 * 这里主要处理的是影响Opcache缓存状态的操作，对于查看
 * Opcache各项指标的处理，可查看项目：opcache-status
 */
class OpcacheScriptModel{
      private $_configuration;
      private $_status;
     
      function __construct() {
            $this->_configuration =opcache_get_configuration();
            $this->_status =opcache_get_status();
      }
     
      // 获取配置信息
      public function getConfigDatas(){
            echo json_encode($this->_configuration);
      }
     
      // 获取状态信息
      public function getStatusDatas(){
            echo json_encode($this->_status);
      }
     
      // 指定某脚本文件字节码缓存失效
      public function invalidate($script){
            return opcache_invalidate($script);
      }
     
      // 重置或清除整个字节码缓存数据
      public function reset() {
            return opcache_reset();
      }
     
      // 无需运行，就可以编译并缓存脚本
      public function compile($file){
            return opcache_compile_file($file);
      }
     
      // 判断某个脚本是否已经缓存到Opcache
      public function isCached($script){
            return opcache_is_script_cached($script);
      }
}
 
// 获得对象
function getOpcacheDataModel(){
      // 初始化对象
      $dataModel = NULL;
      if(NULL ==$dataModel) {
            $dataModel = new OpcacheScriptModel();
      }
     
      return $dataModel;
}
 
?>