<?php
	//未进首页或没有得到openid时的授权，生成海报 (此步骤为单纯的获取用户信息给前端，前端拿到后生成海报)
	public function hbAuth()
	{
		$appid = 'wxf489e68d07315c8f';
		$from = $_GET['from'];
		header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=http://www.ruthout.com/index.php/WapCourse/hbwx&response_type=code&scope=snsapi_userinfo&state=' . $from . '&w=$from&expert_id=$expert_id#wechat_redirect');

	}


	//微信回调获取用户信息
	public function hbwx()
	{
		$code = $_GET['code'];
		$from = $_GET['state']; //从哪来，回调返回给前端
		$appid = 'wxf489e68d07315c8f';
		$appsecret = 'e66f35b794e0e481fa2c78d02f807e8f';


		if (empty($code)) $this->error('授权失败');
		$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
		$token = json_decode(file_get_contents($token_url));
		if (isset($token->errcode)) {
			echo '<h1>错误：</h1>' . $token->errcode;
			echo '<br/><h2>错误信息：</h2>' . $token->errmsg;
			exit;
		}
		$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=' . $appid . '&grant_type=refresh_token&refresh_token=' . $token->refresh_token;
		//转成对象
		$access_token = json_decode(file_get_contents($access_token_url));
		if (isset($access_token->errcode)) {
			echo '<h1>错误：</h1>' . $access_token->errcode;
			echo '<br/><h2>错误信息：</h2>' . $access_token->errmsg;
			exit;
		}
		$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token->access_token . '&openid=' . $access_token->openid . '&lang=zh_CN';
		//转成对象
		$user_info = json_decode(file_get_contents($user_info_url));
		if (isset($user_info->errcode)) {
			echo '<h1>错误：</h1>' . $user_info->errcode;
			echo '<br/><h2>错误信息：</h2>' . $user_info->errmsg;
			exit;
		}
		//打印用户信息
		//echo '<pre>';
		//print_r($user_info);
		//echo '</pre>';

		//对象转数组
		$re_user_info = $this->object_to_array($user_info);
		$openid = $re_user_info['openid'];
		$nickname = $re_user_info['nickname'];
		$sex = $re_user_info['sex'];
		$language = $re_user_info['language'];
		$city = $re_user_info['city'];
		$province = $re_user_info['province'];
		$country = $re_user_info['country'];
		$headimgurl = $re_user_info['headimgurl'];


		$re_nickname = $re_user_info['nickname'];// urlencode(); source=$state

		//header('location:http://wap.ruthout.com/sign1_hb.html?nickname=' . $re_nickname . "&openid=" . $re_user_info['openid'] . "&pic=" . $re_user_info['headimgurl'] . "&sex=" . $sex . "&source=" . $from . "&time=" . time());
		$this->assign('current_wxuser_info', $re_user_info);
		$this->assign('course_id', $from);
		$this->display('wap/distribution/hb_detal');
	}