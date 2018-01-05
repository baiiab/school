<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/var/www/html/school/public/../application/index/view/arrange/home.html";i:1514876888;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>教师端</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="__PUBLIC__/sm.min.css">
    <style type="text/css">
        div .common{
            padding-top: 10px;
            padding-left: 16px;
            height: 86px;
            display: flex;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
        }
        .common p{
            margin-top: 0.01rem;
            margin-bottom: 0.01rem;
        }

        .common-left{
            flex-grow: 8;
        }
        .common-right{
            flex-grow: 1;
            padding-left: 4rem;
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
        .router-boldtex{
            font-family: SFUIDisplay-Medium;
            font-size: 14px;
            color: #333333;
            font-weight: bold;
        }
        .content-block{
            margin: 0rem 0;
            padding: 0rem;
        }

        .router-smtex{
            font-family: SFUIDisplay-Regular;
            font-size: 14px;
            color: #999999;
        }
        header .icon{
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }

    </style>
</head>
<div class="page-group">
    <!-- 其他的单个page内联页（如果有） -->
    <div class="page">
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left external" href="<?php echo url('transinfo/handtran'); ?>"  style="color: #FFFFFF">
                <span class="icon icon-left" style="color: #FFFFFF"></span>
            </a>
            <h1 class='title titleh'>待安排交接</h1>
        </header>
        <div class="content">
            <div class="buttons-tab">
                <a href="#tab1" id="tabb1" class="tab-link active button">班级</a>
                <a href="#tab2" id="tabb2" class="tab-link button">分组</a>
            </div>
            <div class="content-block">
                <div class="tabs">
                    <div id="tab1" class="tab active">
                        <div class="content-block">
                            <?php if(is_array($class) || $class instanceof \think\Collection || $class instanceof \think\Paginator): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="common" onclick="javascript:window.location.href = '<?php echo url('arrange/index',['cid'=>$vo['cid']]); ?>'">
                                <div class="common-left" style="margin-top: 21px">
                                    <p  class="router-boldtex"><?php echo $vo['cid']; ?></p>
                                </div>
                                <div class="common-right pull-right">
                                    <p class="router-smtex">学员数：<?php echo $vo['num']; ?>名</p>
                                    <p class="router-smtex">已确认：<?php echo $vo['confirmed']; ?>名</p>
                                    <p class="router-smtex">已驳回：<?php echo $vo['back']; ?>名</p>
                                </div>
                                <div class="pull-right" style="display: inline-block;width: 5%;margin-top: 20px;margin-right: 10px">
                                    <p class="icon icon-right"></p></div>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div id="tab2" class="tab">
                        <div class="content-block">
                            <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="common" onclick="javascript:window.location.href = '<?php echo url('arrange/index',['group'=>$vo['name']]); ?>'">
                                <div class="common-left" style="margin-top: 21px">
                                    <p class="router-boldtex"><?php echo $vo['name']; ?></p>
                                </div>
                                <div class="common-right pull-right">
                                    <p class="router-smtex">学员数：<?php echo $vo['num']; ?>名</p>
                                    <p class="router-smtex">已确认：<?php echo $vo['confirmed']; ?>名</p>
                                    <p class="router-smtex">已驳回：<?php echo $vo['back']; ?>名</p>
                                </div>
                                <div class="pull-right" style="display: inline-block;width: 5%;margin-top: 20px;margin-right: 10px">
                                    <p class="icon icon-right"></p></div>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

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