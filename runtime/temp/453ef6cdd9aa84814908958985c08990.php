<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\arrange\index.html";i:1512636695;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>监护人</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="__PUBLIC__/sm.min.css">
    <style type="text/css">
        .news-item {
            height: 75px;
            position: relative;
            background-color: #FFFFFF;
            border-bottom: 1px solid #CCCCCC;
        }
        .content-block{
            margin: 0rem 0;
            padding: 0rem;
        }
        .news-item input[type=checkbox]:after{
            margin-top: 0.25rem;
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
        .boldtex{
            font-size: 16px;
            font-family: SFUIDisplay-Medium;
            color: #333333;
        }
        .smalltex{
            font-size: 14px;
            font-family: SFUIDisplay-Regular;
            color: #999999;
        }

        .news-image {
            width: 50px;
            height: 50px;
            border: none;
            float: left;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .news-image img {
            width: 50px;
            height: 50px;
            margin-top: 12px;
            margin-left: 16px;
            border-radius: 50px;
        }
        .news-item p{
            margin-top: 0.6rem;
            margin-left: 2rem;
            margin-bottom: 0.01rem;
        }
        input[type=checkbox]  {
            display: inline-block;
            vertical-align: middle;
            width: 18px;
            height: 18px;
            margin-left: 30px;
            -webkit-appearance: none;
            background-color: transparent;
            border: 0;
            outline: 0 !important;
            line-height: 18px;
            color: #d8d8d8;
        }
        input[type=checkbox]:after  {
            content: "";
            display:block;
            width: 18px;
            height: 18px;
            text-align: center;
            line-height: 18px;
            font-size: 16px;
            color: #fff;
            border: 2px solid #ddd;
            background-color: #fff;
            box-sizing:border-box;
            border-radius: 18px;
        }
        input[type=checkbox]:checked:after  {
            border: none;
            background-color: #37AF6E;
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
    <div class="page page-current" id='router'>
        <!-- 标题栏 -->
        <header class="bar bar-nav" style="background-color: #e6e6e6">
            <a class="button button-link button-nav pull-left back" style="width: 5%;color: #999999">
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
            <div class="tab-item external tooltex" style="color: #666666;background-color: #FFFFFF;text-align: left">
                <label for="allchoose" ><input type="checkbox" onclick="allchoose();"id="allchoose"><span style="margin-left: 12px">全选</span></label>
            </div>
            <span class="tab-item external tooltex">
                <span class="tab-label" style="color: #FFFFFF" onclick="change();">确认安排</span>
            </span>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="buttons-tab">
                <a href="#tab1" id="tabb0" class="tab-link active button">未安排</a>
                <a href="#tab2" id="tabb1" class="tab-link button">未确认</a>
                <a href="#tab3" id="tabb2" class="tab-link button">已确认</a>
                <a href="#tab4" id="tabb3" class="tab-link button">已驳回</a>
            </div>
            <div class="content-block">
                <div class="tabs">
                    <div id="tab1" class="tab active">
                        <div class="content-block">
                            <?php if(is_array($students) || $students instanceof \think\Collection || $students instanceof \think\Paginator): $i = 0; $__LIST__ = $students;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                            <div class="news-item clearfix">
                                <input class="pull-left" style="margin-top: 1.1rem" value="<?php echo $vo['sid']; ?>" type="checkbox" name="chk">
                                <div class="news-image">
                                    <a href="#"><img src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>"></a>
                                </div>
                                <div style="float: left;">
                                    <p class="boldtex"><?php echo $vo['name']; ?></p>
                                    <p class="smalltex" style="margin-top: 0.2rem"><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p></div>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                        </div>
                    </div>
                    <div id="tab2" class="tab">
                        <div class="content-block">
                            <?php if(is_array($unconfirmed) || $unconfirmed instanceof \think\Collection || $unconfirmed instanceof \think\Paginator): $i = 0; $__LIST__ = $unconfirmed;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="news-item clearfix">
                                <div class="news-image">
                                    <a href="#"><img src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>"></a>
                                </div>
                                <div style="float: left;">
                                    <p class="boldtex"><?php echo $vo['name']; ?></p>
                                    <p class="smalltex" style="margin-top: 0.2rem"><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p></div>
                                <span class="pull-right smalltex" style="margin-top: 1.3rem;margin-right: 10px">接收人：<?php echo $vo['tname']; ?></span>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div id="tab3" class="tab">
                        <div class="content-block">
                            <?php if(is_array($confirmed) || $confirmed instanceof \think\Collection || $confirmed instanceof \think\Paginator): $i = 0; $__LIST__ = $confirmed;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="news-item clearfix">
                                <div class="news-image">
                                    <a href="#"><img src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>"></a>
                                </div>
                                <div style="float: left;">
                                    <p class="boldtex"><?php echo $vo['name']; ?></p>
                                    <p class="smalltex" style="margin-top: 0.2rem"><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p></div>
                                <span class="pull-right smalltex" style="margin-top: 1.3rem;margin-right: 10px">接收人：<?php echo $vo['tname']; ?></span>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div id="tab4" class="tab">
                        <div class="content-block">
                            <?php if(is_array($reject) || $reject instanceof \think\Collection || $reject instanceof \think\Paginator): $i = 0; $__LIST__ = $reject;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="news-item clearfix">
                                <div class="news-image">
                                    <img src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>">
                                </div><div style="margin-left: 2.5rem">
                                <p class="boldtex"><?php echo $vo['name']; ?><span class="pull-right smalltex" style="margin-right: 10px"><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></span></p>
                                <p class="smalltex" style="margin-top: 0.2rem"><?php echo $vo['reason']; ?><span class="pull-right smalltex" style="margin-right: 10px">驳回人：<?php echo $vo['tname']; ?></span></p></div></div>
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
        $('#search').click(function () {
            if($('#searchval').val()=='') return false;
            window.location.href = '?name='+$('#searchval').val();
        });
        $('#tabb1').click(function () {
           $('#tools').hide();
        });
        $('#tabb0').click(function () {
           $('#tools').show();
        });
        $('#tabb2').click(function () {
           $('#tools').hide();
        });
        $('#tabb3').click(function () {
           $('#tools').hide();
        });
    })
    function change() {
        var str = '';
        var chk = document.getElementsByName('chk');
        for (var i = 0; i < chk.length; i++) {
            if (chk[i].checked) {
                str = str + chk[i].value + ',';
            }
        }
        str = str.substring(0, str.length - 1);
        if(!str){
            alert('还没选择学员');
            die;
        }
        window.location.href = '/school/public/mobil/arrange/chooset?sid='+str;
    }
    function allchoose() {
        var CheckAll=document.getElementById('allchoose');
        if(CheckAll.checked==true){
            checkedAll();
        }
        else{
            checkedNo();
        }
    }
    function checkedAll()
    {
        var names=document.getElementsByName('chk');
        var len=names.length;
        if(len>0)
        {
            for(var i=0;i<len;i++)
                names[i].checked=true;
        }
    }
    function checkedNo()
    {
        var names=document.getElementsByName('chk');
        var len=names.length;
        if(len>0)
        {
            for(var i=0;i<len;i++)
                names[i].checked=false;
        }
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