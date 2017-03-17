

/**
 * 1.Runtime报错:
 */
创建 mkdir Runtime
并给权限 chmod 777 Runtime

/**
 * 2.url小写:
 */
设置debug在关闭的时候，生成的url变成小写的问题,配置文件中添加:
'URL_CASE_INSENSITIVE'=>false,//区分大小写