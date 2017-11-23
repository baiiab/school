<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\transinfo\lst.html";i:1511435343;}*/ ?>
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
            width: 4rem;
            height: 4rem;
            border: none;
            float: left;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .news-image img {
            width: 4rem;
            height: 4rem;
        }
        .news-item p{
            margin-top: 0.2rem;
            margin-left: 5rem;
            margin-bottom: 0.1rem;
        }
        .smalltex{
            color: #8c8c8c;
            font-size: 0.8rem;
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
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <div class="searchbar" style="text-align: center">
                <a class="searchbar-cancel" id='search'>搜索</a>
                <div class="search-input">
                    <label class="icon icon-search" for="search"></label>
                    <input type="search" id="searchval" placeholder='输入关键字...'/>
                </div>
            </div>
        </header>


        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external active" href="">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_situation_actived@3x.png"></span>
                <span class="tab-label">学员情况</span>
            </a>
            <a class="tab-item external" href="<?php echo url('transinfo/handtran'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_students_transition_unactived@3x.png"></span>
                <span class="tab-label">学员交接</span>
            </a>
            <a class="tab-item external" href="<?php echo url('guardian/home'); ?>">
                <span class="icon"><img class="smallimg" src="__IMG__/ios/icon_person_center_unactived@3x.png"></span>
                <span class="tab-label">个人中心</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="news-item clearfix">
                <div class="news-image">
                    <img style="margin-right: 0.5rem;margin-top: 0.3rem" class="pull-right" src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>">
                </div>
                <p><?php echo $vo['name']; ?><span class="pull-right smalltex"><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></span></p>
                <p class="smalltex"><?php echo $vo['reason']; ?><span class="pull-right smalltex">驳回人：<?php echo $vo['gname']; ?></span></p>
                <p class="pull-right smalltex"><?php echo date("Y-m-d H:m",strtotime($vo['backtime'])); ?></p>
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
    $(function () {
        $('#search').click(function () {
            if($('#searchval').val()=='') return false;
            window.location.href = 'searchStudent?name='+$('#searchval').val();
        });
    })

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