<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"/var/www/html/school/public/../application/mobil/view/news/home.html";i:1513566979;}*/ ?>
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
        .title1{
            height: 49px;
            background-color: #28A5E5;
            line-height: 49px;
        }
        .center-item{
            display: flex;
            height: 78px;
            background-color: #FFFFFF;
            border-bottom: 0.1px solid #c2ccd1;
        }
        .item-img{
            align-content: center;
            margin: 15pt 11pt 15pt 15pt;
        }
        .item-p{
            align-content:center;
            padding-top: 2px;
        }
        .item-p1{
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
            font-family: PingFang-SC-Bold;
        }
        .item-p2{
            margin-top: 5px;
            margin-bottom: 22px;
            color: #999999;
            font-size: 14px;
            font-family: PingFang-SC-Medium;
        }
        .item-img img{
            border-radius:6px 6px 6px 6px;
            width: 47px;
            height: 47px;
        }
        .titleh{
            color: #FFFFFF;
            margin-top: 0.2rem;
            font-size: 16px;
            font-family: PingFang-SC-Bold;
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
        <!-- 标题栏 -->
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title titleh">消息中心</h1>
        </header>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="center-item" onclick="javascript:window.location.href = '<?php echo url('news/sysnews'); ?>'">
                <div class="item-img">
                    <img class="pull-right" src="__IMG__/ios/icon_system_message@3x.png"></label>
                </div>
                <div class="item-p">
                <p class="item-p1">系统消息</p>
                <p class="item-p2" style="width: 200px;height: 20px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden"><?php echo $sys['0']['content']; ?></p></div>
            </div>
            <div class="center-item" onclick="javascript:window.location.href = '<?php echo url('news/transnews'); ?>'">
                <div class="item-img">
                    <img class="pull-right" src="__IMG__/ios/icon_handover_message@3x.png"></label>
                </div>
                <div class="item-p">
                <p class="item-p1">交接消息</p>
                <p class="item-p2" style="width: 200px;height: 20px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden"><?php echo $tran['0']['content']; ?></p></div>
            </div>
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