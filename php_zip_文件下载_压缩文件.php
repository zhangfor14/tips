<?php

/**
 * [downloadZip 下载文件]
 * @param  [type]  $savedirs    [要下载的文件路径,二维数组]
 * @param  string  $outfile     [压缩包保存地址]
 * @param  boolean $is_del_dirs [是否删除$savedirs内地址对应文件,默认是]
 * @param  boolean $is_del_zip  [是否删除压缩包文件,默认是]
 * @return [type]               [description]
 */
function downloadZip($savedirs,$outfile='',$is_del_dirs=TRUE,$is_del_zip=TRUE){
	//要下载的文件地址为空,则返回false
	if(empty($savedirs)){
		return FALSE;
	}
	//$savedirs 成员数为1则压缩打包下载,否则单个文件下载
	if(count($savedirs) == 1 ){
		$filename = $savedirs[0];
		$type='image/png';
	}else{
			//打包文件的保存地址为空
			$outfile= empty($outfile) ? '.'.UPLOAD_PATH : $outfile ;
			$filename = $outfile.'/'.date ( 'Y_m_d_H_i_s' ).".zip"; // 最终生成的文件名（含路径）
	        // 生成文件
	        $zip = new \ZipArchive(); // 使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
	        if ($zip->open ( $filename, \ZIPARCHIVE::CREATE ) !== TRUE) {
	            exit ( '无法打开文件，或者文件创建失败' );
	        }
	        //$savedirs 就是一个存储文件路径的数组 比如 array('/a/1.jpg,/a/2.jpg....');
	        foreach ( $savedirs as $val ) {
	        	//第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下
	            $zip->addFile($val,basename($val)); //iconv("UTF-8","GB2312//IGNORE",basename($val))
	        }
	        $zip->close (); // 关闭
	        //删除文件
	        if($is_del_dirs){
		        foreach ( $savedirs as $val ) {
		            unlink($val);
		        }
		    }
		    $type='application/zip';// zip格式的]
	}
    //下面是输出下载;
    header ( "Cache-Control: max-age=0" );
    header ( "Content-Description: File Transfer" );
    header ( 'Content-disposition: attachment; filename=' . basename ( $filename ) ); // 文件名
    header ( "Content-Type: ".$type ); //告诉浏览器是什么格式的
    header ( "Content-Transfer-Encoding: binary" ); // 告诉浏览器，这是二进制文件
    header ( 'Content-Length: ' . filesize ( $filename ) ); // 告诉浏览器，文件大小
    @readfile ( $filename );//输出文件;
    //删除打包文件
    if($is_del_zip){
    	unlink($filename);
    }
    return TRUE;
}