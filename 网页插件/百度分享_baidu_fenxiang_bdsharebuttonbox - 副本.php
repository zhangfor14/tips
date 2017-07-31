<?php
/**
 * http://share.baidu.com/code/advance#html
 */

	分享媒体id对应表
	{

		名称	ID
		印象笔记	evernotecn
		网易热	h163
		一键分享	mshare
		QQ空间	qzone
		新浪微博	tsina
		人人网	renren
		腾讯微博	tqq
		百度相册	bdxc
		开心网	kaixin001
		腾讯朋友	tqf
		百度贴吧	tieba
		豆瓣网	douban
		百度新首页	bdhome
		QQ好友	sqq
		和讯微博	thx
		百度云收藏	bdysc
		美丽说	meilishuo
		蘑菇街	mogujie
		点点网	diandian
		花瓣	huaban
		堆糖	duitang
		和讯	hx
		飞信	fx
		有道云笔记	youdao
		麦库记事	sdo
		轻笔记	qingbiji
		人民微博	people
		新华微博	xinhua
		邮件分享	mail
		我的搜狐	isohu
		摇篮空间	yaolan
		若邻网	wealink
		天涯社区	ty
		Facebook	fbook
		Twitter	twi
		linkedin	linkedin
		复制网址	copy
		打印	print
		百度中心	ibaidu
		微信	weixin
		股吧	iguba
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="bdsharebuttonbox" data-tag="share_1">
		<a class="bds_mshare" data-cmd="mshare"></a>
		<a class="bds_qzone" data-cmd="qzone" href="#"></a>
		<a class="bds_tsina" data-cmd="tsina"></a>
		<a class="bds_baidu" data-cmd="baidu"></a>
		<a class="bds_renren" data-cmd="renren"></a>
		<a class="bds_tqq" data-cmd="tqq"></a>
		<a class="bds_more" data-cmd="more">更多</a>
		<a class="bds_count" data-cmd="count"></a>
	</div>
	<script>
		window._bd_share_config = {
			common : {
				bdText : '自定义分享内容',	
				bdDesc : '自定义分享摘要',	
				bdUrl : '自定义分享url地址', 	
				bdPic : '自定义分享图片'
			},
			share : [{
				"bdSize" : 16
			}],
			slide : [{	   
				bdImg : 0,
				bdPos : "right",
				bdTop : 100
			}],
			image : [{
				viewType : 'list',
				viewPos : 'top',
				viewColor : 'black',
				viewSize : '16',
				viewList : ['qzone','tsina','huaban','tqq','renren']
			}],
			selectShare : [{
				"bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
			}]
		}
		with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
	</script>
</body>
</html>