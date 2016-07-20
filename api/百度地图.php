<script>
// 百度地图API功能
var map = new BMap.Map("allmap");
map.centerAndZoom(new BMap.Point(116.404, 39.915), 4);
map.enableScrollWheelZoom();
myMarkerClusterer();
function myMarkerClusterer() {
         
        var markerArr = [
                        { title: "名称：金陵饭店", point: "118.789287,32.048784", address: "南京", tel: "12306" },
                        { title: "名称：金奥费尔蒙酒店", point: "118.789287,32.048784", address: "南京", tel: "18500000000" },
                        { title: "名称：黄埔大酒店", point: "118.817663,32.048446", address: "南京", tel: "18500000000" },
                        { title: "名称：苏宁银河诺富特", point: "118.897611,32.091566", address: "南京", tel: "18500000000" }
 
        ];
 
        var point = new Array(); //存放标注点经纬信息的数组 
        var marker = new Array(); //存放标注点对象的数组 
        var info = new Array(); //存放提示信息窗口对象的数组
        var label = new Array();
 
        for (var i = 0; i < markerArr.length; i++) {
            var p0 = markerArr[i].point.split(",")[0]; // 
            var p1 = markerArr[i].point.split(",")[1]; //按照原数组的point格式将地图点坐标的经纬度分别提出来 
            point[i] = new BMap.Point(p0, p1); //循环生成新的地图点 
            marker[i] = new BMap.Marker(point[i]); //按照地图点坐标生成标记 
            map.addOverlay(marker[i]);
            //marker[i].setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画 
            label[i] = new BMap.Label(markerArr[i].title, { offset: new window.BMap.Size(20, -10) });
            label[i].enableMassClear = true;
            marker[i].setLabel(label[i]);
            info[i] = new BMap.InfoWindow("<p style=’font-size:12px;lineheight:1.8em;’>" + markerArr[i].title + "</br>地址：" + markerArr[i].address + "</br> 电话：" + markerArr[i].tel + "</br></p>"); // 创建信息窗口对象 
        }
        for (var i = 0; i < marker.length; i++) {
            (function () {
                var index = i;
                marker[i].addEventListener('click', function () {
                    this.openInfoWindow(info[index]);
                });
            })();
        }
        //最简单的用法，生成一个marker数组，然后调用markerClusterer类即可。
        var markerClusterer = new BMapLib.MarkerClusterer(map, { markers: marker });
    }
</script>


<script type="text/javascript">
/**
 * [type 百度地图聚合示例]
 * @type {String}
 */
 
// 百度地图API功能
var map = new BMap.Map("allmap");
map.centerAndZoom(new BMap.Point(116.404, 39.915), 5);
map.enableScrollWheelZoom();
myMarkerClusterer();
map.addControl(top_left_control);        
var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
    var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
    var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); 
        map.addControl(top_left_navigation);     
        map.addControl(top_right_navigation);   
function myMarkerClusterer() {
        var markerArr = {$info};
        var point = new Array(); //存放标注点经纬信息的数组 
        var marker = new Array(); //存放标注点对象的数组 
        var info = new Array(); //存放提示信息窗口对象的数组
        var label = new Array();
        var len1=markerArr.length;
        
        for (var i = 0; i < len1; i++) {
            var p0 = markerArr[i].point.split(",")[0]; //按照原数组的point格式将地图点坐标的经纬度分别提出来 
            var p1 = markerArr[i].point.split(",")[1]; //按照原数组的point格式将地图点坐标的经纬度分别提出来 
            point[i] = new BMap.Point(p0, p1); //循环生成新的地图点 
            marker[i] = new BMap.Marker(point[i]); //按照地图点坐标生成标记 
            // map.addOverlay(marker[i]);
            // marker[i].setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画 
            // 设置文本标注
            label[i] = new BMap.Label(markerArr[i].count);//
                label[i].setStyle({ color : "black", fontSize : "12px" , fontWeight : "bold " ,backgroundColor : "red" });//设置样式
                label[i].enableMassClear = true;//允许覆盖物在map.clearOverlays方法中被清除。
                var strOffsetL=2;
                var strOffsetR=24;
                if(markerArr[i].count < 10){
                    strOffsetL=27;
                    strOffsetR=24;
                }else if(markerArr[i].count < 100){
                    strOffsetL=23;
                    strOffsetR=24;
                }else{
                    strOffsetL=21;
                    strOffsetR=24;
                }
                label[i].setOffset(new window.BMap.Size(strOffsetL,strOffsetR));//设置偏移量
            marker[i].setLabel(label[i]);
            marker[i].setTitle(markerArr[i].title);
            marker[i].setIcon(new BMap.Icon('__map__/m2.png', new BMap.Size(77, 77)));
            info[i] = new BMap.InfoWindow(markerArr[i].cont); // 创建信息窗口对象 
        }

        var len2=marker.length;
        for (var i = 0; i < len2; i++) {
            (function () {
                var index = i;
                marker[i].addEventListener('click', function () {
                    this.openInfoWindow(info[index]);
                });
            })();
        }
        //最简单的用法，生成一个marker数组，然后调用markerClusterer类即可。
        var markerClusterer = new BMapLib.MarkerClusterer(map, { markers: marker });
        markerClusterer.setMinClusterSize(1);//设置最小聚合数
    }
