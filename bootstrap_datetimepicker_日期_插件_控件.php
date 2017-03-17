<!--datetimepicker-->
<link href="__PUBLIC__/Admin/css/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<div class="form-group">
    <div class="col-md-12">
        <label class="font-noraml"><h3><span class="glyphicon glyphicon-saved text-warning"></span>日期选择</h3></label>
        <div class="input-group date form_datetime col-md-2" data-link-field="dtp_input1">
            <input class="form-control" id="datetimepicker" size="16" type="text" value="{$parameter}" placeholder="请选择年份">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="dtp_input1" value="" /><br/>
    </div>
</div>
<!--datetimepicker-->
<script type="text/javascript" src="__PUBLIC__/Admin/js/plugins/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/plugins/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script>
    $('.form_datetime').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,//一周从哪一天开始。0（星期日）到6（星期六）
        todayBtn:  1,//如果是true的话，"Today" 按钮仅仅将视图转到当天的日期，如果是"linked"，当天日期将会被选中。
        autoclose: 1,//当选择一个日期之后是否立即关闭此日期时间选择器。
        todayHighlight: 1,//如果为true, 高亮当前日期。
        startView: 4,//日期时间选择器打开之后首先显示的视图,0 or 'hour' for the hour view;1 or 'day' for the day view;2 or 'month' for month view (the default);3 or 'year' for the 12-month overview;4 or 'decade' for the 10-year overview. Useful for date-of-birth datetimepickers.
        minView:4,//日期时间选择器所能够提供的最精确的时间选择视图。
        forceParse: 0,//当选择器关闭的时候，是否强制解析输入框中的值
        showMeridian: 1,//This option will enable meridian views for day and hour views.
        format:'yyyy',//yyyy-mm-dd
    });
</script>

<?php
//关于中文