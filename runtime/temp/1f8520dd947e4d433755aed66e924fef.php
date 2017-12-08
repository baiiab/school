<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\kinggsoft\phpstudy\WWW\school\public/../application/index\view\attendance\index.html";i:1512557638;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>教师端</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="__PUBLIC__/sm.min.css">
    <style type="text/css">
        .news-item {
            height: 127px;
            padding-left: 25px;
            border: 1px solid #E6E6E6;
            border-radius: 8px;
            width: 300px;

            margin-top: 2rem;
            margin-left: auto;
            margin-right: auto;
            display: flex;
        }

        .news-image{
            width: 50px;
            height: 50px;
            margin-top: 35px;
            align-content: center;
        }
        .news-image img{
            width: 50px;
            height: 50px;
        }
        .news-item-p{
            margin-left: 10px;
            align-content: center;
        }
        .smalltex{
            color: #666666;
            font-size: 14px;
            margin-top: 2px;
            font-family: PingFang-SC-Medium;
        }
        .item-common{
            margin-top: 16px;
            padding-left: 17px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
            border-top: 1px solid #CCCCCC;
        }
        .common{
            margin-top: 0px;
            margin-bottom: 0px;
            height: 50px;
            line-height: 50px;
        }
        .common .date{
            text-align: right;margin-top: 0.65rem;border: none;
            margin-right: 10px;
            font-family: SFUIDisplay-Regular;
            font-size: 14px;
            color: #666666;
        }
        .common .reason{
            width: 100%;
            border: none;
        }
        .common .starttime{
            font-size: 16px;
            font-family: PingFang-SC-Medium;
            color: #333333;
        }
        .common .endtime{
            font-size: 14px;
            font-family: PingFang-SC-Medium;
            color: #999999;
        }
        .smallimg {
            width: 1.5rem;
            height: 1.5rem;
            margin-bottom: 1rem
        }

        .boldtex {
            font-size: 16px;
            margin-top: 35px;
            margin-bottom: 1px;
            font-family: PingFang-SC-Bold;
            color: #333333;
        }
        .titleh{
            color: #FFFFFF;
            margin-top: 0.2rem;
            font-size: 16px;
            font-family: PingFang-SC-Bold;
        }
        .title1{
            height: 2.5rem;
            background-color: #28A5E5;
            line-height: 2.5rem;
        }
        header .icon{
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }
        hr {
            margin-top: 0px;
            margin-bottom: 0px;
            border: none;
            border-top: 1px solid #CCCCCC;
        }
        .logout{
            margin: 2rem 1rem 0rem 1rem;
            height: 50px;
            border-radius: 6px 6px 6px 6px;
            background-color: #28A5E5;
            line-height: 50px;
            text-align: center;
        }
        .logout input{
            font-family: PingFang-SC-Medium;
            font-size: 18px;
            color: #FFFFFF;
            background-color: #28A5E5;
            border: none;
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page page-current" id='router'>
        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external" href="<?php echo url('transinfo/handtran'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_transition_unactived@3x.png"></span>
                <span class="tab-label">学员交接</span>
            </a>
            <a class="tab-item external active" href="">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_attendance_actived@3x.png"></span>
                <span class="tab-label">考勤</span>
            </a>
            <a class="tab-item external" href="<?php echo url('teacher/home'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_person_center_unactived@3x.png"></span>
                <span class="tab-label">个人中心</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <a class="external"><div class="news-item" style="background-color: #E8F3F8">
                <div class="news-image">
                    <img src="__IMG__/ios/icon_signin@3x.png">
                </div>
                <div class="news-item-p" onclick="GetLocal();">
                <input type="hidden" value="<?php echo $data; ?>" id="data">
                <p class="boldtex">签到</p>
                <p id="signstatus" class="smalltex"><?php echo $str; ?></p></div>
            </div></a>
            <a href="#router2"><div class="news-item" style="background-color: #F4FDF1">
                <div class="news-image">
                    <img src="__IMG__/ios/icon_leave@3x.png">
                </div>
                <div class="news-item-p" style="margin-top: 0.6rem">
                <p class="boldtex">申请请假</p>
                </div>
            </div></a>
            <a href="#router3"><div class="news-item" style="background-color: #FCFDF1">
                <div class="news-image">
                    <img src="__IMG__/ios/icon_business_trip@3x.png">
                </div>
                <div class="news-item-p" style="margin-top: 0.6rem">
                <p class="boldtex">申请出差</p>
                </div>
            </div></a>
    </div>
    </div>
    <!-- 其他的单个page内联页（如果有） -->
    <div class="page" id='router2'>
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF">
                <span class="icon icon-left" style="color: #FFFFFF"></span>
            </a>
            <h1 class='title titleh'>申请请假</h1>
        </header>
        <div class="content">
            <form action="<?php echo url('holiday'); ?>" method="post">
            <div class="item-common">
                <div class="common">
                    <span class="icon icon-down pull-right" style="margin-right: 0.5rem;"></span>
                    <input class="pull-right date" id="stime" name="stime">
                    <span class="starttime">起始日期</span></div>
                <hr/>
                <div class="common">
                    <span class="icon icon-down pull-right" style="margin-right: 0.5rem;"></span>
                    <input class="pull-right date" id="etime" name="etime">
                    <span class="starttime">结束日期</span></div>
                <hr/>
                <div class="common">
                    <input class="endtime reason" placeholder="请填写工作交接人" required name="tutor"></div>
                <hr/>
                <div class="common" style="height: 145px">
                    <textarea class="endtime reason" style="height: 145px" required placeholder="请填写请假原因" name="reason"></textarea>
                </div>
            </div>
            <div class="logout">
                <input type="submit" value="提&nbsp;交"></div>
            </form>
        </div>
        </div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
    <div class="page" id='router3'>
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF">
                <span class="icon icon-left" style="color: #FFFFFF"></span>
            </a>
            <h1 class='title titleh'>申请出差</h1>
        </header>
        <div class="content">
            <form action="<?php echo url('evection'); ?>" method="post">
            <div class="item-common">
                <div class="common">
                    <span class="icon icon-down pull-right" style="margin-right: 0.5rem;"></span>
                    <input class="pull-right date" id="estime" name="estime">
                    <span class="starttime">起始日期</span></div>
                <hr/>
                <div class="common">
                    <span class="icon icon-down pull-right" style="margin-right: 0.5rem;"></span>
                    <input class="pull-right date" id="eetime" name="eetime">
                    <span class="starttime">结束日期</span></div>
                <hr/>
                <div class="common">
                    <input class="endtime reason" placeholder="请填写出差地点" required name="place"></div>
                <hr/>
                <div class="common">
                    <input class="endtime reason" placeholder="请填写工作交接人" required name="tutor1"></div>
                <hr/>
                <div class="common" style="height: 145px;line-height: 30px;margin-top: 10px">
                    <textarea class="endtime reason" style="height: 145px" required placeholder="请填写出差目的" name="purpose"></textarea>
                </div>
            </div>
            <div class="logout">
                <input type="submit" value="提&nbsp;交"></div>
            </form>
        </div>
        </div>
    </div>

</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(function () {
        var time = new Date();
        $("#estime").val(time).datetimePicker({
            value: ['2017','12','06','17','12']
//            value: [time.getFullYear(),time.getMonth(),time.getDate(),time.getHours(),time.getMinutes()]
        });
        $("#eetime").datetimePicker({
            value: ['2017','12','06','17','12']
//            value: [time.getFullYear(),time.getMonth(),time.getDate(),time.getHours(),time.getMinutes()]
        });
        $("#stime").datetimePicker({
            value: ['2017','12','06','17','12']
        });
        $("#etime").datetimePicker({
            value: ['2017','12','06','17','12']
        });
        $.init();
    })

    function GetLocal(){
        if($('#signstatus').html()=='今天已经签到'){
            alert('已经签到过，不用重复签到');
            return false;
        }
        var data = $('#data').val().split(",");
        wx.config({
            debug : false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId : data[0], // 必填，公众号的唯一标识
            timestamp : data[1], // 必填，生成签名的时间戳
            nonceStr : data[2], // 必填，生成签名的随机串
            signature : data[3],// 必填，签名，见附录1
            jsApiList : [ 'getLocation' ]
            // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
        wx.error(function(res){
            for(var i in res){
                if(i=="errMsg" && res[i]=="config:invalid signature"){
                    var error = document.getElementById('error');
                    error.value = res[i];
                }
            }
        });
        wx.getLocation({
        type: 'wgs84',
            success : function(res) {
                var latitude = res.latitude;
                var longitude = res.longitude;
                GetAddress(latitude,longitude)
            },
            fail : function(error) {
                $.toast("获取地理位置失败，请确保开启GPS且允许微信获取您的地理位置！");
            }
        });
    }

    function GetAddress(lat,log){
//        alert(lat+','+log);die;
        $.ajax({
            type : 'get',
            url : 'http://apis.map.qq.com/ws/geocoder/v1',
            dataType:'jsonp',
            data : {
                key:"CXKBZ-VSTWX-FPR4W-ZRTNZ-5SPP7-4LBMP",//开发密钥
                location:lat+','+log,//位置坐标
                get_poi:"0",//是否返回周边POI列表：1.返回；0不返回(默认)
                coord_type:"1",//输入的locations的坐标类型,1 GPS坐标
                parameter:{"scene_type":"tohome","poi_num":20},//附加控制功能
                output:"jsonp"
            },
            success : function(data) {
                if(data.status == 0){
                    var address = data.result.formatted_addresses.recommend;
//                    $('#signstatus').html('今天已经签到');
                    window.location.href = '/school/public/index/attendance/sign?position='+address;
                }else {
                    alert("系统错误，请联系管理员！")
                }
            },
            fail : function() {
                alert("系统错误，请联系管理员！")
            }
        });
    }

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='__PUBLIC__/sm.min.js' charset='utf-8'></script>

</body>
</html>