</script>

<script type="text/javascript">
/**
 * [type 百度地图,轨迹图示例]
 * @type {String}
 */

    var lnglat = {$list};
    /**
     * 百度地图API功能,初始化地图,加载控件
     */
    // var curve;
    var map = new BMap.Map("allmap");
    var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
    var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
    var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); 
        map.addControl(top_left_navigation);     
        map.addControl(top_right_navigation);   

    // var lng_tmp = accAdd(lnglat[1].lng,'0.007015');
    // var lat_tmp = accAdd(lnglat[1].lat,'0.0124');
    //map.centerAndZoom(new BMap.Point(lng_tmp,lat_tmp), 25);//转换后
    map.centerAndZoom(new BMap.Point(lnglat[1].lng,lnglat[1].lat), 15);//转换前
    map.enableScrollWheelZoom(true);
    //新建飞机图标
    var myIcon = new BMap.Icon("__map__/feiji.png", new BMap.Size(90, 70), {    //飞机图片
        //offset: new BMap.Size(0, -5),    //相当于CSS精灵
        imageOffset: new BMap.Size(0, 0)    //图片的偏移量。为了是图片底部中心对准坐标点。
      }); 
    var points;
    var ps=[];
    // var ps_gps = [];
    $.each(lnglat, function(k,v){
     // var lng = accAdd(v.lng,'0.007015');
     // var lat = accAdd(v.lat,'0.0124');
    //  ps.push(new BMap.Point(lng,lat)); //是把施工方给的经纬度按gps经纬度模糊转为百度地图经纬度后的
        ps.push(new BMap.Point(v.lng,v.lat));//施工方给出的经纬度直接放到百度地图
    });
    /**
     * [track 制作弧线,将坐标点连接起来,蓝色线显示]
     * @type {BMap}
     */
    track = new BMap.Polyline(ps, {strokeColor:"blue", strokeWeight:3, strokeOpacity:0.5}); //创建弧线对象                
    map.addOverlay(track); //添加到地图中
    /**
     * [run 移动的的飞机,按坐标游走,走过的坐标用红线连接起来]
     * @return {[type]} [description]
     */
    function run(){
        var pts = ps;    //通过驾车实例，获得一系列点的数组
        var paths = pts.length;    //获得有几个点
        //在地图上添加飞机
        var carMk = new BMap.Marker(pts[0],{icon:myIcon});
        map.addOverlay(carMk);
        i=1;
        function resetMkPoint(i){
            if(i < paths){
                carMk.setPosition(pts[i]);
                //将走过的两个点用红线连接起来
                points = [pts[i-1],pts[i]];
                track = new BMap.Polyline(points, {strokeColor:"red", strokeWeight:3, strokeOpacity:0.5}); //创建弧线对象
                map.addOverlay(track); //添加到地图中
                setTimeout(function(){
                    i++;
                    resetMkPoint(i);
                },500);
            }
        }
        setTimeout(function(){
            resetMkPoint(i);
        },500) 
    }
    setTimeout(function(){
        run();
    },100);


    //arg1坐标按arg2偏差转换为新坐标
    function accAdd(arg1, arg2) {
         var r1, r2, m, c;
         try {
             r1 = arg1.toString().split(".")[1].length;
         }
         catch (e) {
             r1 = 0;
         }
         try {
             r2 = arg2.toString().split(".")[1].length;
         }
         catch (e) {
             r2 = 0;
         }
         c = Math.abs(r1 - r2);
         m = Math.pow(10, Math.max(r1, r2));
         if (c > 0) {
             var cm = Math.pow(10, c);
             if (r1 > r2) {
                 arg1 = Number(arg1.toString().replace(".", ""));
                 arg2 = Number(arg2.toString().replace(".", "")) * cm;
             } else {
                 arg1 = Number(arg1.toString().replace(".", "")) * cm;
                 arg2 = Number(arg2.toString().replace(".", ""));
             }
         } else {
             arg1 = Number(arg1.toString().replace(".", ""));
             arg2 = Number(arg2.toString().replace(".", ""));
         }
         return (arg1 + arg2) / m;
    }   
</script>