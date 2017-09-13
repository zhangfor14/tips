<?php
<div class="am-form-group">
    <label for="user-name" class="am-u-sm-3 am-form-label">上传背景图片</label>
    <div class="am-u-sm-9">
        <input type="file" class="upload"  name="largePicture">
        <input type="hidden" name="largePicture" id="largePicture" value="">
        <div index-name='largePicture'></div>
    </div>
</div>




//ajax上传文件
var uploading = false;
$('.upload').on('change',function(){
    var filename=$(this).attr('name');
    $('#filename').val(filename);
    if(uploading){
        alert("文件正在上传中，请稍候");
        return false;
    }
    $.ajax({
        url: "{:U('ajax_uploadFile')}",
        type: 'POST',
        cache: false,
        data: new FormData($('form')[0]),
        processData: false,
        contentType: false,
        dataType:"json",
        beforeSend: function(){
            uploading = true;
        },
        success : function(return_data) {
            $('#'+filename).val(return_data.savepath);
            $('div[index-name='+filename+']').html('<img style="height:100px;" src="'+return_data.showpath+'" alt="">');

            uploading = false;
        }
    });
});


$upload_data=upload_one($filename,'D:/www/web','/Uploads/live/'.date('Y-m-d'));//本地



/**
 * [upload_one 上传图片并生成缩略图]
 * @param  [type] $fileName [description]
 * @param  [type] $dirName  [description]
 * @return [type]           [description]
 */
function upload_one($fileName, $rootPath='' ,$dirName=''){
    // 上传文件
    if(isset($_FILES[$fileName]) && $_FILES[$fileName]['error'] == 0){
        if(!is_dir($rootPath)){
            $res=mkdir($rootPath,0777,true);
        }
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 31457280;// 设置附件上传大小,设置为30m
        $upload->exts = array('jpg','png','jpeg','gif'); //允许上传的文件后缀
        $upload->rootPath = $rootPath; // 设置附件上传根目录
        $upload->savePath = $dirName . '/'; // 图片二级目录的名称
        $name=explode('.',$_FILES[$fileName]['name']);
        // $upload->saveName = $name[0].'_'.date('His'); // 图片二级目录的名称
        $upload->saveName = date('YmdHis').'_'.rand(11111,99999); // 图片二级目录的名称
        // 上传时指定一个要上传的文件的名称
        $info   =   $upload->upload();
        if(!$info){
            return array(
                'ok' => 0,
                'error' => $upload->getError(),
            );
        }else{
            $info['ok'] = 1;
            $info['savepath'] = $info[$fileName]['savepath'] . $info[$fileName]['savename'];
            return $info;
        }
    }
}