<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/var/www/html/school/public/../application/mobil/view/student/detail.html";i:1513680530;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>个人中心</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="__PUBLIC__/sm.min.css">
    <style type="text/css">
        .common{
            padding-left: 10px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
            border-top: 1px solid #c2ccd1;
        }
        .title1{
            height: 2.5rem;
            background-color: #28A5E5;
            line-height: 2.5rem;
        }
        .common-top{
            height: 90px;
            display: flex;
            line-height: 90px;
            padding-left: 10px;
            background-color: #FFFFFF;
            border-top: 1px solid #CCCCCC;
        }
        .bar .icon{
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }
        .myspan{
            font-size: 16px;
            color: #333333;
            align-content: center;
            flex-grow: 1;
            font-family: PingFang-SC-Medium;
        }
        .common-top img{
            width: 65px;
            height: 65px;
            align-content: center;
            margin: 14px 15px;
            border-radius: 60px;
        }
        .boldtex{
            font-size: 16px;
            color: #333333;
            font-family: PingFang-SC-Medium;
        }
        .smalltex{
            font-family: SFUIDisplay-Regular;
            font-size: 14px;
            color: #666666;
        }
        hr {
            height: 1px;
            border: none;
            border-top: 1px solid #CCCCCC;
        }
        .titleh{
            color: #FFFFFF;
            margin-top: 0.2rem;
            font-size: 16px;
            font-family: PingFang-SC-Bold;
        }
        .tooltex{
            font-size: 16px;
            font-family: PingFang-SC-Medium;
            background-color: #F04545;
        }
        #clipArea {
            margin: 50px 0px 10px 0px;
            height: 300px;
        }
        .logout{
            margin: 2rem 1rem 0rem 1rem;
            height: 40px;
            border-radius: 6px 6px 6px 6px;
            background-color: #F04545;
            line-height: 40px;
            text-align: center;
        }
        .logout a{
            font-family: PingFang-SC-Medium;
            font-size: 16px;
            height: 20px;
            color: #FFFFFF;
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page page-current" id='router'>
        <!-- 标题栏 -->
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title titleh">学员详情</h1>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab confirm-title-ok">
            <a class="tab-item tooltex" style="color: #FFFFFF;">删除学员</a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div id="clipphoto">
                <div id="clipArea" style="background-color: black"></div>
                <div class="logout" id="clipBtn" style="background-color: #28A5E5">
                    <a class="external">截取</a></div>
                <div class="logout" id="cancel">
                    <a class="external">取消</a></div>
            </div>

            <div id="ordinary">
            <form id="myForm" action="" enctype="multipart/form-data" method="post">
                <div class="common-top">
                    <div class="myspan">头像</div>
                    <div class="common-top-img">
                        <label id="image" for="file"><img style="margin-right: 0.7rem" src="<?php if($student['headimg'] != ''): ?>__PIC__<?php echo $student['headimg']; else: ?>__IMG__/ios/icon_add_head_portrait@3x.png<?php endif; ?>"></label>
                        <input type="file" id="file" style="display: none"/></div>
                    <input type="hidden" id="sid" name="id" value="<?php echo $student['sid']; ?>">
                    <input type="hidden" id="headimg" name="headimg">
                </div>
            </form>

            <div class="common">
                <p><span class="pull-right smalltex" style="margin-right: 0.5rem"><?php echo $student['name']; ?></span>
                    <span class="boldtex">学员姓名</span></p>
                <hr/>
                <p><span class="pull-right smalltex" style="margin-right: 0.5rem"><?php echo $student['sex']; ?></span>
                    <span class="boldtex">性别</span></p>
                <hr/>
                <p><span class="pull-right smalltex" style="margin-right: 0.5rem"><?php echo $student['cid']; ?></span>
                    <span class="boldtex">班级</span></p>
            </div>
        </div></div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script type="text/javascript" src="/school/public/static/common/myJs.js"></script>
<script>
    $(document).on('click','.confirm-title-ok', function () {
        if(confirm('是否确定删除该学员?')){
            location.href = "/school/public/mobil/student/del?sid="+$('#sid').val();
        }
    });
</script>
<script src="__PUBLIC__/jquery-2.1.1.min.js"></script>
<script src="__PUBLIC__/iscroll-zoom.js"></script>
<script src="__PUBLIC__/hammer.js"></script>
<script src="__PUBLIC__/jquery.photoClip.js"></script>
<script>
    $(function(){
        $('#clipphoto').hide();

        $('#cancel').click(function () {
            $('#clipphoto').hide();
            $('#ordinary').show();
            $('.bar-tab ~ .content').css('bottom','2.5rem');
            $('.bar-tab ~ .content').css('top','2.3rem');
            $('header').css('display','block');
            $('nav').css('display','block');
        });
//        $.init();
    })
    document.getElementById('file').onchange = function() {
        $('#clipphoto').show();
        $('#ordinary').hide();
        $('header').css('display','none');
        $('nav').css('display','none');
        $('.bar-tab ~ .content').css('bottom','0rem');
        $('.bar-tab ~ .content').css('top','0rem');
    };
    $("#clipArea").photoClip({
        width: 200,
        height: 200,
        file: "#file",
        view: "#view",
        ok: "#clipBtn",
        loadStart: function() {
            console.log("照片读取中");
        },
        loadComplete: function() {
            console.log("照片读取完成");
        },
        clipFinish: function(dataURL) {
            $('#clipphoto').hide();
            $('#ordinary').show();
            document.getElementById('image').getElementsByTagName('img')[0].src = dataURL;
            $('#headimg').val(dataURL);
            document.getElementById("myForm").submit();
//            console.log(dataURL);
        }
    });

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='__PUBLIC__/sm.min.js' charset='utf-8'></script>

</body>
</html>