<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\guardian\home.html";i:1511435066;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的生活</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <style type="text/css">
        .news-item {
            min-height: 5rem;
            position: relative;
            padding-left: 1rem;
            padding-top: 1rem;
            border-bottom: 0.1rem solid #c2ccd1;
        }

        .clearfix:after {
            display: block;
            content: '.';
            clear: both;
            height: 0;
            font-size: 0;
            line-height: 0;
            overflow: hidden;
        }

        .news-image {
            width: 4rem;
            height: 4rem;
            border: none;
            float: left;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .news-image img {
            width: 4rem;
            height: 4rem;
        }
        .news-item p{
            margin-top: 0.5rem;
            margin-left: 5rem;
        }
        div .common{
            margin-top: 0.5rem;
            padding-left: 1rem;
            border-bottom: 0.1rem solid #c2ccd1;
            border-top: 0.1rem solid #c2ccd1;
        }
        div .common img{
            width: 1rem;
            height: 1rem;
        }
        .logout{
            margin: 1rem 2rem 0rem 2rem;
            height: 5rem;
        }
        .smallimg {
            width: 1.5rem;
            height: 1.5rem;
            margin-bottom: 1rem
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <h1 class="title">师生交接-监护人端</h1>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external" href="<?php echo url('transinfo/lst'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_situation_unactived@3x.png"></span>
                <span class="tab-label">学员情况</span>
            </a>
            <a class="tab-item external" href="<?php echo url('transinfo/handtran'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_transition_unactived@3x.png"></span>
                <span class="tab-label">学员交接</span>
            </a>
            <a class="tab-item external active" href="#">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_person_center_actived@3x.png"></span>
                <span class="tab-label">个人中心</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="news-item clearfix">
                <form id="myForm" action="" enctype="multipart/form-data" method="post">
                <div class="news-image">
                    <label id="image" for="file"><img style="margin-right: 0.5rem" class="pull-right" src="<?php if($guardian['headimg'] != ''): ?>__PIC__<?php echo $guardian['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>"></label>
                    <input type="file" id="file" name="headimg" style="display: none"/>
                </div>
                </form>
                <p><?php echo \think\Session::get('name'); ?></p>
                <p><?php echo \think\Session::get('mobile'); ?></p>
            </div>
            <div class="common">
                <p onclick="javascript:window.location.href = '<?php echo url('student/lst'); ?>'"><a class="icon icon-right pull-right" style="margin-right: 0.5rem"></a>
                    <a class="icon icon-friends pull-left"></a>
                    <span style="margin-left: 0.5rem">我的学员</span></p>
                <hr/>
                <p onclick="javascript:window.location.href = '<?php echo url('teacher/lst'); ?>'"><a class="icon icon-right pull-right" style="margin-right: 0.5rem"></a>
                    <img class="pull-left" src="__IMG__/ios/icon_students_lists@2x.png"/>
                    <span style="margin-left: 0.5rem">教师通讯录</span></p>
            </div>
            <div class="common">
                <p onclick="javascript:window.location.href = '<?php echo url('news/home'); ?>'"><a class="icon icon-right pull-right" style="margin-right: 0.5rem"></a>
                    <img class="pull-left" src="__IMG__/ios/icon_message_center@3x.png"/>
                    <span class="pull-right"
                          style="background: red;padding-left: 0.5rem;padding-right: 0.5rem; border: 0.1rem solid #8c8c8c;border-radius: 0.5rem;">99</span>
                    <span style="margin-left: 0.5rem">消息中心</span></p>
            </div>
            <div class="common">
                <p onclick="javascript:window.location.href = '<?php echo url('editpas'); ?>'"><a class="icon icon-right pull-right" style="margin-right: 0.5rem"></a>
                    <img class="pull-left" src="__IMG__/ios/icon_reset_password@3x.png"/>
                    <span style="margin-left: 0.5rem">修改密码</span></p>
            </div>
            <div class="logout">
                <a href="<?php echo url('logout'); ?>" style="margin: 1rem" class="button button-fill button-danger">退出登录</a></div>
        </div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script>
    document.getElementById('file').onchange = function() {
        var imgFile = this.files[0];
        var fr = new FileReader();
        fr.onload = function() {
            document.getElementById('image').getElementsByTagName('img')[0].src = fr.result;
        };
        fr.readAsDataURL(imgFile);
        document.getElementById('myForm').submit();
    };

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>

</body>
</html>