<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\student\detail.html";i:1512288623;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>师生交接-监护人端</title>
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
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title titleh">学员详情</h1>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item confirm-title-ok tooltex" style="color: #FFFFFF;">删除学员</a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="common-top">
                <div class="myspan">头像</div>
                <img class="pull-right" src="<?php if($student['headimg'] != ''): ?>__PIC__<?php echo $student['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>" style="margin-right: 0.7rem">
            </div>
            <input type="hidden" id="sid" value="<?php echo $student['sid']; ?>">
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
        </div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script>
    $(function(){
        $(document).on('click','.confirm-title-ok', function () {
            $.confirm('是否确定删除该学员', '删除学员', function () {
                location.href = "/school/public/mobil/student/del?sid="+$('#sid').val();
            });
        });
        $.init();
    })

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='__PUBLIC__/sm.min.js' charset='utf-8'></script>

</body>
</html>