<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\kinggsoft\phpstudy\WWW\school\public/../application/index\view\student\index.html";i:1512441834;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>师生交接-教师端</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="__PUBLIC__/sm.min.css">
    <style type="text/css">
        .content-block{
            margin: 0rem 0;
            padding: 0rem;
            background-color: #FFFFFF;
        }
        .common{
            height: 50px;
            border-bottom: 1px solid #CCCCCC;
            border-top: 1px solid #FFFFFF;
            padding-left: 17px;
            line-height: 50px;
        }
        .boldtex{
            font-size: 16px;
            font-family: SFUIDisplay-Regular;
            color: #333333;
        }
        .smalltex{
            font-size: 14px;
            font-family: PingFang-SC-Bold;
            color: #28A5E5;
        }
        .smatext{
            font-family: SFUIDisplay-Regular;
            font-size: 16px;
            color: #999999;
            margin-right: 12px;
        }
        .bar .icon{
            vertical-align: baseline;
            margin-left: 9px;
            font-size: 0.9rem;
        }
        .search-input .icon{
            left: 30%;
            top:58%;
            font-size: 0.8rem;
        }
        .search-input label + input{
            padding-left: 40%;
            font-size: 14px;
            color: #000000;
            font-family: PingFang-SC-Medium;
        }
        .tooltex{
            font-size: 16px;
            font-family: PingFang-SC-Medium;
            background-color: #28A5E5;
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav" style="background-color: #e6e6e6">
            <a class="button button-link button-nav pull-left back" style="color: #999999">
                <span class="icon icon-left"></span>
            </a>
            <div class="searchbar pull-right" style="width: 95%;background-color: #e6e6e6">
                <a class="searchbar-cancel" id='search'>搜索</a>
                <div class="search-input">
                    <label class="icon icon-search" for="search"></label>
                    <input type="search" id="searchval" placeholder='搜索'/>
                </div>
            </div>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab" id="tools">
            <span class="tab-item external tooltex">
                <span class="tab-label" style="color: #FFFFFF" onclick="change();">添加分组</span>
            </span>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="buttons-tab">
                <a href="#tab1" id="tabb0" class="tab-link active button smalltex">班级</a>
                <a href="#tab2" id="tabb1" class="tab-link button smalltex">分组</a>
            </div>
            <div class="content-block">
                <div class="tabs">
                    <div id="tab1" class="tab active">
                        <div class="content-block">
                            <?php if(is_array($class) || $class instanceof \think\Collection || $class instanceof \think\Paginator): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="common" onclick="javascript:window.location.href = '<?php echo url('student/classdetail',['cid'=>$vo['cid']]); ?>'"><span class="icon icon-right pull-right" style="margin-right: 16px;"></span>
                                    <span class="pull-right smatext"><?php echo $vo['num']; ?>名</span>
                                    <span class="boldtex"><?php echo $vo['cid']; ?></span>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                        </div>
                    </div>
                    <div id="tab2" class="tab">
                        <div class="content-block">
                            <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="common" onclick="javascript:window.location.href = '<?php echo url('student/groupdetail',['sgid'=>$vo['sgid']]); ?>'"><span class="icon icon-right pull-right" style="margin-right: 16px"></span>
                                    <span class="pull-right smatext"><?php echo count(explode(',',$vo['sids'])); ?>名</span>
                                    <span class="boldtex"><?php echo $vo['name']; ?></span>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </div>
    <!-- 其他的单个page内联页（如果有） -->
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script>
    $(function () {
        $('#tools').hide();
        $('#search').click(function () {
            if($('#searchval').val()=='') return false;
            window.location.href = '?name='+$('#searchval').val();
        });
        $('#tabb1').click(function () {
           $('#tools').show();
        });
        $('#tabb0').click(function () {
           $('#tools').hide();
        });
    })
    function change() {
        window.location.href = '/school/public/index/student/addgroup?sid=';
    }

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='__PUBLIC__/sm.min.js' charset='utf-8'></script>

</body>
</html>