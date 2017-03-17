<style type="text/css">
        label.del_img{
            cursor:pointer;
        }
        #right{position: fixed;right: 5%;top:15%;width: 200px;z-index:50000;}
        #right a{display: block;width: 160px;height:50px;background: #4a4a4a;text-decoration: none;color: white;text-align: center; line-height: 50px;border: 1px solid white;}
    </style>
</head>

<body>
    <!-- 右侧悬浮列表 -->
    <if condition="$data.dd_type neq 1 " >
        <div id="right">
            <a href="#a">一、基础内容</a>
            <a href="#b">二、最适宜条件组合</a>
            <a href="#c">三、症状描述</a>
            <a href="#d">四、防治方法</a>
            <a href="#e">五、繁殖条件</a>
            <a href="#f">保存修改</a>
        </div>
    </if>