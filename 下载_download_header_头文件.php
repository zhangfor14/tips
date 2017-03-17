<?php

/**
 * 1
 */
header("Content-type:text/html;charset=utf-8")	//在服务器响应浏览器的请求时，告诉浏览器以编码格式为UTF-8的编码显示该内容 
Header("Content-type: application/octet-stream")	//通过这句代码客户端浏览器就能知道服务端返回的文件形式;发送指定文件MIME类型的头信息
Header("Accept-Ranges: bytes")	//告诉客户端浏览器返回的文件大小是按照字节进行计算的 
Header("Accept-Length:".$file_size)	//告诉浏览器返回的文件大小 
Header("Content-Disposition: attachment; filename=".$file_name)	//告诉浏览器返回的文件的名称 
fclose($fp)	//可以把缓冲区内最后剩余的数据输出到磁盘文件中，并释放文件指针和有关的缓冲区 
//关于file_exists()函数不支持中文路径的问题:因为php函数比较早，不支持中文，所以如果被下载的文件名是中文的话，需要对其进行字符编码转换，否则file_exists()函数不能识别，可以使用iconv()函数进行编码转换 

/**
 * 2
 */
$filename = date('Ymd_His').'.csv';
header("Content-type:text/csv");   
header("Content-Disposition:attachment;filename=".$filename);   
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public');   
echo $str;exit;  

/**
 * 3
 */
header ( "Cache-Control: max-age=0" );
header ( "Content-Description: File Transfer" );
header ( 'Content-disposition: attachment; filename=' . basename ( $filename ) ); // 文件名
header ( "Content-Type: ".$type ); //告诉浏览器是什么格式的;
header ( "Content-Transfer-Encoding: binary" ); // 告诉浏览器，这是二进制文件
header ( 'Content-Length: ' . filesize ( $filename ) ); // 告诉浏览器，文件大小
@readfile ( $filename );//输出文件;

/**
 * 4
 */
$filename = $starttime.'到'.$endtime.'小时气象数据.csv';
header("Content-type:application/vnd.ms-excel");   
header("Content-Disposition:attachment;filename=".$filename);   
header('Cache-Control:max-age=0');
$fp=fopen('php://output','a');//打开文件句柄,直接输出到浏览器
$head=explode(',',$field);//输出excel列名信息
fputcsv($fp,$head);//将数据通过fputcsv写到句柄中
fclose($fp);//关闭文件句柄
exit();