<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
<script>
	//a页面打开b页面
    $(document).on('click','#check_teacher',function(){
        var w = 800;
        var h = 600;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        window.open('/admin.php/CourseLive/user_list', "选择提问者", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    })
    //b页面传值给a页面
	$('.close').click(function(){
	    //多选
	    var name=window.opener.document.getElementById("name").value;
	    var user_id=window.opener.document.getElementById("user_id").value;

	    //赋值
	    if(user_id !='' && name!=''){
	        var newname=name+'/'+$(this).attr('data-value');
	        var newid=user_id+$(this).find('input').val()+'|';
	    }else{
	        var newname=$(this).attr('data-value');
	        var newid='|'+$(this).find('input').val()+'|';
	    }
	    window.opener.document.getElementById("name").value = newname;
	    window.opener.document.getElementById("user_id").value = newid;
	    window.close();
	});
</script>
</html>