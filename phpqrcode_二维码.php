<?php
/**
 * [getPhpQRCode 生成二维码]
 * @param [type]   $data 		 [数据来源;结构:array('content'=$content,'filename'=>$filename)]
 * @param [string] $[content] 	 [二维码内容]
 * @param [string] $[filename] 	 [生成二维码的路径和文件名]
 * @param [string] $[errorLevel] [二维码容错率L(7%)，M(15%)，Q(25%)，H(30%)]
 * @param [string] $[size] 		 [生成图片大小，默认为4]
 * @param [string] $[margin] 	 [二维码的空白区域大小]
 * @return [type]       		 [包含保存路径的二维数组]
 */
function getPhpQRCode($data){
	//加载phpqrcode类包
    Vendor('ZZY.phpqrcode.phpqrcode');
    //实例化QRcode类
    $QRcode = new \QRcode();
    //保存已经生成的二维码
    $errorLevel = "L";
    $size = "6";
    $margin="1";
    $savedirs=array();
    foreach ($data as $key => $value) {
        $QRcode::png($value['content'],$value['filename'],$errorLevel,$size,$margin);
        $savedirs[]=$value['filename'];
    }
    return $savedirs;
}