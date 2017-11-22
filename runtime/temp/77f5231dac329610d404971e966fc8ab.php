<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\student\lst.html";i:1511249593;}*/ ?>
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

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <style type="text/css">
        .news-item {
            min-height: 5rem;
            position: relative;
            padding-left: 1rem;
            padding-top: 1rem;
            border-bottom: 0.1rem solid #c2ccd1;
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
            width: 3rem;
            height: 3em;
            border: none;
            float: left;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .news-image img {
            width: 3rem;
            height: 3rem;
        }
        .news-item p{
            margin-top: 0.1rem;
            margin-left: 5rem;
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <a class="button button-link button-nav pull-left back" href="" data-transition='slide-out'>
                <span class="icon icon-left"></span>
                返回
            </a>
            <h1 class="title">我的学员</h1>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external" href="<?php echo url('student/addStudent'); ?>" style="background: dodgerblue;color: white;">
                添加学员
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <?php if(is_array($student) || $student instanceof \think\Collection || $student instanceof \think\Paginator): $i = 0; $__LIST__ = $student;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="news-item clearfix" onclick="javascript:window.location.href = '<?php echo url('student/detail',['id'=>$vo['sid']]); ?>'">
                <div class="news-image">
                    <a href="#"><img src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>"></a>
                </div>
                <p><?php echo $vo['name']; ?></p>
                <p><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
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