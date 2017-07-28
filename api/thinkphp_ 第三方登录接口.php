<?php

/**
 * thinkphp 第三方登录接口 使用集成包(ThinkSDK-master)
 */
一.主要流程
	大体流程是首先开发者在第三方平台上注册一个应用。 
	一般你的域名空间要备过案的比较容易检核通过。然后获取到appid跟appkey。 
	然后再用你的key，调用第三方平台的接口。获取登录信息。 实现第三方的登录。
	如果自己网站本身有登录体系的话。可以在用户第一次用第三方登录的时候为用户创建本地账号。 
	用户可以修改自己的账号信息。

二.下载ThinkSDK
	地址:http://www.thinkphp.cn/extend/292.html
	github地址:https://github.com/Aoiujz/ThinkSDK

三.修改
	地址:http://blog.csdn.net/liusaint1992/article/details/50354154

{
	1.文件放置位置：

	thinkSDK放置的位置：ThinkPHP/Library/Org/ThinkSDK/。

	event文件夹放到模块下比如Admin模块下面。跟Controller文件夹同一个位置。

	2.命名空间与类的引入。实例化。


	（1）ThinkOauth.class.PHP:
	首先加上命名空间，以及sdk文件夹中的文件要用哪一个就加进来。比如这里我们要用QqSDK跟SinaSDK。
	namespace Org\ThinkSDK;
	use Org\ThinkSDK\sdk\QqSDK;
	use Org\ThinkSDK\sdk\SinaSDK;
	abstract class ThinkOauth{

	（2）TypeEvent.class.php:

	namespace Home\Event;//我是放在Home模块下的。
	class TypeEvent{
	然后，新版的thinkPHP类的调用方式也有所不同，在里面调用 thinkOauth的方法是这样：
	        原版：import("ORG.ThinkSDK.ThinkOauth");
	          $qq   = ThinkOauth::getInstance();

	修改为：        $qq = \Org\ThinkSDK\ThinkOauth::getInstance(); //加载ThinkOauth类并实例化一个对象

	（3）sdk目录下面的类。如QqSDK.class.php。
	原版：
	class QqSDK extends ThinkOauth{

	修改为：
	namespace Org\ThinkSDK\sdk;
	use Org\ThinkSDK;
	class QqSDK extends \Org\ThinkSDK\ThinkOauth{ 

	其他的也一样。


	3.ThinkOauth.class.php的一些修改。


	[php] view plain copy
	public function __construct($token = null){  
	       //设置SDK类型  
	    $class = get_class($this);  
	    $this->Type = strtoupper(substr($class, 0, strlen($class)-3));  
	  
	    //下面三句是我添加的。  
	    $typeArr = explode('\\',$this->Type);  
	    $typeLen = count($typeArr);  
	    $this->Type = $typeArr[$typeLen-1];  
	  
	               //获取应用配置  
	    $config = C("THINK_SDK_{$this->Type}");  
	    if(empty($config['APP_KEY']) || empty($config['APP_SECRET'])){  
	        E('请配置您申请的APP_KEY和APP_SECRET');  
	    } else {  
	        $this->AppKey    = $config['APP_KEY'];  
	        $this->AppSecret = $config['APP_SECRET'];  
	                       $this->Token     = $token; //设置获取到的TOKEN  
	       }  
	   }  

	[php] view plain copy
	public static function getInstance($type, $token = null) {  
	    $name = ucfirst(strtolower($type)) . 'SDK';  
	    $path="\Org\ThinkSDK\sdk\\$name";//注意这里与下面一句来实例化类的方式。  
	    return new $path($token);  
	}  

	4.一些在这里用起来不顺的函数修改。

	throw new Exception(）这个函数会报错。所有throw new Exception修改为E;用thinkphp的E方法处理错误。

	原版：throw new Exception("获取新浪微博ACCESS_TOKEN出错：{$data['error']}")；

	修改：E("获取新浪微博ACCESS_TOKEN出错：{$data['error']}")；

	还有halt函数，也用E方法来代替。


	5.在Cotroller（控制器）中调用。例如（注意里面类的实例化方式）： 

	[php] view plain copy
	 //第三方登录  
	public function thirdLogin($type = null){  
	    empty($type) && $this->error('参数错误');  
	  
	    $sns = \Org\ThinkSDK\ThinkOauth::getInstance($type);  
	  
	     //跳转到授权页面  
	    redirect($sns->getRequestCodeURL());  
	}  

	6.回调登录。callback。以及第三方登录与本地登录体系的结合，授权。
	我这里在回调里去获取openid以及用户的信息。要我们的数据表中建立对应的字段保存openid。 先检索一下是否已有该id。从而确认用户是否第一次登录。如果是第一次登录，则保存openid以及用户名。   保存用户名的时候会有一个问题。因为账号是自动创建的，那么要考虑到用户名是不能重复的。所以也要查询一下用户名是否存在。比如我的qq用户名是runner,如果用户名存在的话，就模糊查询   username like 'runner%' 。   查出来有3个runner开头的。那么我新注册这个账号就自动给他名字runner3或runner4。

	创建了用户之后，再查找用户信息，进行本地的登录流程。  保存相应的session以获取本地系统的权限。
}

四.微信官方实例
{
	1. 第三方发起微信授权登录请求，微信用户允许授权第三方应用后，微信会拉起应用或重定向到第三方网站，并且带上授权临时票据code参数；
	2. 通过code参数加上AppID和AppSecret等，通过API换取access_token；
	3. 通过access_token进行接口调用，获取用户基本数据资源或帮助用户实现基本操作。

	第一步：请求CODE
		第三方使用网站应用授权登录前请注意已获取相应网页授权作用域（scope=snsapi_login），则可以通过在PC端打开以下链接：
		https://open.weixin.qq.com/connect/qrconnect?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
		若提示“该链接无法访问”，请检查参数是否填写错误，如redirect_uri的域名与审核时填写的授权域名不一致或scope不为snsapi_login。


		参数说明
		参数	是否必须	说明
		appid	是	应用唯一标识
		redirect_uri	是	重定向地址，需要进行UrlEncode
		response_type	是	填code
		scope	是	应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即可
		state	否	用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
		返回说明
		用户允许授权后，将会重定向到redirect_uri的网址上，并且带上code和state参数
		redirect_uri?code=CODE&state=STATE
		若用户禁止授权，则重定向后不会带上code参数，仅会带上state参数
		redirect_uri?state=STATE


	第二步：通过code获取access_token
		通过code获取access_token
		https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
		参数说明
		参数	是否必须	说明
		appid	是	应用唯一标识，在微信开放平台提交应用审核通过后获得
		secret	是	应用密钥AppSecret，在微信开放平台提交应用审核通过后获得
		code	是	填写第一步获取的code参数
		grant_type	是	填authorization_code
		返回说明
		正确的返回：
		{ 
		"access_token":"ACCESS_TOKEN", 
		"expires_in":7200, 
		"refresh_token":"REFRESH_TOKEN",
		"openid":"OPENID", 
		"scope":"SCOPE",
		"unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
		}
		参数	说明
		access_token	接口调用凭证
		expires_in	access_token接口调用凭证超时时间，单位（秒）
		refresh_token	用户刷新access_token
		openid	授权用户唯一标识
		scope	用户授权的作用域，使用逗号（,）分隔
		 unionid	当且仅当该网站应用已获得该用户的userinfo授权时，才会出现该字段。
		错误返回样例：
		{"errcode":40029,"errmsg":"invalid code"}
		刷新access_token有效期
		access_token是调用授权关系接口的调用凭证，由于access_token有效期（目前为2个小时）较短，当access_token超时后，可以使用refresh_token进行刷新，access_token刷新结果有两种：

	第三步
		通过access_token获取用户信息
		https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID
}


五.QQ官方实例
{
	地址:http://www.cnblogs.com/it-cen/p/4338202.html

	一、准备工作
	网站需首先进行申请，获得对应的appid与appkey

	二、放置qq登录按钮
	<a href="{$openLoginUrl.connectQQ}" class="icon connect-qq"><span icon-bg2="icon_qq_n"></span>  QQ登录</a>

	三、获取Authorization_Code
	请求地址：
	PC网站：https://graph.qq.com/oauth2.0/authorize
	WAP网站：https://graph.z.qq.com/moc2/authorize

	1.请求方法：
	GET
	请求参数：
	请求参数请包含如下内容：
	参数	是否必须	含义
	response_type	必须	授权类型，此值固定为“code”。
	client_id	必须	申请QQ登录成功后，分配给应用的appid。
	redirect_uri	必须	成功授权后的回调地址，必须是注册appid时填写的主域名下的地址，建议设置为网站首页或网站的用户中心。注意需要将url进行URLEncode。
	state	必须	client端的状态值。用于第三方应用防止CSRF攻击，成功授权后回调时会原样带回。请务必严格按照流程检查用户与state参数状态的绑定。
	scope	可选	请求用户授权时向用户显示的可进行授权的列表。
	可填写的值是API文档中列出的接口，以及一些动作型的授权（目前仅有：do_like），如果要填写多个接口名称，请用逗号隔开。

	例如：scope=get_user_info,list_album,upload_pic,do_like
	不传则默认请求对接口get_user_info进行授权。
	建议控制授权项的数量，只传入必要的接口名称，因为授权项越多，用户越可能拒绝进行任何授权。
	display	可选	仅PC网站接入时使用。
	用于展示的样式。不传则默认展示为PC下的样式。
	如果传入“mobile”，则展示为mobile端下的样式。
	g_ut	可选	仅WAP网站接入时使用。
	QQ登录页面版本（1：wml版本； 2：xhtml版本），默认值为1。

	2.返回说明：

	1. 如果用户成功登录并授权，则会跳转到指定的回调地址，并在redirect_uri地址后带上Authorization Code和原始的state值。如：
	PC网站：http://graph.qq.com/demo/index.jsp?code=9A5F************************06AF&state=test
	WAP网站：http://open.z.qq.com/demo/index.jsp?code=9A5F************************06AF&state=test
	注意：此code会在10分钟内过期。
	2. 如果用户在登录授权过程中取消登录流程，对于PC网站，登录页面直接关闭；对于WAP网站，同样跳转回指定的回调地址，并在redirect_uri地址后带上usercancel参数和原始的state值，其中usercancel值为非零，如：
	http://open.z.qq.com/demo/index.jsp?usercancel=1&state=test

	四、使用Authorization_Code获取Access_Token
	1.请求地址：
	PC网站：https://graph.qq.com/oauth2.0/token
	WAP网站：https://graph.z.qq.com/moc2/token
	请求方法：
	GET
	请求参数：
	请求参数请包含如下内容：
	参数	是否必须	含义
	grant_type	必须	授权类型，在本步骤中，此值为“authorization_code”。
	client_id	必须	申请QQ登录成功后，分配给网站的appid。
	client_secret	必须	申请QQ登录成功后，分配给网站的appkey。
	code	必须	上一步返回的authorization code。

	如果用户成功登录并授权，则会跳转到指定的回调地址，并在URL中带上Authorization Code。
	例如，回调地址为www.qq.com/my.php，则跳转到：
	http://www.qq.com/my.php?code=520DD95263C1CFEA087******
	注意此code会在10分钟内过期。
	redirect_uri	必须	与上面一步中传入的redirect_uri保持一致。

	2.返回说明：
	如果成功返回，即可在返回包中获取到Access Token。 如：
	access_token=FE04************************CCE2&expires_in=7776000&refresh_token=88E4************************BE14
	参数说明	描述
	access_token	授权令牌，Access_Token。
	expires_in	该access token的有效期，单位为秒。
	refresh_token	在授权自动续期步骤中，获取新的Access_Token时需要提供的参数。

	五.获取openID
	1 请求地址
	PC网站：https://graph.qq.com/oauth2.0/me
	WAP网站：https://graph.z.qq.com/moc2/me
	2 请求方法
	GET
	3 请求参数
	请求参数请包含如下内容：
	参数	是否必须	含义
	access_token	必须	在Step1中获取到的access token。
	4 返回说明
	PC网站接入时，获取到用户OpenID，返回包如下：
	1
	callback( {"client_id":"YOUR_APPID","openid":"YOUR_OPENID"} );
	WAP网站接入时，返回如下字符串：
	client_id=100222222&openid=1704************************878C
	openid是此网站上唯一对应用户身份的标识，网站可将此ID进行存储便于用户下次登录时辨识其身份，或将其与用户在网站上的原有账号进行绑定。
}

