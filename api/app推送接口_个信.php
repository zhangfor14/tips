<?
function pushMessageToSingle($cid, $message_type, $message_id, $message_content){
	require_once(PHP_ROOT_PATH . '/lib/push/' . 'IGt.Push.php');
	require_once(PHP_ROOT_PATH . '/lib/push/' . 'igetui/IGt.AppMessage.php');
	require_once(PHP_ROOT_PATH . '/lib/push/' . 'igetui/IGt.APNPayload.php');
	require_once(PHP_ROOT_PATH . '/lib/push/' . 'igetui/template/IGt.BaseTemplate.php');
	require_once(PHP_ROOT_PATH . '/lib/push/' . 'igetui/template/IGt.TransmissionTemplate.php');
	require_once(PHP_ROOT_PATH . '/lib/push/' . 'IGt.Batch.php');
	require_once(PHP_ROOT_PATH . '/lib/push/' . 'igetui/utils/AppConditions.php');

	define('HOST','http://sdk.open.api.igexin.com/apiex.htm');
	define('APPKEY','Bb0VWAZ5fFAlLQY3c4c6K3');
	define('APPID','SRHCtNC4nK7pxce4IRP01A');
	define('MASTERSECRET','A20U2ayOjg7RqBsCZjNjT1');


//        define('APPKEY','67b9XnlDvGAgmoTDbae0T9');
//        define('APPID','rxMdbZdkj18SqjLo11Wbi8');
//        define('MASTERSECRET','TWbFZ2h9F86D96VF8bmOh1');


	//$this->pushMessageToApp();

	define('DEVICETOKEN','');
	define('Alias','请输入别名');

	$push_data = array(
			"title" => '儒思HR',
			"clientId" => $cid,
			"payload" => array(
					"messType" => $message_type,
					"messId" => $message_id,
					"content" => $message_content
			),
	);

	$igt = new IGeTui(HOST,APPKEY,MASTERSECRET);

	$template =  new IGtTransmissionTemplate();
	$template->set_appId(APPID);//应用appid
	$template->set_appkey(APPKEY);//应用appkey
	$template->set_transmissionType(2);
	$template->set_transmissionContent(json_encode($push_data));

	$apn = new IGtAPNPayload();
	$alertmsg=new SimpleAlertMsg();
	$alertmsg->alertMsg=$message_content;
	$apn->alertMsg=$alertmsg;
	$apn->badge=2;
	$apn->sound="";

	$apn->add_customMsg("payload",json_encode($push_data));
	//$apn->contentAvailable=1;
	$apn->category="ACTIONABLE";
	$template->set_apnInfo($apn);



	//var_dump(json_encode($push_data));exit;
	//$template->set_transmissionContent(json_encode($push_data));
	//$template->set_transmissionType(2);

	//个推信息体
	$message = new IGtSingleMessage();

	$message->set_isOffline(true);//是否离线
	//$message->set_offlineExpireTime(3600*12*1000);//离线时间
	$message->set_offlineExpireTime(500);//离线时间
	$message->set_data($template);//设置推送消息类型
//	$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
	//接收方
	$target = new IGtTarget();
	$target->set_appId(APPID);
	$target->set_clientId($cid);

	try {
		$rep = $igt->pushMessageToSingle($message, $target);
		//var_dump($rep);die();
	}catch(RequestException $e){
		$requstId =e.getRequestId();
		$rep = $igt->pushMessageToSingle($message, $target,$requstId);
		//var_dump($rep);die();
	}



	if (empty($rep['result']) || $rep['result'] != 'ok') {
		return false;
	} else {
		return true;
	}
}