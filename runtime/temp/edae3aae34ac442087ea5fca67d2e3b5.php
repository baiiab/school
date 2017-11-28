<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\transinfo\handtran.html";i:1511866661;}*/ ?>
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
            padding-top: 0.1rem;
            border: 0.05rem solid #c2ccd1;
            border-radius: 0.5rem;
            width: 15rem;
            height: 7rem;
            margin-top: 2rem;
            margin-left: auto;
            margin-right: auto;
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
            padding: 0;
            margin-right: 0.2rem;
            margin-top: 1.2rem;
            margin-left: 0.1rem;
            position: relative;
        }

        .news-image img {
            width: 4rem;
            height: 4rem;
        }
        .news-item p{
            margin-top: 0.2rem;
            margin-left: 2rem;
            margin-bottom: 0.1rem;
        }
        .smalltex{
            color: #8c8c8c;
            font-size: 0.75rem;
        }
        div .common{
            margin-top: 0.5rem;
            padding-left: 0.1rem;
            height: 3.5rem;
            border-bottom: 0.05rem solid #c2ccd1;
        }
        .common p{
            margin-top: 0.01rem;
            margin-bottom: 0.01rem;
        }
        div .common img{
            width: 1rem;
            height: 1rem;
        }
        .smallimg {
            width: 1.5rem;
            height: 1.5rem;
            margin-bottom: 1rem
        }

        .boldtex {
            font-size: 0.8rem;
            font-weight: bold;
            color: black;
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page page-current" id='router'>
        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external" href="<?php echo url('transinfo/lst'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_situation_unactived@3x.png"></span>
                <span class="tab-label">学员情况</span>
            </a>
            <a class="tab-item external active" href="">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_transition_actived@3x.png"></span>
                <span class="tab-label">学员交接</span>
            </a>
            <a class="tab-item external" href="<?php echo url('guardian/home'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_person_center_unactived@3x.png"></span>
                <span class="tab-label">个人中心</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <a href="#router2"><div class="news-item clearfix" style="background-color: #CCFFFF">
                <div class="news-image">
                    <img src="__IMG__/ios/icon_pending_handover@3x.png">
                </div>
                <p class="boldtex" style="margin-top: 2rem">待确认交接</p>
                <p class="smalltex">目前您有<?php echo $gp; ?>名学员等待确认</p>
            </div></a>
            <a class="external" href="<?php echo url('arrange/index'); ?>"><div class="news-item clearfix" style="background-color: #FFFFCC">
                <div class="news-image">
                    <img src="__IMG__/ios/icon_arranged_handover@3x.png">
                </div>
                <p class="boldtex" style="margin-top: 2rem;">待安排交接</p>
                <p class="smalltex">目前您有<?php echo $tp; ?>名学员等待安排</p>
            </div></a>
    </div>
    </div>
    <!-- 其他的单个page内联页（如果有） -->
    <div class="page" id='router2'>
        <header class="bar bar-nav">
            <a class="button button-link button-nav pull-left external" href="<?php echo url('transinfo/handtran'); ?>">
                <span class="icon icon-left"></span>
            </a>
            <h1 class='title'>待确认交接</h1>
        </header>
        <div class="content">
            <?php if(is_array($peo) || $peo instanceof \think\Collection || $peo instanceof \think\Paginator): $i = 0; $__LIST__ = $peo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="common" onclick="javascript:window.location.href = '<?php echo url('transinfo/recedetail',['tid'=>$vo['tid']]); ?>'">
                <div style="width: 63%;display: inline-block;margin-top: 0.2rem">
                    <p class="boldtex">安排交接人：<?php echo $vo['name']; ?></p>
                    <p class="smalltex">安排时间：<?php echo date('Y-m-d H:i',$vo['sendtime']); ?></p>
                </div>
                <div style="width: 30%;display: inline-block;margin-top: 0.01rem">
                    <p class="smalltex">学员数：<?php echo $vo['num']; ?></p>
                    <p class="smalltex">已确认：<?php echo $vo['confirm']; ?></p>
                    <p class="smalltex">已驳回：<?php echo $vo['back']; ?></p>
                </div>
                <div class="pull-right" style="display: inline-block;width: 5%;margin-top: 1.1rem">
                    <p class="icon icon-right"></p></div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>

</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script>

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