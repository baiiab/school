<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/var/www/html/school/public/../application/mobil/view/teacher/detail.html";i:1513676028;}*/ ?>
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
            height: 2.5rem;
            background-color: #28A5E5;
            line-height: 2.5rem;
        }
        div .common{
            margin-top: 15px;
            padding-left: 1rem;
            background-color: #FFFFFF;
            border-top: 1px solid #CCCCCC;
            border-bottom: 1px solid #CCCCCC;
        }
        hr {
            border: none;
            height: 3px;
            border-bottom: 1px solid #CCCCCC;
        }
        .boldtex{
            font-family: PingFang-SC-Medium;
            font-size: 16px;
            color: #333333;
        }
        .mobiltex{
            font-family: SFUIDisplay-Regular;
            font-size: 14px;
            color: #666666;
            text-align: right;
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
            <h1 class="title titleh" style="color: #FFFFFF;">教师详情</h1>
        </header>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="common">
                <p><span class="pull-right mobiltex" style="margin-right: 0.5rem"><?php echo $teacher['tname']; ?></span>
                    <span class="boldtex">教师姓名</span></p>
            <hr/>
                <p><span class="pull-right mobiltex" style="margin-right: 0.5rem"><?php echo $teacher['gender']; ?></span>
                    <span class="boldtex">性别</span></p>
            <hr/>
                <p><span class="pull-right mobiltex" style="margin-right: 0.5rem"><?php echo $teacher['course']; ?></span>
                    <span class="boldtex">主教科目</span></p>
            <hr/>
                <p><span class="pull-right mobiltex" style="margin-right: 0.5rem"><?php echo $teacher['position']; ?></span>
                    <span class="boldtex">职位</span></p>
            <hr/>
                <p><span class="pull-right mobiltex" style="margin-right: 0.5rem"><?php echo $teacher['mobile']; ?></span>
                    <span class="boldtex">联系方式</span></p>
            </div>

            <div class="common">
                <?php if(is_array($cids) || $cids instanceof \think\Collection || $cids instanceof \think\Paginator): $i = 0; $__LIST__ = $cids;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <p><?php if($cids['0'] == $vo): ?><span class="boldtex">所属班级</span><?php endif; ?>
                    <span class="pull-right mobiltex" style="margin-right: 0.5rem;<?php if(count($cids) != 1): ?>border-bottom: 0.1rem solid #c2ccd1;<?php endif; ?>width: 8rem"><?php echo $vo; ?></span></p>
                <?php if($cids['0'] != $vo): ?><br/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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