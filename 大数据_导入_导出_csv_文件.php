<?php

/**
 * tips:导出大数据csv的关键是:
 * ob_flush(); //把数据从PHP的缓冲中释放出来
 * flush();    //把不在缓冲中的或者被释放出来的数据发送到浏览器,刷新buffer
 */

/**
 * 1.[setCsv 导出csv并下载,大数据量友好因为分批从内容读取数据]
 */
function setCsv(){
    //准备输出内容
    $filename = $starttime.'到'.$endtime.'小时气象数据.csv';
    header("Content-type:application/vnd.ms-excel");   
    header("Content-Disposition:attachment;filename=".$filename);   
    header('Cache-Control:max-age=0');
    //构造文件句柄
    $fp=fopen('php://output','a');//打开文件句柄,直接输出到浏览器
    $head=explode(',',$field);//输出excel列名信息
    fputcsv($fp,$head);//将数据通过fputcsv写到句柄中
    ob_flush(); //把数据从PHP的缓冲中释放出来
    flush();    //把不在缓冲中的或者被释放出来的数据发送到浏览器,刷新buffer
    $count=S('count_hour_'.$starttime.$endtime);//总记录数
    //sql查询数据
    for ($firstRow=0; $firstRow < $count; $firstRow+=10000) { 
        // $sql="SELECT {$field} FROM gridhourmeteo WHERE ObsCreateDateTime BETWEEN '{$starttime}' AND '{$endtime}'";
        $sql="SELECT t1.{$field} FROM gridhourmeteo t1 ,(SELECT ID FROM gridhourmeteo WHERE ObsCreateDateTime BETWEEN '{$starttime}' AND '{$endtime}' LIMIT {$firstRow},10000) t2 WHERE t1.ID=t2.ID";
        $listData=M()->query($sql);
        foreach ($listData as $key => $value) {
            $value['obscreatedatetime']='’'.$value['obscreatedatetime'];
            fputcsv($fp,$value);
        }
        ob_flush(); //把数据从PHP的缓冲中释放出来
        flush();    //把不在缓冲中的或者被释放出来的数据发送到浏览器,刷新buffer
    }
    fclose($fp);//关闭文件句柄
    exit();
}
/**
 * 2.[_getCsv 导出csv并下载,从内存中一次导出,数据量太大不太友好]
 * @param  [type] $data  [数据来源]
 * @param  [type] $field [表头]
 * @return [type]        [description]
 */
public function _getCsv($data,$field){
    $str=$field."\n";
    $field=explode(',',$field);
    foreach ($data as $key => $value) {
        foreach ($field as $k => $v) {
            if($v == 'ObsCreateDateTime'){
                $str.='’'.$value[strtolower($v)].',';
                continue;
            }
            $str.=$value[strtolower($v)].',';
        }
        $str=substr($str,0,-1)."\n";
    }
    $filename = date('Ymd_His').'.csv';
    header("Content-type:text/csv");   
    header("Content-Disposition:attachment;filename=".$filename);   
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
    header('Expires:0');   
    header('Pragma:public');   
    echo $str;exit;   
}



/**
 * 3.[getCsv 读取csv文件]
 * @return [type] [description]
 */
public function getCsv(){
    $filePath='.'.PUBLIC_PATH.'duqu.xlsx';
    $filePath='C:\Users\Dy\Desktop\1111.xls';
    $filePath='C:\Users\Dy\Desktop\111.csv';
    if(empty($filePath) or !file_exists($filePath)){
        exit('file not exists');
    }
    $file = fopen($filePath, 'r');
    while($data = fgetcsv($file)){
        dump($data);
    }
    fclose($file);
}