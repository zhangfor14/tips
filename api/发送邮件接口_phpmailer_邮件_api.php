<?php

//发送邮件通知客服
public function sendMailToService($emailtitle,$emailbody){
	$email = 'zhoudong@ruthout.com';
	$emailbody = $emailtitle."申请提现金额：".$emailbody['money'].
				 "，账号类型：".$emailbody['type'].
				 ",账号名:".$emailbody['account_name'].
				 "账号:".$emailbody['account_num'].
				 "（注：请于后台提现内进行处理，填写处理记录信息）";
	sendMail($email, $emailtitle, $emailbody);
}
/**
 * 邮件发送函数
 */
function sendMail($to, $emailtitle, $emailbody) {

    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer(); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->AddAddress($to,"尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject =$emailtitle; //邮件主题
    $mail->Body = $emailbody; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

	// 配置邮件发送服务器
	'MAIL_HOST' =>'smtp.163.com',//'smtp.vip.163.com',//smtp服务器的名称
	'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
	'MAIL_USERNAME' =>'ruthout@163.com',//'ruthout@vip.163.com',//你的邮箱名
	'MAIL_FROM' =>'ruthout@163.com',//'ruthout@vip.163.com',//发件人地址
	'MAIL_FROMNAME'=>'儒斯HR',//发件人姓名
	'MAIL_PASSWORD' =>'Ruthout123123',//'rusi1001',//邮箱密码
	'MAIL_CHARSET' =>'utf-8',//设置邮件编码
	'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件