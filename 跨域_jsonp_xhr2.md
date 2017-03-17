一、处理跨域的方式：
1.代理
2.XHR2
HTML5中提供的XMLHTTPREQUEST Level2（及XHR2）已经实现了跨域访问。但ie10以下不支持
只需要在服务端填上响应头：
 header("Access-Control-Allow-Origin:*");
 /*星号表示所有的域都可以接受，*/
 header("Access-Control-Allow-Methods:GET,POST");
3.jsonP
在url中callback传到后台的参数是神马callback就是神马，jsonp比json外面有多了一层，callback()。这样就知道怎么处理它了
追求永无止境，在google的过程中，无意中发现了一个专门用来解决跨域问题的jQuery插件-jquery-jsonp。
var url="http://localhost:8080/WorkGroupManagment/open/getGroupById"
    +"?id=1&callback=?";
$.jsonp({
  "url": url,
  "success": function(data) {
    $("#current-group").text("当前工作组:"+data.result.name);
  },
  "error": function(d,msg) {
    alert("Could not find user "+msg);
  }
});