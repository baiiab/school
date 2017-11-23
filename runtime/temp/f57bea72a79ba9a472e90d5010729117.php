<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\news\transnews.html";i:1511334135;}*/ ?>
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

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <style type="text/css">
        .content {

        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page page-current">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <a class="button button-link button-nav pull-left back" href="" data-transition='slide-out'>
                <span class="icon icon-left"></span>

            </a>
            <h1 class="title">交接消息</h1>
        </header>

        <!-- 你的html代码 -->
        <div class="content" style="padding:1rem 1rem 0 1rem">
            <?php if(is_array($tran) || $tran instanceof \think\Collection || $tran instanceof \think\Paginator): $i = 0; $__LIST__ = $tran;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div style="text-align: center;margin-bottom: 1.5rem">
                <p style="font-size: smaller;color: #8c8c8c;"><?php echo date("Y-m-d H:m",$vo['sendtime']); ?></p>
                <div style="padding: 0.5rem;width: 100%;background-color: white;border: 0.06rem solid #d3d3d3;border-radius: 0.3rem;">
                    <?php echo $vo['content']; ?>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script>
    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
</body>
</html>