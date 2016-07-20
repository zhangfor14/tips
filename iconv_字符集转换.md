PHP iconv()函数转字符编码的问题


在php函数库有一个函数：iconv()，iconv函数库能够完成各种字符集间的转换，是php编程中不可缺少的基础函数库。
最近在做一个小偷程序，需要用到iconv函数把抓取来过的utf-8编码的页面转成gb2312， 发现只有用iconv函数把抓取过来的数据一转码数据就会无缘无故的少一些。 让我郁闷了好一会儿，去网上一查资料才知道这是iconv函数的一个bug。iconv在转换字符"—"到gb2312时会出错。
下面慢慢看一下这个函数的用法。
最简单的应用，把gb2312置换成utf-8：
1
$text=iconv("GB2312","UTF-8",$text);
在用$text=iconv("UTF-8","GB2312",$text)过程中，如果遇到一些特别字符时，如："—"，英文名中的"."等等字符，转换就断掉了。这些字符后的文字都没法继续转换了。
针对这的问题，可以用如下代码实现：
1
$text=iconv("UTF-8","GBK",$text);
你没有看错，就这么简单，不使用gb2312，而写成GBK，就可以了。
还有一种方法，第二个参数，加上//IGNORE，忽略错误，如下：
1
iconv("UTF-8","GB2312//IGNORE",$data);
没有具体比较这两种方法，感觉第一种（GBK代替gb2312）方法更好。
php手册中iconv() 说明：
1
iconv
2
  
3
(PHP 4 >= 4.0.5, PHP 5)
4
iconv – Convert string to requested character encoding
5
Description
6
string iconv ( string in_charset, string out_charset, string str )
7
Performs a character set conversion on the string str from in_charset to out_charset. Returns the converted string or FALSE on failure.
8
If you append the string //TRANSLIT to out_charset transliteration is activated. This means that when a character can't be represented in the target charset, it can be approximated through one or several similarly looking characters. If you append the string //IGNORE, characters that cannot be represented in the target charset are silently discarded. Otherwise, str is cut from the first illegal character.
在使用这个函数进行字符串编码转换时，需要注意，如果将utf-8转换为gb2312时，可能会出现字符串被截断的情况发生。此时可以使用以下方法解决：
1
$str=iconv('utf-8',"gb2312//TRANSLIT",file_get_contents($filepath));