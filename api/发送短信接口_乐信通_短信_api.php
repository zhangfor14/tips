<?php

/**
 * 〈发送短信:乐信通〉
 * @param [参数1]     [参数1说明]
 * @param [参数2]     [参数2说明]
 * @return[返回类型说明]
 */
function send_lmobile($num, $tamplate) {
    $url_info = parse_url("http://cf.51welink.com/submitdata/Service.asmx/g_Submit");
    $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
    $httpheader .= "Host:" . $url_info['host'] . "\r\n";
    $httpheader .= "Content-Type:application/x-www-form-urlencoded\r\n";
    $httpheader .= "Content-Length:" . strlen("sname=dlbjrsjy&spwd=ruth2017bai20170702&scorpid=&sprdid=1012818&sdst=$num&smsg=".rawurlencode($tamplate)) . "\r\n";
    $httpheader .= "Connection:close\r\n\r\n";
    //$httpheader .= "Connection:Keep-Alive\r\n\r\n";
    $httpheader .= "sname=dlbjrsjy&spwd=ruth2017bai20170702&scorpid=&sprdid=1012818&sdst=$num&smsg=".rawurlencode($tamplate);

    $fd = fsockopen($url_info['host'], 80);
    fwrite($fd, $httpheader);
    $gets = "";
    while(!feof($fd)) {
        $gets .= fread($fd, 128);
    }
    fclose($fd);
    if($gets != ''){
        $start = strpos($gets, '<?xml');
        if($start > 0) {
            $gets = substr($gets, $start);
        }        
    }
    // 取出状态值:$match[1] === '0' 为发送成功
    preg_match('/<State>(\d+)<\/State>/', $gets,$match);
    return $match[1];
}

/*
 * 发送短信功能
 */
function send_sms($mobile, $message, $needstatus = 'false', $product = '', $extno = '') {

//    define('SMS_SEND_URL', "http://222.73.117.156/msg/HttpBatchSendSM");
//    define('SMS_API_USER', "ruthout");
//    define('SMS_API_PASS', "Metoo123456");
    $post_data = array(
        'account' => "ruthout",
        'pswd' => "Ruthout5235",
        'msg' => $message,
        'mobile' => $mobile,
        'needstatus' => $needstatus,
        'product' => $product,
        'extno' => $extno
    );

    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_URL, "http://222.73.117.156/msg/HttpBatchSendSM");
    curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    $result = curl_exec($ch);
    curl_close ($ch);

    $result=preg_split("/[,\r\n]/", $result);
    return $result;
}