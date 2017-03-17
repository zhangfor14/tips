<?php


/**
 * [nowEchoString 方式一]
 * @return [type] [description]
 */
function nowEchoString_v1(){
	echo str_repeat(" ",1024);//输出大于限定数目的空白字符
	for($i=0;$i<10;$i++){
	    echo $i."<br>";//在遇到HTML标签的时候才会即时输出
	    ob_flush(); //把数据从PHP的缓冲中释放出来
	    flush();    //把不在缓冲中的或者被释放出来的数据发送到浏览器,刷新buffer
	    sleep(1);
	}
}


/**
 * [nowEchoString_v2 方式二]
 * @return [type] [description]
 */
function nowEchoString_v2(){
	ob_end_clean();//清除并关闭缓冲，输出到浏览器之前使用这个函数。
	ob_implicit_flush(1);//控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
	for($i=0;$i<10;$i++){
	    echo $i;
	    sleep(1);
	}
}

nowEchoString_v1();
echo '<hr />';
nowEchoString_v2();