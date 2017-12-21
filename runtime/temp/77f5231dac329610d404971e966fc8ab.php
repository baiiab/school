<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\student\lst.html";i:1513676029;}*/ ?>
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
        .center-item{
            display: flex;
            height: 75px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #F5F5F5;
        }
        .item-img{
            align-content: center;
            margin: 16px 15px 15px 20px;
        }
        .item-p{
            align-content:center;
        }
        .item-p1{
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
            font-family: SFUIDisplay-Medium;
        }
        .item-p2{
            margin-top: 1px;
            margin-bottom: 25px;
            color: #999999;
            font-size: 14px;
            font-family: SFUIDisplay-Regular;
        }
        .item-img img{
            border-radius:40px;
            width: 45px;
            height: 45px;
        }
        .title1{
            height: 49px;
            background-color: #28A5E5;
            line-height: 49px;
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
        <!-- 标题栏 -->
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left external" href="<?php echo url('guardian/home'); ?>" style="color: #FFFFFF" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title titleh">我的学员</h1>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external tooltex" style="color: #FFFFFF;" href="<?php echo url('student/addStudent'); ?>">
                添加学员
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <?php if(is_array($student) || $student instanceof \think\Collection || $student instanceof \think\Paginator): $i = 0; $__LIST__ = $student;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="center-item" onclick="javascript:window.location.href = '<?php echo url('student/detail',['id'=>$vo['sid']]); ?>'">
                <div class="item-img">
                    <img src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>"></div>
                <div class="item-p">
                    <p class="item-p1"><?php echo $vo['name']; ?></p>
                    <p class="item-p2"><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
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