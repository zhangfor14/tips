<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="input">
		<!-- <form action="/admin.php/IndexRecommend/online_send" method="post" enctype="multipart/form-data"> -->
			<input type='hidden' name='textfield' id='textfield' class='txt' />
			<a href="javascript:;" class="filea">发送图片<input type="file" value="添加图片" class="file" name="myfile" id="file"></a>
			<!-- <img src="/Public/admin/img/qq/ee_1.png" alt=""> -->
			<!-- <input type="hidden" value="" name='file_1' id="upload1" /> -->
			<textarea name="" id="" cols="30" rows="10" class="content"></textarea>
			<p class="send">发送</p>
			<!-- <input type="submit" class="send" value="发送"> -->
			<div class="hidden"></div>
		<!-- </form> -->

	            <!-- <span onclick="file.click()" class="mybtn">浏览...</span>   -->
	            <!-- <input type="file" name="file" class="file" id="file" size="28" onchange="document.getElementById('textfield').value=this.value" />   -->
	            <!-- <span onclick="UpladFile()" class="mybtn">上传</span>   -->
	</div>
</body>
</html>
<script>
	$('.file').on('change',function(){
    if(uploading){
        alert("文件正在上传中，请稍候");
        return false;
    }
    alert("文件正在上传中,上传完毕会提醒您,请等待");
    //表单数据
    var form = new FormData();
    // var fileObj = document.getElementById("file").files[0];
    var fileObj = $('#file')[0].files[0];
    form.append("myfile", fileObj);
    console.log(form);
    $.ajax({
        url: "{:U('ajax_uploadimg')}",
        type: 'POST',
        cache: false,
        data: form,
        processData: false,
        contentType: false,
        dataType:"json",
        beforeSend: function(){
            uploading = true;
        },
        success : function(return_data) {
            console.log(return_data);
            if(return_data){
            	$.cookie('fileimg',return_data.savepath);
            	var user_id=$.cookie('user_id');
				var answerBody=$('.content').val();
				var message_id=$('.talkid').val();
				var type=$.cookie('type');
				var answerPicture=$('.file').val();
				var kefuid=$.cookie('kefuid');
            	$.ajax({
					// url:'http://server.ruthout.com/?mod=customService&act=replyMessage',
					url:"{:U('replyMessage')}",
					type:'post',
					data:{
						'user_id':user_id,
						'answerPicture' : $.cookie('fileimg'),
						'message_id' : message_id,
					          'type' : type
						// 'answerPicture':answerPicture
					},
					success:function(data){
						// console.log(data);
						// $('#file').val(" ");
						showtalk($.cookie('talkid'),type);

					},
					error:function(xhr,response,status){
						console.log(xhr);
						console.log(response);
						console.log(status);
					}
	            });
                alert('上传成功');
            }else{
                alert('上传失败');
            }
            uploading = false;
        },
        error : function(error) {
        	console.log(error);
        }
    });
});
</script>