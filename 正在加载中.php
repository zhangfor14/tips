<!DOCTYPE html>
<html>

<!-- 这....................... -->
<div id='bd' onload="jiazai()">
    <div style="margin:0px auto;position: fixed;left: 0;right: 0;top: 0;bottom: 0;z-index:1052;height:605px;line-height:605px;width:150px;">
        <img src="__PUBLIC__/Admin/img/loading-0.gif" style="z-index:1052;">加载中……
    </div>
</div>
<!-- 这....................... -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link href="__PUBLIC__/Admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="__PUBLIC__/Admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="__PUBLIC__/Admin/css/animate.css" rel="stylesheet">
<link href="__PUBLIC__/Admin/css/style.css?v=4.1.0" rel="stylesheet">
<!-- Morris -->
<link href="__PUBLIC__/Admin/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
<!-- Gritter -->
<link href="__PUBLIC__/Admin/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<!--datetimepicker-->
<link href="__PUBLIC__/Admin/css/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!-- Data Tables -->
<link href="__PUBLIC__/Admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<!-- 自定义 -->
<link href="__PUBLIC__/Admin/css/mimicry-box.css" rel="stylesheet">
<style type="text/css">
    body, html,#map,#bd {width: 100%;height: 100%;overflow: hidden;margin:0;}
</style>
<title>团队分布</title>
</head>

<!-- 这....................... -->
<div id="fugai" style="position:fixed;width: 100%;height: 100%;background-color:#676a6c;font-size:14px;z-index:1051;display:none;opacity:0.2;"></div>
<div id="onload" style="display:none;color:#ffffff;opacity:1;margin:0px auto;position: fixed;left: 0;right: 0;top: 0;bottom: 0;z-index:1052;height:605px;line-height:605px;width:150px;">
    <img src="__PUBLIC__/Admin/img/loading-0.gif" style="z-index:1052;">加载中……
</div>
<!-- 这....................... -->

<body onload="InitializeMap()">
<body>
<div id="map"></div>



<script type="text/javascript">
	// <!-- 这....................... -->
    function jiazai(){
        $('#bd').css("background-color","#ddd");
        $('#bd').css("opacity","1");
        $('#bd').css("z-index","0");
    }
    // <!-- 这....................... -->
    /**
     * [InitializeMap 初始化地图方法]
     */
    function InitializeMap() {
        /**
         * [map 实例化基础地图]
         * @type {BMap}
         */
        map = new BMap.Map("map", { mapType: BMAP_HYBRID_MAP, enableMapClick: false }); // 创建Map实例
        map.centerAndZoom(new BMap.Point(115.461,38.774), 7); // 初始化地图，设置中心点坐标和地图级别
        map.enableScrollWheelZoom(true); //开启鼠标滚轮缩放
        map.addControl(new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT }));
        map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}));
        map.addControl(new BMap.ScaleControl());
        map.addControl(new BMap.OverviewMapControl());
        map.addControl(new BMap.MapTypeControl({ anchor: BMAP_ANCHOR_BOTTOM_RIGHT, mapTypes: [BMAP_NORMAL_MAP, BMAP_HYBRID_MAP, BMAP_SATELLITE_MAP] })); //, BMAP_PERSPECTIVE_MAP左上角，默认地图控件
        map.setCurrentCity("北京"); // 仅当设置城市信息时，MapTypeControl的切换功能才能可用
        /**
         * [实例化标记点]
         * @type {Object}
         */
        var stationData={$stationData};
        var point = new Array(); //存放标注点经纬信息的数组 
        var marker = new Array(); //存放标注点对象的数组 
        var myicon = new Array();   //存放图标的数组
        var point_num=stationData.length;
        for (var i = 0; i < point_num; i++) {
            point[i] = new BMap.Point(stationData[i].jd, stationData[i].wd); //循环生成新的地图点 
            marker[i] = new BMap.Marker(point[i]); //按照地图点坐标生成标记 
            marker[i].setTitle(stationData[i].tzmc+',站点id:'+stationData[i].stationid);//设置标题
            myicon[i] = new BMap.Icon("__PUBLIC__/Admin/img/"+stationData[i].twa+".png", new BMap.Size(46,46), { //图片       
               // offset: new BMap.Size(10, 25),        //相当于CSS精灵
               imageOffset: new BMap.Size(0,0)   // 设置图片偏移    
             });      
            marker[i].setIcon(myicon[i]);//修改标记图片
            map.addOverlay(marker[i]);//在地图上添加标记
            //添加点击事件,监听marker标记
            marker[i].addEventListener('click', function (e) {
                var stationid=this.getTitle().split(':');
                //$('#bd').css("opacity","1");
                //
                //
// <!-- 这....................... -->
                $("#fugai").show();
                $("#onload").show();



                //$("#bd").show();
                InitializeModal(stationid[1]);
            });
        }




        $("#bd").hide();
        $("#fugai").hide();
        $("#onload").hide();
// <!-- 这....................... -->
    }
</script>