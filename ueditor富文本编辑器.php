官方文档地址:http://fex.baidu.com/ueditor/
详解:ueditor1_4_3_2-utf8-php.zip
前端配置文件:ueditor.config.js
后端配置文件:php/config.json

<div class="form-group">
    <label class="col-sm-2 control-label">地下</label>
    <div class="col-md-8">
        <script id="protection_underground" name="protection_underground" type="text/plain"></script>
        <span class="help-block m-b-none"></span>
    </div>
</div>

<!-- 编辑器源配置文件 -->
<script type="text/javascript" src="__PUBLIC__/Admin/ueditor_utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="__PUBLIC__/Admin/ueditor_utf8-php/ueditor.all.js"></script>

<script>
	//实例化编辑器
    var protection_underground=UE.getEditor('protection_underground',{
        initialFrameHeight:200,//初始化时的高度
        readonly:true,		//是否只读
    });
</script>

修改后端配置文件: php/config.json
1."imageMaxSize": 2048000, /* 上传大小限制，单位B */
2."imagePathFormat": "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",/* 上传保存路径,可以自定义保存路径和文件名格式 */
3.UEditor插入图片尺寸自动适应编辑框大小:\ueditor\themes\iframe.css 中写入横线内的代码:
<style type="text/css">
———————————-
img {
max-width: 100%; /*图片自适应宽度*/
}
body {
overflow-y: scroll !important;
}
.view {
word-break: break-all;
}
.vote_area {
display: block;
}
.vote_iframe {
background-color: transparent;
border: 0 none;
height: 100%;
}
#edui1_imagescale{display:none !important;} /*去除点击图片后出现的拉伸边框*/
————————————
</style>
tips:
1.注意修改php.ini上传大小限制:upload_max_filesize大小

/*****************************************************************************/

<!-- php内代码 -->
<?php
/**
 * [更新时先将库中存在但,新保存的字段中不存在的url删除,并将url地址下的文件也删除]
 * @var [type]
 */
$listData=get_data_by_tablecache('protection','protection_id',$option['where']['protection_id']);
//删除旧图片
delete_urls($data,$listData[0],'protection_underground,protection_seedlingstage,protection_tyfon,protection_florescence,protection_milkripeness,protection_autumn,protection_question_and_suggest');
/**
 * [插入时将图片从临时目录挪至正式目录并将保存字段中的url也更新]
 * @var [type]
 */
$data=change_urls($data,'protection_underground,protection_seedlingstage,protection_tyfon,protection_florescence,protection_milkripeness,protection_autumn,protection_question_and_suggest');
/**
 * 插入完成或更新完成后,将字段中的url保存至表中
 */
D('editer')->editer_insert('protection',$data,'protection_underground,protection_seedlingstage,protection_tyfon,protection_florescence,protection_milkripeness,protection_autumn,protection_question_and_suggest',TRUE);
//过滤html代码,只显示文字
foreach ($listData as $key => $value) {
	//将htnl实体字符转换成html标签
    $list=array_map('htmlspecialchars_decode', $value);
    //去除所有html标签,不包括<p></p>
    $listData[$key]=array_map('strip_tags', $list);
}


/****************函数库中相关代码*************************************************************/

/**
 * [make_thumb 制作某个图片的缩略图]
 * @param  [type] $imgpath  [要制作缩略图的文件路径,包含文件名的完整路径:/或\打头]
 * @param  [type] $savepath [保存缩略图的文件夹,包含文件名的完整路径:/或\打头]
 * @param  array  $thumb    [缩略图的分辨率数组,默认1920,1080]
 * @return [type]           [缩略图的完整路径]
 * 
		$imgpath='/Public/Uploads/Temp/Images/20160518/1463564284120002.jpg';
		$savepath='/Public/Uploads/Temp/Images/20160518/suoluetu/1463564284120002.jpg';
		make_thumb($imgpath,$thumb = array(1920,1080),$savepath);
 */
function make_thumb($imgpath,$savepath,$thumb = array(1920,1080)){
	//原图不存在,则返回
	if(!file_exists('.'.$imgpath)){
		return FALSE;
	}
	$image = new \Think\Image();
	//$savepath,父目录不存在,则创建
	$file=substr($savepath,0,strrpos($savepath,'/'));
	//判断路径是否存在,不存在则创建
	if(!is_dir('.'.$file)){
		mkdir('.'.$file,0777,true);
	}
	//拼接含文件名的,截取/或\后面的文件名称,连接到要保存文件夹路径后面,使$savepath成为完整路劲
	$basename=basename($savepath);
	$dirname=dirname($savepath);
	$savepath=$dirname.'/thumb_'.$thumb[0].'_'.$thumb[1].'_'.$basename;
	// dump($savepath);exit;
	// 打开要处理的图片
    $image->open('.'.$imgpath);
    //制作并保存缩略图
    $image->thumb($thumb[0], $thumb[1])->save('.'.$savepath);

    return $savepath;
}
/**
 * [get_url 查找字符串中的所有上传的地址]
 * @param  [type] $string [description]
 * @return [type]         [description]
 */
function get_url($string){
	$matches=array();
	$data=array();
	//<img src="">正则
	$pattern='/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/';
	preg_match_all($pattern,$string,$matches);
	foreach ($matches[1] as $key => $value) {
		if(strpos($value,'http://') == FALSE){
			//选取所有本地上传的图片路径,而不是网络图片
			$data[]=$value;
		}
	}
	return $data;
}
/**
 * [move_file 移动文件位置]
 * @param  [type] $oldfile    [旧目录]
 * @param  [type] $newFile [新目录]
 * @return [type]          [description]
 */
