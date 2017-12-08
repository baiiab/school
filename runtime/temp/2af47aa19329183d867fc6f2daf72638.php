<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\news\sysnews.html";i:1512288931;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>监护人端</title>
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
        .smalltex{
            color: #999999;
            font-size: 12px;
            font-family: SFUIDisplay-Regular;
            margin-bottom: 10px;
        }
        .boldtex{
            font-size: 14px;
            color: #333333;
            font-family: PingFang-SC-Medium;
        }
        .bar .icon{
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }
        .pane{
            background-color: #FFFFFF;
            border: 1px solid #CCCCCC;
            border-radius: 4px 4px 4px 4px;
            text-align: left;
            padding: 15px;
        }
        .titleh{
            color: #FFFFFF;
            margin-top: 0.2rem;
            font-size: 16px;
            font-family: PingFang-SC-Bold;
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
            <h1 class="title titleh">系统消息</h1>
        </header>

        <!-- 你的html代码 -->
        <div class="content" style="padding:20px 15px 0 15px">
            <?php if(is_array($sys) || $sys instanceof \think\Collection || $sys instanceof \think\Paginator): $i = 0; $__LIST__ = $sys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div style="text-align: center;margin-bottom: 32px">
                <p class="smalltex"><?php echo date("Y-m-d H:m",$vo['sendtime']); ?></p>
                <div class="pane">
                    <span class="boldtex"><?php echo $vo['content']; ?></span>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
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