<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\student\addstudent.html";i:1513913678;}*/ ?>
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
        .common {
            padding-left: 10px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
            border-top: 1px solid #CCCCCC;
        }

        .titleh {
            color: #FFFFFF;
            margin-top: 0.2rem;
            font-size: 16px;
            font-family: PingFang-SC-Bold;
        }

        .title1 {
            height: 2.5rem;
            background-color: #28A5E5;
            line-height: 2.5rem;
        }

        .tooltex {
            font-size: 16px;
            font-family: PingFang-SC-Medium;
            background-color: #28A5E5;
        }

        .common-top {
            height: 90px;
            display: flex;
            margin-top: 15px;
            line-height: 90px;
            padding-left: 10px;
            background-color: #FFFFFF;
            border-top: 0.01rem solid #c2ccd1;
        }

        hr {
            height: 1px;
            border: none;
            border-top: 1px solid #CCCCCC;
        }

        .boldtex {
            font-size: 16px;
            color: #333333;
            font-family: PingFang-SC-Medium;
        }

        .smalltex {
            font-family: SFUIDisplay-Regular;
            font-size: 14px;
            color: #666666;
        }

        .myspan {
            font-size: 16px;
            color: #333333;
            align-content: center;
            flex-grow: 1;
            font-family: PingFang-SC-Medium;
        }

        .bar .icon {
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }

        .common-top img {
            width: 65px;
            height: 65px;
            /*align-content: center;*/
            margin: 14px 15px;
            border-radius: 60px;
        }

        select {
            border: none;
            /*很关键：将默认的select选择框样式清除*/
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;

            background: #FFFFFF;
            /*加padding防止文字覆盖*/
            padding-right: 14px;
        }

        /*清除ie的默认选择框样式清除，隐藏下拉箭头*/
        select::-ms-expand {
            display: none;
        }

        #clipArea {
            margin: 50px 10px 10px 10px;
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
    <div class="page page-current">
        <!-- 标题栏 -->

        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title titleh">添加学员</h1>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab" onclick="submitform();">
            <a class="tab-item external tooltex" style="color: #FFFFFF">
                保存
            </a>
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
                            <label id="image" for="file"><img style="margin-right: 0.7rem"
                                                              src="__IMG__/ios/icon_add_head_portrait@3x.png"></label>
                            <input type="file" id="file" style="display: none"/></div>
                        <input type="hidden" id="headimg" name="headimg" value="0">
                    </div>
                    <div class="common">
                        <p class="smalltex"><input class="pull-right"
                                                   style="text-align: right;margin-right: 0.5rem;border: 0px;outline:none;"
                                                   name="name" placeholder="请输入学员姓名">
                            <span class="boldtex">学员姓名</span></p>
                        <hr/>
                        <p class="smalltex"><input class="pull-right" required type="number"
                                                   style="text-align: right;margin-right: 0.5rem;border: 0px;outline:none;"
                                                   name="sid" placeholder="请输入学员学号">
                            <span class="boldtex">学号</span></p>
                        <hr/>
                        <p class="pull-right buttons-row smalltex" style="margin-top: 0.4rem;margin-right: 0.7rem"><span
                                id="male" class="button active">男</span><span id="female" class="button">女</span></p>
                        <input type="hidden" value="男" name="sex" id="sex">
                        <p><span class="boldtex">性别</span></p>
                        <hr/>
                        <p class="smalltex"><span class="icon icon-down pull-right" id="sp"
                                                  style="margin-right: 0.5rem;"></span>
                            <select class="pull-right" id="cid" name="cid" onmousedown="if(this.options.length>3){this.size=5}" onblur="this.size=0" onchange="this.size=0">
                                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['cid']; ?>"><?php echo $vo['cid']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <span class="boldtex">班级</span></p>
                    </div>
                </form>
            </div>
        </div>

        <!-- 其他的单个page内联页（如果有） -->
    </div>
</div>
<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->

<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script src="__PUBLIC__/jquery-2.1.1.min.js"></script>
<script src="__PUBLIC__/iscroll-zoom.js"></script>
<script src="__PUBLIC__/hammer.js"></script>
<script src="__PUBLIC__/jquery.photoClip.js"></script>
<script>
    $(function () {
        $('#clipphoto').hide();
        $('#male').click(function () {
            $('#sex').val('男');
            document.getElementById("female").setAttribute("class", "button");
            document.getElementById("male").setAttribute("class", "button active");
        });
        $('#cid').click(function () {
            document.getElementById("sp").setAttribute("class", "icon icon-right pull-right");
        });
        $('#cid').change(function () {
            document.getElementById("sp").setAttribute("class", "icon icon-down pull-right");
        });
        $('#female').click(function () {
            $('#sex').val('女');
            document.getElementById("male").setAttribute("class", "button");
            document.getElementById("female").setAttribute("class", "button active");
        });
        $('#cancel').click(function () {
            $('#clipphoto').hide();
            $('#ordinary').show();
            $('.bar-tab ~ .content').css('bottom','2.5rem');
            $('.bar-tab ~ .content').css('top','2.3rem');
            $('header').css('display','block');
            $('nav').css('display','block');
        });

    })
    $("#clipArea").photoClip({
        width: 200,
        height: 200,
        file: "#file",
        view: "#view",
        ok: "#clipBtn",
        loadStart: function () {
            console.log("照片读取中");
        },
        loadComplete: function () {
            console.log("照片读取完成");

        },
        clipFinish: function (dataURL) {
            $('#clipphoto').hide();
            $('#ordinary').show();
            $('.bar-tab ~ .content').css('bottom','2.5rem');
            $('.bar-tab ~ .content').css('top','2.3rem');
            $('header').css('display','block');
            $('nav').css('display','block');
            document.getElementById('image').getElementsByTagName('img')[0].src = dataURL;
            $('#headimg').val(dataURL);
        }
    });
    document.getElementById('file').onchange = function () {
        $('#clipphoto').show();
        $('#ordinary').hide();
        $('header').css('display','none');
        $('nav').css('display','none');
        $('.bar-tab ~ .content').css('bottom','0rem');
        $('.bar-tab ~ .content').css('top','0rem');
//        var imgFile = this.files[0];
//        var fr = new FileReader();
//        fr.onload = function() {
//            document.getElementById('image').getElementsByTagName('img')[0].src = fr.result;
//        };
//        fr.readAsDataURL(imgFile);
    };

    function submitform() {
        if ($('#name').val() == '' || $('#headimg').val() == '0') {
            alert('没有上传头像或名字为空，请确认');
            return false;
        }
        document.getElementById('myForm').submit();
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