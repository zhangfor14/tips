


/**
 * 1.ECharts 特性介绍
 */
ECharts，一个纯 Javascript 的图表库，可以流畅的运行在 PC 和移动设备上，兼容当前绝大部分浏览器（IE8/9/10/11，Chrome，Firefox，Safari等），底层依赖轻量级的 Canvas 类库 ZRender，提供直观，生动，可交互，可高度个性化定制的数据可视化图表。

/**
 * 2.加载js
 */
<!-- ECharts -->
<script src="__template__/js/plugins/echarts/echarts-all.js"></script>

/**
 * 3.初始化
 * http://echarts.baidu.com/tutorial.html#ECharts%20%E7%89%B9%E6%80%A7%E4%BB%8B%E7%BB%8D
 */
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 600px;height:400px;"></div>
<script>
	// 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
</script>

/**
 * 4.在选项面板中初始化
 */
<script type="text/javascript">
	//监听选项面板初始化事件
    $('a[data-toggle="tab"]').on('shown.bs.tab',function (e) {
       // 获取已激活的标签页的名称
       var activeTab = $(e.target)[0].hash;
       if(activeTab=="#tab-2") loadEcharts({$shadowoption},'echarts-map-shadow');
       if(activeTab=="#tab-3") loadEcharts({$lineoption},'echarts-map-line');
    });
    //实例化echarts图表
    function loadEcharts(val,id){
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById(id));
        // 指定图表的配置项和数据
        var option = val;
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        $(window).resize(lineChart.resize);
    }
</script>

/**
 * 5.数据组装
 * http://echarts.baidu.com/demo.html#dynamic-data2
 */
<?php
	/**
	 * [getEcharts 获取初始化echarts的数据]
	 * @param  [type] $res [统计信息数组]
	 * @param  [type] $tmp [总计信息数组]
	 * @return [type]      [description]
	 */
	public function getEcharts($data){
		/*****柱形图****************/
		$shadowoption['title']['text']='无人机团队统计';//标题
		$shadowoption['title']['subtext']=empty($datetime) ? '全部' : $datetime;//副标题
		$shadowoption['tooltip']=array(
				'trigger'		=>	'axis',	// 坐标轴指示器，坐标轴触发有效
				'axisPointer'	=>	array('type'=>'shadow'),// 默认为直线，可选为：'line' | 'shadow'
			);
		$shadowoption['legend']['data']=array('作业面积','订单量','总收入');
		$shadowoption['grid']=array(
				'left'			=>	'3%',
		        'right'			=>	'4%',
		        'bottom'		=>	'3%',
		        'containLabel'	=>	true
			);
		$shadowoption['xAxis']=array(array('type'=>'category','data'=>$data['xnames'],'splitLine'=>array('show'=>false),'name'=>$data['xname'],'nameTextStyle'=>array('fontSize'=>20),'nameGap'=>20));
		$shadowoption['yAxis']=array(array('type'=>'value'));
		$shadowoption['series']=array(
			array('name'=>'作业面积','type'=>'bar','stack'=>'面积','data'=>$data['uavareas']),
			array('name'=>'订单量','type'=>'bar','stack'=>'数量','data'=>$data['uavcous']),
			array('name'=>'总收入','type'=>'bar','stack'=>'收入','data'=>$data['uavprices']),
		);
		/********折线图*********************/
		$lineoption=$shadowoption;
		$lineoption['tooltip']=array(
				'trigger'		=>	'axis',	// 坐标轴指示器，坐标轴触发有效
			);
		$lineoption['toolbox']=array(
				'feature'	=>	array(
						'saveAsImage'	=>	array(),
					)
			);
		$lineoption['xAxis']=array('type'=>'category','boundaryGap'=>false,'data'=>$data['xnames'],'splitLine'=>array('show'=>false),'name'=>$data['xname'],'nameTextStyle'=>array('fontSize'=>20),'nameGap'=>20);
		$lineoption['yAxis']=array('type'=>'value');
		$lineoption['series']=array(
			array('name'=>'作业面积','type'=>'line','stack'=>'面积','data'=>$data['uavareas']),
			array('name'=>'订单量','type'=>'line','stack'=>'数量','data'=>$data['uavcous']),
			array('name'=>'总收入','type'=>'line','stack'=>'收入','data'=>$data['uavprices']),
		);

		$shadowoption=json_encode($shadowoption);//柱型
		$lineoption=json_encode($lineoption);//折现
		return array($shadowoption,$lineoption);
	}
?>