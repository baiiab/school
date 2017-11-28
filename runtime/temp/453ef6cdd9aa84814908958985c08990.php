<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\arrange\index.html";i:1511866806;}*/ ?>
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
            min-height: 3.5rem;
            position: relative;
            margin-top: 0.2rem;
            border-bottom: 0.05rem solid #c2ccd1;
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
            height: 3rem;
            border: none;
            float: left;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .news-image img {
            width: 3rem;
            height: 3rem;
            margin-left: 1rem;
        }
        .news-item p{
            margin-top: 0.2rem;
            margin-left: 2rem;
            margin-bottom: 0.1rem;
        }
        input[type=checkbox]  {
            display: inline-block;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            margin-left: 5px;
            -webkit-appearance: none;
            background-color: transparent;
            border: 0;
            outline: 0 !important;
            line-height: 20px;
            color: #d8d8d8;
        }
        input[type=checkbox]:after  {
            content: "";
            display:block;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 14px;
            font-size: 16px;
            color: #fff;
            border: 2px solid #ddd;
            background-color: #fff;
            box-sizing:border-box;
        }
        input[type=checkbox]:checked:after  {
            border: 4px solid #ddd;
            background-color: #37AF6E;
        }
        .smalltex{
            color: #8c8c8c;
            font-size: 0.8rem;
        }
    </style>
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <a class="button button-link button-nav pull-left back" style="width: 5%">
                <span class="icon icon-left"></span>
            </a>
            <div class="searchbar pull-right" style="width: 95%">
                <a class="searchbar-cancel" id='search'>搜索</a>
                <div class="search-input">
                    <label class="icon icon-search" for="search"></label>
                    <input type="search" id="searchval" placeholder='输入关键字...'/>
                </div>
            </div>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab" id="tools">
            <div class="tab-item external">
                <label for="allchoose"><input type="checkbox" onclick="allchoose();"id="allchoose">全选</label>
            </div>
            <span class="tab-item external">
                <span class="tab-label" onclick="change();">确认安排</span>
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
                                    <p><?php echo $vo['name']; ?></p>
                                    <p><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p></div>
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
                                    <p><?php echo $vo['name']; ?></p>
                                    <p><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p></div>
                                <span class="pull-right smalltex" style="margin-top: 1rem;">接收人：<?php echo $vo['tname']; ?></span>
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
                                    <p><?php echo $vo['name']; ?></p>
                                    <p><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></p></div>
                                <span class="pull-right smalltex" style="margin-top: 1rem;">接收人：<?php echo $vo['tname']; ?></span>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div id="tab4" class="tab">
                        <div class="content-block">
                            <?php if(is_array($reject) || $reject instanceof \think\Collection || $reject instanceof \think\Paginator): $i = 0; $__LIST__ = $reject;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="news-item clearfix">
                                <div class="news-image">
                                    <img style="margin-right: 0.5rem;margin-top: 0.3rem" class="pull-right" src="<?php if($vo['headimg'] != ''): ?>__PIC__<?php echo $vo['headimg']; else: ?>__IMG__/ios/icon_head_portrait@3x.png<?php endif; ?>">
                                </div>
                                <p><?php echo $vo['name']; ?><span class="pull-right smalltex"><?php echo $vo['sex']; ?>&nbsp;<?php echo $vo['cid']; ?></span></p>
                                <p class="smalltex"><?php echo $vo['reason']; ?><span class="pull-right smalltex">驳回人：<?php echo $vo['tname']; ?></span></p></div>
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
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
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
    function reject(obj) {
        var str = obj.split(',');
//        alert(s);
        $.prompt('学员姓名：'+str[1]+"<br/>"+'学员班级：'+str[3], '学员驳回',
            function (value) {
//                $.alert('Your name is "' + value + '". You clicked Ok button');
                if(value==''){
                    alert('请填写驳回原因');
                    return;
                }
                window.location.href = '/school/public/mobil/transinfo/reject?sid='+str[2]+'&reason='+value;
            }
//            function (value) {
//                $.alert('Your name is "' + value + '". You clicked Cancel button');
//            }
        );
    }
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
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                alert("成功接收");
                window.location.reload();
            }
        }
        ajax.open('get', '__JQUERY__/public/mobil/transinfo/receive?sid=' + str, true);
        ajax.send(null);
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
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>

</body>
</html>