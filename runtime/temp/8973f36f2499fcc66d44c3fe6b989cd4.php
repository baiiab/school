<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/var/www/html/school/public/../application/index/view/teacher/home.html";i:1513841972;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>师生交接-教师端</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="__PUBLIC__/sm.min.css">
    <style type="text/css">
        div .common{
            margin-top: 0.5rem;
            padding-left: 1rem;
            background-color: #FFFFFF;
            height: 57px;
            line-height: 57px;
            border-bottom: 1px solid #CCCCCC;
            border-top: 1px solid #CCCCCC;
        }
        div .common img{
            width: 20px;
            height: 20px;
            margin-top: 19px;
        }
        .common p{
            margin: 0;
        }

        .center-item{
            display: flex;
            height: 93px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
        }
        .item-img{
            align-content: center;
            margin: 15px 17px 16px 23px;
        }

        .item-img img{
            border-radius:60px;
            width: 61px;
            height: 61px;
        }
        .item-p{
            align-content:center;
        }
        .item-p1{
            margin-top: 22px;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
            font-family: PingFang-SC-Bold;
        }
        .item-p2{
            margin-top: 1px;
            margin-bottom: 25px;
            color: #999999;
            font-size: 14px;
            font-family: SFUIDisplay-Regular;
        }
        .common-p{
            font-family: PingFang-SC-Medium;
            font-size: 15px;
            margin-left: 10px;
            color: #333333;
        }
        .logout{
            margin: 2rem 1rem 0rem 1rem;
            height: 50px;
            border-radius: 6px 6px 6px 6px;
            background-color: #F04545;
            line-height: 50px;
            text-align: center;
        }
        .logout a{
            font-family: PingFang-SC-Medium;
            font-size: 16px;
            height: 20px;
            color: #FFFFFF;
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

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external" href="<?php echo url('transinfo/handtran'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_transition_unactived@3x.png"></span>
                <span class="tab-label">学员交接</span>
            </a>
            <a class="tab-item external" href="<?php echo url('attendance/index'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_attendance_unactived@3x.png"></span>
                <span class="tab-label">考勤</span>
            </a>
            <a class="tab-item external active" href="#">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_person_center_actived@3x.png"></span>
                <span class="tab-label">个人中心</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="center-item">
                <div class="item-img">
                    <img src="__IMG__/ios/1884282706.jpg">
                </div>
                <div class="item-p">
                    <p class="item-p1"><?php echo \think\Session::get('name'); ?></p>
                    <p class="item-p2"><?php echo \think\Session::get('mobile'); ?></p>
                </div>
            </div>

            <div class="common">
                <p onclick="javascript:window.location.href = '<?php echo url('news/home'); ?>'" style="margin: 0"><a class="icon icon-right pull-right" style="margin-right: 0.5rem"></a>
                    <img class="pull-left" src="__IMG__/ios/icon_message_center@3x.png"/>
                    <?php if($news != 0): ?><span class="pull-right" style="background-color: #F04545;padding-left: 0.5rem;padding-right: 0.5rem;margin-right: 5px;height: 21px;line-height: 21px;margin-top: 17px;text-align: center;font-size: 14px;border-radius: 10px;color: #FFFFFF"><?php echo $news; ?></span><?php endif; ?>
                    <span class="common-p">消息中心</span></p>
            </div>
            <div class="common">
                <p onclick="javascript:window.location.href = '<?php echo url('student/index'); ?>'"><a class="icon icon-right pull-right" style="margin-right: 0.5rem"></a>
                    <img class="pull-left" src="__IMG__/ios/icon_students_lists@3x.png"/>
                    <span class="common-p">学员库</span></p>
            </div>
            <div class="common">
                <p onclick="javascript:window.location.href = '<?php echo url('editpas'); ?>'"><a class="icon icon-right pull-right" style="margin-right: 0.5rem"></a>
                    <img class="pull-left" src="__IMG__/ios/icon_reset_password@3x.png"/>
                    <span class="common-p">修改密码</span></p>
            </div>
            <div class="logout" onclick="javascript:window.location.href = '<?php echo url('logout'); ?>'">
                <a class="external">退出登录</a></div>
        </div>
    </div>
    <!-- 其他的单个page内联页（如果有） -->
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script>

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='__PUBLIC__/sm.min.js' charset='utf-8'></script>
</body>
</html>