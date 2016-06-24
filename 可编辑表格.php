<script>
    //初始化可编辑表格
    $(document).ready(function(){
        //编辑开始,点击td格文字,变为input文本框
        $('td.text-edit').on('click',textChangeInput);
        //编辑结束,鼠标离开input文本框,所在td内容变为文字
        $('input[placeholder=请输入选项名称]').on('blur',inputChangeText);
        $('input[placeholder=请输入选项编码]').on('blur',inputChangeText);
        //删除行,点击每行删除图标删除当前行
        $('span.glyphicon-remove').on('click',removeTr);
        //添加行,点击添加图标添加一行
        $('span.glyphicon-plus').on('click',addTr);
    });
    //编辑开始,点击td格文字,变为input文本框
    function textChangeInput(){
        td=$(this);
        text=td.text();
        html=td.html();
        //如果当前是input文本框,则不会重复调用该方法
        if(text != html){
            return true;
        }
        //td内容变为input文本框
        str='<input type="text" value="'+text+'" class="form-control" placeholder="编辑选项">';
        $(this).html(str);
        //变为文本框同时获取焦点
        $('input[placeholder=编辑选项]').focus();
        //文本框失去焦点,则变为文本
        $('input[placeholder=编辑选项]').on('blur',function(){
            val=$(this).val();
            td.text(val);
        });
    }
    //编辑结束,鼠标离开input文本框,所在td内容变为文字
    function inputChangeText(){
        val=$(this).val();
        $(this).parent().text(val);
    }
    //删除当前行
    function removeTr(){
        $(this).parent().parent().remove();
    }
    //在tr末尾添加行
    function addTr(){
        str='<tr>';
        str+='<td class="text-edit"><input type="text" class="form-control" placeholder="请输入选项名称"></td>';
        str+='<td class="text-edit"><input type="text" class="form-control" placeholder="请输入选项编码"></td>';
        str+='<td align="right">';
        str+='<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
        str+='</td>';
        str+='</tr>';
        $('tr:last').after(str);
        //使新添加的行同时有编辑,删除功能
        $('td.text-edit').on('click',textChangeInput);
        $('input[placeholder=请输入选项名称]').on('blur',inputChangeText);
        $('input[placeholder=请输入选项编码]').on('blur',inputChangeText);
        $('span.glyphicon-remove').on('click',removeTr);
    }
</script>

<!--选项内容 start-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-md-4">
                                    <table class="table table-striped table-hover" id="tab">
                                         <thead>
                                            <tr>
                                                <th >选项名称</th>
                                                <th >选项编码</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-edit">选项1</td>
                                                <td class="text-edit">编码1</td>
                                                <td align="right">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-edit">选项2</td>
                                                <td class="text-edit">编码2</td>
                                                <td align="right">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-edit"><input type="text" class="form-control" placeholder="请输入选项名称"></td>
                                                <td class="text-edit"><input type="text" class="form-control" placeholder="请输入选项编码"></td>
                                                <td align="right">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <span class="help-block m-b-none">
                                        点击这里添加选项 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </span>
                                </div>
                            </div>
                            <!--选项内容 start-->