function move_file($oldfile,$newFile){
	//$newFile父目录不存在,则创建
	$file=substr($newFile,0,strrpos($newFile,'/'));
	if(!is_dir($file)){
		mkdir($file,0777,TRUE);
	}
	return rename($oldfile,$newFile); //拷贝到新目录
}
/**
 * [change_url 将字符串中旧url替换为新url]
 * @param  array   $field [要替换的字符串组成的数组]
 * @return [type]         [description]
 * $dataList=change_url(array('florescence_question_and_suggest'=>$data['florescence_question_and_suggest']));
 */
function change_url($field = array()){
	$data=array();
	//循环并获得每个要替换的字符串
	foreach ($field as $key => $value) {
		//获得字符串中所有图片地址
		$imgs=get_url(htmlspecialchars_decode($value));
		foreach ($imgs as $olddir) {
			//如果在URl中可以找到/Public/Uploads/Editer/ 和 thumb ,但找不到 Temp 说明已经在正式目录了不用再移动和生成缩略图
            if(strpos($olddir,'/Public/Uploads/Editer/') !== FALSE && strpos($olddir,'Temp') === FALSE && strpos($olddir,'thumb')!== FALSE){
            	continue;
            }
            //移动图片位置
            $dir=is_numeric($key) ? '' : $key;
            $newdir=str_replace('Temp','Editer/'.$dir,$olddir);
            //制作缩略图并保存到指定位置,make_thumb($olddir,$newdir,array(1920,1080));
            $result=make_thumb($olddir,$newdir);
            // dump($result);exit;
            //移动成功则替换url
            if($result){
            	//删除原图
            	del_file('.'.$olddir);
	            //替换字符串中的url
	            $value=str_replace($olddir,$result,$value);
	        }
        }
        $data[$key]=$value;
	}
	return $data;
}
// function change_url($field = array()){
// 	$data=array();
// 	//循环并获得每个要替换的字符串
// 	foreach ($field as $key => $value) {
// 		//获得字符串中所有图片地址
// 		$imgs=get_url(htmlspecialchars_decode($value));
// 		foreach ($imgs as $olddir) {
//             //移动图片位置
//             $dir=is_numeric($key) ? '' : $key;
//             $newdir=str_replace('Temp','Editer/'.$dir,$olddir);
//             $result=move_file('.'.$olddir,'.'.$newdir);
//             //移动成功则替换url
//             if($result){
// 	            //替换字符串中的url
// 	            $value=str_replace($olddir,$newdir,$value);
// 		// dump($value);exit;
// 	        }
//         }
//         $data[$key]=$value;
// 	}
// 	return $data;
// }
/**
 * [change_urls 将数组的某些字段内容中旧url替换为新url]
 * @param  array  $data   [要处理的数组]
 * @param  string $str    [包含字段的字符串]
 * @param  string $is_del [是否删除旧内容]
 * @return [type]         [description]
 * 
 * $editer_field=array(
                'protection_underground'            =>  $data['protection_underground'],
            );
    $dataList=change_url($editer_field);
    $data['protection_underground']=$dataList['protection_underground'];

    简化为,$data=change_urls($data,'protection_underground');
 */
function change_urls($data=array(),$str='',$is_del=FALSE){
	//判断是否要删除旧图片
	if($is_del){

	}
	//获得字段数组
	$fields=explode(',', $str);
	$editer_field=array();
	//
	foreach ($fields as $key => $field) {
		if($data[$field]){
			$editer_field[$field]=$data[$field];
		}
	}
	// dump($editer_field);exit;
	$changed_data=change_url($editer_field);
	foreach ($changed_data as $key => $field) {
		$data[$key]=$field;
	}
	return $data;
}
/**
 * [delete_urls 大量调用delete_url的简化函数]
 * @param  [type] $data     [新数据]
 * @param  [type] $listData [旧数据]
 * @param  string $str      [字段组合成的字符串]
 * @return [type]           [匹配新数据中某字段和旧数据某字段中的内容中的url是否存在,不存在则删除url所代表的图片]
 *  delete_url($data['protection_field_board'],$field['protection_field_board']);
    delete_url($data['protection_question_and_suggest'],$field['protection_question_and_suggest']);
    简写为
    delete_urls($data,$field,'protection_question_and_suggest,protection_field_board');
 */
function delete_urls($data,$listData,$str=''){
	// dump($listData);exit;
	$fields=explode(',', $str);
	foreach ($fields as $key => $field) {
		delete_url($data[$field],$listData[$field]);
	}
}
/**
 * [delete_url 检查oldstr字符串中url是否于newstr中,以确定是否被删除,是则删除字符串中url所指向的img]
 * @param  [type] $newstr [description]
 * @param  [type] $oldstr [description]
 * @return [type]         [description]
 */
function delete_url($newstr,$oldstr){
	$oldstr=htmlspecialchars_decode($oldstr);
	$newstr=htmlspecialchars_decode($newstr);
	//获取就字符串中img
	$oldImg=get_url($oldstr);
		// dump($newstr);exit;
	foreach ($oldImg as $key => $value) {
		//检查字符串中src是否被删除,是则删除字符串中src所指向的img
		if(strpos($newstr, $value) ==FALSE){
			unlink('.'.$value);
		}
	}
	return TRUE;
}
