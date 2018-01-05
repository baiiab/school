<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"/var/www/html/school/public/../application/mobil/view/teacher/lst.html";i:1513676029;}*/ ?>
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
            padding-left: 1rem;
            background-color: #FFFFFF;
            border-top: 1px solid #CCCCCC;
        }
        hr {
            height: 1px;
            border: none;
            border-top: 1px solid #CCCCCC;
        }
        .boldtex{
            font-family: SFUIDisplay-Semibold;
            color: #333333;
            font-size: 14px;
        }
        .bar .icon{
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }
        .smalltex{
            font-family: PingFang-SC-Medium;
            color: #666666;
            font-size: 14px;
        }
        .mobiltex{
            font-family: SFUIDisplay-Regular;
            color: #666666;
            font-size: 14px;
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
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav title1">
            <a class="button button-link button-nav pull-left back" style="color: #FFFFFF" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title titleh" style="color: #FFFFFF">教师通讯录</h1>
        </header>

        <!-- 工具栏 -->

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="common">
            <?php if(is_array($teachers) || $teachers instanceof \think\Collection || $teachers instanceof \think\Paginator): $i = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div onclick="javascript:window.location.href = '<?php echo url('teacher/detail',['id'=>$vo['tid']]); ?>'">
                <p style="margin-bottom: 0.01rem"><span class="pull-right smalltex" style="margin-right: 0.5rem"><?php echo $vo['position']; ?></span>
                    <span class="boldtex"><?php echo $vo['tname']; ?>&nbsp;<?php echo $vo['gender']; ?></span></p>
                <p style="margin-top: 0.01rem"><span class="pull-right mobiltex" style="margin-right: 0.5rem"><?php echo $vo['mobile']; ?></span>
                    <span class="smalltex">主教科目：<?php echo $vo['course']; ?></span></p>
            </div>
                <hr/>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script>
    $(function(){
        $(document).on('click','.confirm-title-ok', function () {
            $.confirm('是否确定删除该学员', '删除学员', function () {
                location.href = "/school/public/mobil/student/del?sid="+$('#sid').val();
            });
        });
    })

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='__PUBLIC__/sm.min.js' charset='utf-8'></script>

</body>
</html>