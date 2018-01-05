<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/var/www/html/school/public/../application/index/view/transinfo/handtran.html";i:1513566905;}*/ ?>
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
        .news-item {
            height: 127px;
            padding-left: 25px;
            border: 1px solid #E6E6E6;
            border-radius: 8px;
            width: 300px;

            margin-top: 2rem;
            margin-left: auto;
            margin-right: auto;
            display: flex;
        }

        .news-image{
            width: 50px;
            height: 50px;
            margin-top: 35px;
            align-content: center;
        }
        .news-image img{
            width: 50px;
            height: 50px;
        }
        .news-item-p{
            margin-left: 10px;
            align-content: center;
        }
        .smalltex{
            color: #666666;
            font-size: 14px;
            margin-top: 2px;
            font-family: SFUIDisplay-Regular;
        }
        div .common{
            padding-top: 20px;
            padding-left: 16px;
            height: 99px;
            display: flex;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
        }
        .common p{
            margin-top: 0.01rem;
            margin-bottom: 0.01rem;
        }

        .common-left{
            flex-grow: 5;
            overflow: hidden;
        }
        .common-right{
            flex-grow: 1;
            margin-right: 5px;
        }
        .smallimg {
            width: 1.5rem;
            height: 1.5rem;
            margin-bottom: 1rem
        }

        .boldtex {
            font-size: 16px;
            margin-top: 35px;
            margin-bottom: 1px;
            font-family: PingFang-SC-Bold;
            color: #333333;
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
            font-family: PingFang-SC-Bold;
            font-size: 14px;
            color: #333333;
        }
        .router-time{
            font-family: SFUIDisplay-Regular;
            font-size: 12px;
            color: #999999;
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
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page page-current" id='router'>
        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external active" href="">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_transition_actived@3x.png"></span>
                <span class="tab-label">学员交接</span>
            </a>
            <a class="tab-item external" href="<?php echo url('attendance/index'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_attendance_unactived@3x.png"></span>
                <span class="tab-label">考勤</span>
            </a>
            <a class="tab-item external" href="<?php echo url('teacher/home'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_person_center_unactived@3x.png"></span>
                <span class="tab-label">个人中心</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <a href="#router2"><div class="news-item" style="background-color: #E8F3F8">
                <div class="news-image">
                    <img src="__IMG__/ios/icon_pending_handover@3x.png">
                </div>
                <div class="news-item-p">
                <p class="boldtex">待确认交接</p>
                <p class="smalltex">目前您有<?php echo $gp; ?>名学员等待确认</p></div>
            </div></a>
            <a class="external" href="<?php echo url('arrange/home'); ?>"><div class="news-item" style="background-color: #F4FDF1">
                <div class="news-image">
                    <img src="__IMG__/ios/icon_arranged_handover@3x.png">
                </div>
                <div class="news-item-p">
                <p class="boldtex">待安排交接</p>
                <p class="smalltex">目前您有<?php echo $tp; ?>名学员等待安排</p></div>
            </div></a>
    </div>
    </div>
    <!-- 其他的单个page内联页（如果有） -->
    <div class="page" id='router2'>
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left external" style="color: #FFFFFF" href="<?php echo url('transinfo/handtran'); ?>">
                <span class="icon icon-left" style="color: #FFFFFF"></span>
            </a>
            <h1 class='title titleh'>待确认交接</h1>
        </header>
        <div class="content">
            <?php if(is_array($peo) || $peo instanceof \think\Collection || $peo instanceof \think\Paginator): $i = 0; $__LIST__ = $peo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="common" onclick="javascript:window.location.href = '<?php echo url('transinfo/recedetail',['tid'=>$vo['tid']]); ?>'">
                <div class="common-left" style="margin-top: 0.2rem">
                    <p class="router-boldtex" style="width: 190px;height: 20px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden">安排交接人：<?php echo $vo['name']; ?></p>
                    <p class="router-time" style="margin-top: 5px">安排时间：<?php echo date('Y-m-d H:i',$vo['sendtime']); ?></p>
                </div>
                <div class="common-right " style="margin-top: 0.01rem;">
                    <p class="router-smtex">学员数：<?php echo $vo['num']; ?>名</p>
                    <p class="router-smtex">已确认：<?php echo $vo['confirm']; ?>名</p>
                    <p class="router-smtex">已驳回：<?php echo $vo['back']; ?>名</p>
                </div>
                <div class="pull-right" style="display: inline-block;width: 5%;margin-top: 1rem;margin-right: 10px">
                    <p class="icon icon-right"></p></div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
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