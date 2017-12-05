<?php

<div class="show-pic" style="position:absolute;z-index:99999;display: none;top: 5px;left: 50%;margin-left: -200px">
	<img style="position: fixed;width:340px;" src="" alt="">
</div>


//放大图片
$(document).on('click','img[data-action=zoom]',function(){
	var img_url=$(this).attr('src');
	$('.show-pic').find('img').attr('src',img_url);
	$('.show-pic').toggle();
});
$(document).on('click','.show-pic',function(){
	$(this).toggle();
});