<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\teacher\detail.html";i:1511321734;}*/ ?>
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
        div .common{
            margin-top: 0.5rem;
            padding-left: 1rem;
            border-top: 0.1rem solid #c2ccd1;
        }
        div .common img{
            width: 3rem;
            height: 3rem;
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
            <h1 class="title">教师详情</h1>
        </header>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="common">
                <p><span class="pull-right" style="margin-right: 0.5rem"><?php echo $teacher['tname']; ?></span>
                    <span style="margin-left: 0.5rem">教师姓名</span></p>
            </div>
            <div class="common">
                <p><span class="pull-right" style="margin-right: 0.5rem"><?php echo $teacher['gender']; ?></span>
                    <span style="margin-left: 0.5rem">性别</span></p>
            </div>
            <div class="common">
                <p><span class="pull-right" style="margin-right: 0.5rem"><?php echo $teacher['course']; ?></span>
                    <span style="margin-left: 0.5rem">主教科目</span></p>
            </div>
            <div class="common">
                <p><span class="pull-right" style="margin-right: 0.5rem"><?php echo $teacher['position']; ?></span>
                    <span style="margin-left: 0.5rem">职位</span></p>
            </div>
            <div class="common" style="border-bottom: 0.1rem solid #c2ccd1;">
                <p><span class="pull-right" style="margin-right: 0.5rem"><?php echo $teacher['mobile']; ?></span>
                    <span style="margin-left: 0.5rem">联系方式</span></p>
            </div>

            <div class="common">
                <div style="display: inline-block"><p><span style="margin-left: 0.5rem;">所属班级</span></p></div>
                <div class="pull-right" style="display: inline-block;margin-right: 0.5rem;width: 9rem">
                <?php if(is_array($cids) || $cids instanceof \think\Collection || $cids instanceof \think\Paginator): $i = 0; $__LIST__ = $cids;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <p style="text-align: right;border-bottom: 0.1rem solid #c2ccd1"><?php echo $vo; ?></p>
                <?php endforeach; endif; else: echo "" ;endif; ?></div>
            </div>
        </div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
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
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>

</body>
</html>