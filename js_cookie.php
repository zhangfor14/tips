<script>


//设置cookie
function setCookie (name, value){ 
    //设置名称为name,值为value的Cookie
    var expdate = new Date();   //初始化时间
    var days = 30;   //保存30天
    expdate.setTime(expdate.getTime() + days * 24 * 60 * 60 * 1000);   //时间
    //时间可以不要，但路径(path)必须要填写，因为JS的默认路径是当前页，如果不填，此cookie只在当前页面生效！~
    document.cookie = name+"="+value+";expires="+expdate.toGMTString()+";path=/";
}
//获取cookie
function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){ 
            c_start=c_start + c_name.length+1 ;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        } 
    }
    return "";
}
//获取cookie
function getCookie(name){
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
    return unescape(arr[2]);
    else
    return null;
}
//删除cookie
function delCookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval=getCookie(name);
    if(cval!=null)
    document.cookie= name + "="+cval+";expires="+exp.toGMTString()+";path=/";
}


</script>