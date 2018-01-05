<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/var/www/html/school/public/../application/index/view/student/addgroup.html";i:1513675763;}*/ ?>
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
            border-bottom: 1px solid #CCCCCC;
            height: 60px;
            line-height: 60px;
            background-color: #FFFFFF;
        }
        .smalltex{
            color: #666666;
            font-family: SFUIDisplay-Regular;
            font-size: 14px;
        }
        .boldtex{
            font-family: PingFang-SC-Medium;
            font-size: 14px;
            color: #999999;
        }
        .boldtex2{
            font-family: SFUIDisplay-Regular;
            font-size: 16px;
            color: #333333;
        }
        img {
            width: 35px;
            height: 35px;
            margin-right: 0.5rem;
            border-radius: 35px;
        }
        .commo{
            margin-top: 10px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
            border-top: 1px solid #CCCCCC;
            display: flex;
        }
        .commo1{
            flex-grow: 1;
        }
        .commo2{
            flex-grow: 1;
        }
        .commo3{
            height: 50px;
            padding-left: 40%;
            line-height: 50px;
            border-bottom: 1px solid #CCCCCC;
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
        .tooltex{
            font-size: 16px;
            font-family: PingFang-SC-Medium;
            background-color: #28A5E5;
        }
        .bar .icon{
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title titleh">添加分组</h1>
        </header>

        <nav class="bar bar-tab tooltex" id="tools">
            <span class="tab-item external" id="change">
                <span class="tab-label" style="color: #FFFFFF">确定</span>
            </span>
        </nav>

        <div class="content">
            <div class="common" style="background-color: #FFFFFF;border-bottom: 0.1rem solid #c2ccd1;">
                <span class="pull-right"><input class="boldtex" id="name" value="<?php echo $name; ?>" style="text-align: right;margin-right: 18px;border: none" placeholder="请输入分组名称"></span>
                <span class="boldtex2" style="margin-left: 0.5rem">分组名称</span>
            </div>
            <input type="hidden" value="" id="sgid">
            <input type="hidden" value="<?php echo $cid['sids']; ?>" id="sids">
            <div class="commo">
                <div class="commo1"><p style="margin-top: 12px"><span class="boldtex2" style="margin-left: 0.5rem">分组学员</span></p>
                </div>

                <div class="commo2">
                    <div class="commo3" id="chooses">
                        <span class="smalltex pull-right" style="margin-right: 16px"><span class="icon icon-right"></span></span></div>
                    <?php if(is_array($student) || $student instanceof \think\Collection || $student instanceof \think\Paginator): $i = 0; $__LIST__ = $student;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="commo3">
                        <img style="float: left;margin-top: 0.3rem" src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>">
                            <span class=" smalltex" style="float: left"><?php echo $vo['name']; ?></span></div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script>
    $(function () {
        $('#chooses').click(function () {
            window.location.href = '/school/public/index/student/chooses?sgid='+$('#sgid').val()+','+$('#name').val();
        });
        $('#change').click(function () {
            window.location.href = '/school/public/index/student/change?sgid='+$('#sgid').val()+'&sids='+$('#sids').val()+'&name='+$('#name').val();
        });

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