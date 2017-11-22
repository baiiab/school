<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\kinggsoft\phpstudy\WWW\school\public/../application/mobil\view\guardian\login.html";i:1511319328;}*/ ?>
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
            <a class="button button-link button-nav pull-left" href="/demos/card" data-transition='slide-out'>
                <span class="icon icon-left"></span>

            </a>
            <h1 class="title">修改密码</h1>
        </header>

        <!-- 你的html代码 -->
        <div class="content" style="padding-left: 2rem;padding-right: 2rem">
            <form class="form-horizontal" role="form" action="" method="post">
            <div style="text-align: center;margin-top: 3rem">
                <img style="width: 7rem;height: 7rem" src="__IMG__/ios/icon_head_portrait@3x.png">
                <div class="list-block">
                    <ul>
                        <!-- Text inputs -->
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-name"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="text" name="mobile" placeholder="请输入手机号码">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-email"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="password" name="password" placeholder="请输入密码">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="submit" class="button button-fill" value="登&nbsp;&nbsp;录">
            </form>
        </div>
    </div>
</div>
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script>
    //打开自动初始化页面的功能
    //建议不要打开自动初始化，而是自己调用 $.init 方法完成初始化
    $.config = {
        autoInit: true,
    }
</script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
</body>
</html>