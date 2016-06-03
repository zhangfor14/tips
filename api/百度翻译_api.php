<?php
/**
* 百度开发者中心：http://developer.baidu.com/
* 百度翻译API：http://developer.baidu.com/wiki/index.php?title=docs
*/
class baiduAPI{
	/**
	* $from : 源语言语种：语言
	* $to : 目标语言语种：语言代码或auto
	*/
	static public function fanyi($value, $from="auto", $to="auto")
	{
		$value_code=urlencode($value);
		#首先对要翻译的文字进行 urlencode 处理
		$appid="Ow83extUdl2zLm94s7ldkw5D";
		#您注册的API Key
		$languageurl = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=" . $appid ."&q=" .$value_code. "&from=".$from."&to=".$to;
		#生成翻译API的URL GET地址
		$text=json_decode(self::language_text($languageurl));
		$text = isset($text->trans_result) ? $text->trans_result : '';
		return isset($text[0]->dst) ? $text[0]->dst : '';
	}

	#获取目标URL所打印的内容
	static function language_text($url)
	{
		if(!function_exists('file_get_contents')) {
			$file_contents = file_get_contents($url);
		} else {
			$ch = curl_init();
			$timeout = 5;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
		}
		return $file_contents;
	}
}

/**
 * 实例1,中文翻译英文
 */
function cnToEn(){
	// 定义需要翻译的内容
	$title = '你好';

	// 验证是否为汉字 ( 兼容gb2312,utf-8 )
	if (preg_match("/[\x7f-\xff]/", $title)) {
	$title = baiduAPI::fanyi($title, $from="zh", $to="en");
	} else {
	$title = baiduAPI::fanyi($title, $from="en", $to="zh");
	$title = iconv('utf-8', 'gbk', $title);
	}

	// 结果输出 Hello
	echo $title;
	exit;
}
/**
 * 实例1,英文翻译中文
 */
function enToCn(){
	// 定义需要翻译的内容
	$title = 'Hello';

	// 验证是否为汉字 ( 兼容gb2312,utf-8 )
	if (preg_match("/[\x7f-\xff]/", $title)) {
	$title = baiduAPI::fanyi($title, $from="zh", $to="en");
	} else {
	$title = baiduAPI::fanyi($title, $from="en", $to="zh");
	$title = iconv('utf-8', 'gbk', $title);
	}

	// 结果输出 您好
	echo $title;
	exit;
}
cnToEn();