<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\arrange\chooset.html";i:1512381704;}*/ ?>
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

    <link rel="stylesheet" href="__PUBLIC__/sm.min.css">
    <style type="text/css">
        .common{
            height: 50px;
            border-bottom: 1px solid #CCCCCC;
            border-top: 1px solid #FFFFFF;
            background-color: #FFFFFF;
            padding-left: 17px;
            line-height: 50px;
        }
        .ortex{
            font-size: 16px;
            font-family: SFUIDisplay-Regular;
            color: #333333;
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
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
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
        <div class="content">
            <?php if(is_array($teacher) || $teacher instanceof \think\Collection || $teacher instanceof \think\Paginator): $i = 0; $__LIST__ = $teacher;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="common">
                    <a class="external ortex" href="<?php echo url('arrange/confirm',['gid'=>$vo['mobile'].$vo['tname'],'sid'=>$sids]); ?>"><?php echo $vo['tname']; ?></a>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>

<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<!--<script type="text/javascript" src="__PUBLIC__/jquery-3.2.1.js"></script>-->
<script type='text/javascript' src='__PUBLIC__/zepto.min.js' charset='utf-8'></script>
<script>
    $(function () {
        $('#search').click(function () {
            if($('#searchval').val()=='') return false;
            window.location.href = '?tname='+$('#searchval').val();
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