<?php


/**
 * php各版本说明
 */

//1.PHP5.2以前
autoload : 如果定义了该函数，那么当在代码中使用一个未定义的类的时候，该函数就会被调用
PDO 和 MySQLi : PHP 的新式数据库访问接口
类型约束 : 通过类型约束可以限制参数的类型
JSON 支持 : 包括 json_encode(), json_decode() 等函数

//2.PHP5.3
弃用的功能，匿名函数，新增魔术方法，命名空间，后期静态绑定，Heredoc 和 Nowdoc, const, 三元运算符简写，Phar

//3.PHP5.4
Short Open Tag, 数组简写形式，Traits, 内置 Web 服务器，细节修改

//4.PHP5.5
yield, list() 用于 foreach, 细节修改

//5.PHP5.6
常量增强(定义常量时允许使用之前定义的常量进行计算,允许常量作为函数参数默认值)，可变函数参数，命名空间支持常量和函数