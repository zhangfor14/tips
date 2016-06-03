<!--富文本编辑器-->
<link href="__PUBLIC__/Admin/css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="__PUBLIC__/Admin/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	
	<form action="">
		<div class="form-group">
	        <label class="col-sm-2 control-label">隔离区</label>
	        <div class="col-md-8">
	            <div class="summernote">
	            </div>
	        </div>
	    </div>
	</form>

<!-- SUMMERNOTE富文本编辑框 -->
<script src="__PUBLIC__/Admin/js/plugins/summernote/summernote.min.js"></script>
<script src="__PUBLIC__/Admin/js/plugins/summernote/summernote-zh-CN.js"></script>

<script>
        //上传文件
        function sendFile(file,editor,$editable){
            // console.log("file="+file);  
            // console.log("editor="+editor);  
            // console.log("welEditable="+welEditable);
            // var filename = false;
            // try{  
                // filename = file["name"];  
                // alert(filename);  
            // } catch(e){filename = false;}  
            // if(!filename){$(".note-alarm").remove();}  
            //以上防止在图片在编辑器内拖拽引发第二次上传导致的提示错误
            // var ext = filename.substr(filename.lastIndexOf("."));
            // ext = ext.toUpperCase();
            // var timestamp = new Date().getTime();
            // var name = timestamp+"_"+$("#summernote").attr('aid')+ext;
            //name是文件名，自己随意定义，aid是我自己增加的属性用于区分文件用户
            data = new FormData();
            data.append("file", file);
            // data.append("key",name);
            // data.append("token",$("#summernote").attr('token'));
            $.ajax({
                data: formData,  
                type: "POST",  
                url: "{:U('Admin/Field/uploadPicture')}",
                cache: false,  
                contentType: false,  
                processData: false,  
                success: function(imageUrl) { 
                    // console.log(imageUrl);将返回的图片路径(http模式)保存至文本框
                    editor.insertImage($editable, imageUrl);  
                    // $('.summernote').summernote('editor.insertImage',imageUrl); 
                    // $(".note-alarm").html("上传成功,请等待加载");  
                    // setTimeout(function(){$(".note-alarm").remove();},3000);
                },
                 
                error: function() {  
                    // $(".note-alarm").html("上传失败");  
                    // setTimeout(function(){$(".note-alarm").remove();},3000);
                }  
            })
        }

        $(document).ready(function () {
            //初始化富文本编辑器
            $('.summernote').summernote({
                lang: 'zh-CN',
                height: 400,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false,                // 自动获得焦点
                onImageUpload: function(files, editor, $editable) {
                    sendFile(files,editor,$editable);
                },
            });
            //提交 表单
            $('#submit').click(function(){
                //取值
                var field_gps = $('.summernote').code();
                //同一页面多个summernote时，取第二个的值
                var field_barrier = $('.summernote').eq(1).code();
                //赋值
                $('.field_gps').html(field_gps);
                $('.field_barrier').html(field_barrier);
                $("form").submit();
            });
        });

</script>

<?php
// php端处理
function uploadPicture(){
    $img=upload_one('file','Temp');
    $imageUrl='http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/Public/Uploads/'.$img['images'][0];
    echo $imageUrl;
}

