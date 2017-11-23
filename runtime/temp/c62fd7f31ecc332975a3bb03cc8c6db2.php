<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\guardian\editpas.html";i:1511171746;}*/ ?>
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

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
</head>
<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page page-current">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <a class="button button-link button-nav pull-left back" href="" data-transition='slide-out'>
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title">修改密码</h1>
        </header>

        <!-- 你的html代码 -->
        <div class="content" style="padding-left: 2rem;padding-right: 2rem">
            <form class="form-horizontal" onsubmit="return check();" role="form" action="" method="post">
                <div style="text-align: center;margin-top: 3rem">
                    <div class="list-block">
                        <ul>
                            <!-- Text inputs -->
                            <li>
                                <div class="item-content">
                                    <div class="item-media"><i class="icon icon-form-name"></i></div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="text" name="oldpas" placeholder="原密码">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <input type="hidden" name="mobile" value="<?php echo \think\Session::get('mobile'); ?>">
                            <li>
                                <div class="item-content">
                                    <div class="item-media"><i class="icon icon-form-email"></i></div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="password" id="oldpas" placeholder="请输入新密码">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-media"><i class="icon icon-form-email"></i></div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="password" id="newpas" name="password" placeholder="请确认新密码">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <input type="submit" class="button button-fill" value="确&nbsp;&nbsp;定">
            </form>
        </div>
    </div>
</div>
<script src="__PUBLIC__/jquery-3.2.1.js"></script>
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script>
    function check() {
        var old = document.getElementById('oldpas').value;
        var n = document.getElementById('newpas').value;
        if(n != old){
            alert('两次输入的密码不一致');
            return false;
        }else{
            return true;
        }
    }

    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
</body>
</html>