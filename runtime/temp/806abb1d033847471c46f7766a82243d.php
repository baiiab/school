<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\kinggsoft\phpstudy\WWW\school\public/../application/index\view\arrange\choosep.html";i:1512735208;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>教师端</title>
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
        .content-block{
            margin: 0rem 0;
            padding: 0rem;
        }
        header .icon{
            vertical-align: middle;
            margin-left: 11px;
            font-size: 0.9rem;
        }

    </style>
</head>
<div class="page-group">
    <!-- 其他的单个page内联页（如果有） -->
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
            <div class="buttons-tab">
                <a href="#tab1" id="tabb1" class="tab-link active button">教师</a>
                <a href="#tab2" id="tabb2" class="tab-link button">监护人</a>
            </div>
            <div class="content-block">
                <div class="tabs">
                    <div id="tab1" class="tab active">
                        <div class="content-block">
                            <?php if(is_array($teacher) || $teacher instanceof \think\Collection || $teacher instanceof \think\Paginator): $i = 0; $__LIST__ = $teacher;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="common">
                                <a class="external ortex" href="<?php echo url('arrange/confirm',['gid'=>$vo['mobile'].$vo['tname'],'sid'=>$sids]); ?>"><?php echo $vo['tname']; ?></a>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div id="tab2" class="tab">
                        <div class="content-block">
                            <div class="common">
                                <a class="external ortex" href="<?php echo url('arrange/detid',['sid'=>$sids]); ?>">相应监护人（放学专用）</a>
                            </div>
                            <?php if(is_array($guardian) || $guardian instanceof \think\Collection || $guardian instanceof \think\Paginator): $i = 0; $__LIST__ = $guardian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="common">
                                <span class="confirm-title-ok-cancel ortex"><input type="hidden" id="guard" value="<?php echo $vo['mobile']; ?><?php echo $vo['gname']; ?>,<?php echo $sids; ?>"><?php echo $vo['gname']; ?></span>

                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            <a id="showalert"></a>
                        </div>
                    </div>

                </div>
            </div>

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
    $(document).on('click','.confirm-title-ok-cancel', function () {
        $.confirm('是否确定安排学员？', '确认安排',
            function () {
                var value = $('#guard').val().split(",");
                window.location.href = '/school/public/index/arrange/confirm?gid='+value[0]+'&sid='+value[1];
            },
            function () {
                return false;
            }
        );
    });
    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='__PUBLIC__/sm.min.js' charset='utf-8'></script>

</body>
</html>