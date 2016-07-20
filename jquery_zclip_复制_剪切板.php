
jQuery-zclip是一个复制内容到剪贴板的jQuery插件，使用它我们不用考虑不同浏览器和浏览器版本之间的兼容问题。jQuery-zclip插件需要Flash的支持，使用时记得安装Adobe Flash Player。


/**
 * [class html部分]
 * @type {String}
 */
<style type="text/css">
	#msg{margin-left:10px; color:green; border:1px solid #3c3; background:url(checkmark.png) no-repeat 2px 3px; padding:3px 6px 3px 20px}
</style>
<div class="demo">
	<textarea id="mytext">请输入内容</textarea><br/>
    <a href="#" id="copy_input" class="copy">复制内容</a>
</div>

/**
 * [type 加载js]
 * @type {String}
 */
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.zclip.min.js"></script>
tips:path中js/ZeroClipboard.swf为flash地址,必填否则出错

/**
 * [type js部分]
 * @type {String}
 */
<script type="text/javascript">
// $(function(){
	$('#copy_input').zclip({
		path: 'js/ZeroClipboard.swf',
		copy: function(){
			return $('#mytext').val();
		},
		afterCopy: function(){
			alert('复制成功');
			$("<span class='glyphicon glyphicon-ok' id='msg'/></span>").insertAfter($('.copyToSP')).text('复制成功!').fadeOut(2000);
		}
	});
// });
</script>

/**
 * 问题:
 */
1.当点击事件在table->tr->td中时,复制失效
	解决:需要在父节点,td中添加样式,style="position:relative; display: inline-block;"设置为相对定位,行内块
	<td style="position:relative;">
        <textarea name="user_filed_staffname[]" class="form-control" rows="5" placeholder="修正前田地边界gps" readonly="">{$vo.user_filed_gcj02}</textarea>
        <button class="btn btn-w-m btn-primary copyToSP" type="button">复制到剪切板</button>
    </td>