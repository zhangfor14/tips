UEditor插入图片尺寸自动适应编辑框大小，首先我们找到如下文件：

 

\ueditor\themes\iframe.css

从这个文件里，就能看到有这一句：/*可以在这里添加你自己的css*/

哈哈，接下来，我们写css吧：
———————————-
img {
max-width: 100%; /*图片自适应宽度*/
}
body {
overflow-y: scroll !important;
}
.view {
word-break: break-all;
}
.vote_area {
display: block;
}
.vote_iframe {
background-color: transparent;
border: 0 none;
height: 100%;
}
#edui1_imagescale{display:none !important;} /*去除点击图片后出现的拉伸边框*/
————————————

 

把以上横线里面的代码复制到编辑里面 保存 上传覆盖然后清理一下浏览器的缓存都可以使用了。