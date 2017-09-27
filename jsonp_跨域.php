<?php
function ajaxReturns($data,$type='') {
    if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');
    switch (strtoupper($type)){
        case 'JSON' :
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode($data));
        case 'XML'  :
            // 返回xml格式数据
            header('Content-Type:text/xml; charset=utf-8');
            exit(xml_encode($data));
        case 'JSONP':
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            $handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
            exit($handler.'('.json_encode($data).');');
        case 'EVAL' :
            // 返回可执行的js脚本
            header('Content-Type:text/html; charset=utf-8');
            exit($data);
        default     :
            // 用于扩展其他返回格式数据
            Hook::listen('ajax_return',$data);
    }
}

ajaxReturns(['code'=>3, 'msg'=>'图文验证码不能为空'],'jsonp');

//发送验证码
	$('.mobile-code').click(function(){
	var verify_code = $('#imgVerification').val();
	var mobile = $('#userMobile').val();
	console.log(verify_code);
	console.log(mobile);

	// 发送ajax请求短信验证码
	$.ajax({
		url:SERVERNAME+"/Meeting/sendMessage",
		type:'post',
		data:{
			mobile:mobile,
			verify_code :verify_code
		},
		dataType:'jsonp',
		jsonp: 'callback',
		jsonpCallback:"success_jsonpCallback",
	    async: false,
		success:function(res) {
			console.log(res);
			if(res.code == 1){
				var msgcode=res.msgcode;//手机验证码
			} else if(res.code == 2){
				alert("您的请求过于频繁，请稍候再试。");
				fGetCode();
			} else if(res.code == 3){
				alert("图文验证码不能为空");
			} else if(res.code == 4){
				alert("图文验证码不能正确");
				fGetCode();
			} else if(res.code == 5){
				alert("不是个手机号");
				fGetCode();
			}  else{
				alert("发送失败");
				fGetCode();;
			}
		},
		error:function(xhr,response,status) {
			alert('请求失败，请重试');
			fGetCode();
		}
	});
});