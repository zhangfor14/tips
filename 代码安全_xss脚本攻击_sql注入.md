/**
 * 代码安全
 */


//1.XSS过滤
A.说明:
跨站脚本攻击。它指的是恶意攻击者往Web页面里插入恶意html代码，当用户浏览该页之时，嵌入其中Web里面的html代码会被执行，从而达到恶意攻击用户的特殊目的。

B.函数:
htmlentities		:	转换所有的html标记
htmlspecialchars	:	只格式化& ' " < 和 > 这几个特殊符号

C.注意:
这两个函数的功能都是转换字符为HTML字符编码，特别是url和代码字符串。防止字符标记被浏览器执行。使用中文时没什么区别,但htmlentities会格式化中文字符使得中文输入是乱码

D.使用:
htmlentities($str,ENT_COMPAT,"GB2312")
htmlentities($str)

E.thinkphp中配置:
'default_filter'         => 'trim,htmlspecialchars',// 默认全局过滤方法 用逗号分隔多个


//2.sql注入
A.说明:
所谓SQL注入，就是通过把SQL命令插入到Web表单提交或输入域名或页面请求的查询字符串，最终达到欺骗服务器执行恶意的SQL命令。

B.函数:
addslashes	:	单引号（'）,双引号（"）,反斜杠（\）,NULL前添加反斜杠

C.注意:
默认地，PHP 对所有的 GET、POST 和 COOKIE 数据自动运行 addslashes()。所以您不应对已转义过的字符串使用 addslashes()，因为这样会导致双层转义。遇到这种情况时可以使用函数 get_magic_quotes_gpc() 进行检测。

D.使用
addslashes($str)