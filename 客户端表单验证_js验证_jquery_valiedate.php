jQuery Validate 插件为表单提供了强大的验证功能，让客户端表单验证变得更简单，同时提供了大量的定制选项，满足应用程序各种需求。该插件捆绑了一套有用的验证方法，包括 URL 和电子邮件验证，同时提供了一个用来编写用户自定义方法的 API。所有的捆绑方法默认使用英语作为错误信息，且已翻译成其他 37 种语言。
该插件是由 Jörn Zaefferer 编写和维护的，他是 jQuery 团队的一名成员，是 jQuery UI 团队的主要开发人员，是 QUnit 的维护人员。该插件在 2006 年 jQuery 早期的时候就已经开始出现，并一直更新至今。目前版本是 1.14.0。
访问 jQuery Validate 官网，下载最新版的 jQuery Validate 插件。
菜鸟教程提供的 1.14.0 版本下载地址：http://static.runoob.com/download/jquery-validation-1.14.0.zip

1.教程
http://www.runoob.com/jquery/jquery-plugin-validate.html

2.加载文件
<!-- jQuery Validation plugin javascript-->
<script src="__PUBLIC__/Admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="__PUBLIC__/Admin/js/plugins/validate/messages_zh.min.js"></script>
<script src="__PUBLIC__/Admin/js/demo/form-validate-demo.js"></script>

3.form-validate-demo.js
<script>
/**
 * 以下为修改jQuery Validation插件兼容Bootstrap的方法，没有直接写在插件中是为了便于插件升级
 */
        //表单验证样式
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                element.closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                if (element.is(":radio") || element.is(":checkbox")) {
                    error.appendTo(element.parent().parent().parent());
                } else {
                    error.appendTo(element.parent());
                }
            },
            errorClass: "help-block m-b-none",
            validClass: "help-block m-b-none"


        });

/**
 * [自定义验证规则]
 * 
 */
        //验证手机号
        jQuery.validator.addMethod("phone", function(value, element) {   
            var tel = /^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
            return this.optional(element) || (tel.test(value));
        }, "请正确填写您的手机号");

/**
 * [给.form-horizontal添加验证]
 * 
 */
        $(document).ready(function () {
            // validate signup form on keyup and submit
            var icon = "<i class='fa fa-times-circle'></i> ";
            $(".form-horizontal").validate({
                rules: {
                    //productionunit
                    productionunit_telephone : {
                        phone:true,
                    },
                    
                    //field
                    field_seedarea : {
                        number:true,
                    },
                    
                    //seed
                    seed_sproutrate : {
                        range:[0,100],
                    },
                },
                messages: {
                    //seed
                    seed_sproutrate : {
                        range: icon + "请输入0-100之间数字",
                    },
                }
            });
        });
</script>
