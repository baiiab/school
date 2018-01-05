<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\kinggsoft\phpstudy\WWW\school\public/../application/admin\view\login\login.html";i:1513070142;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>特殊教育服务号-后台管理</title>
    <meta name="description" content="login page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__PUBLIC__/bootstrap.css" rel="stylesheet">
    <link href="__PUBLIC__/font-awesome.css" rel="stylesheet">
    <!--Beyond styles-->
    <link id="beyond-link" href="__PUBLIC__/beyond.css" rel="stylesheet">
    <link href="__PUBLIC__/demo.css" rel="stylesheet">
    <link href="__PUBLIC__/animate.css" rel="stylesheet">
    <script src="__PUBLIC__/jquery-3.2.1.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('#sendy').click(function () {
                var value = $("#yzm").val();
//            alert(value);die;
                $.ajax({
                    type:"GET",
                    url:'sendYzm',
                    data:{name:value},
                    success:function (result) {
                        if(result == 000000){
                            $('#sendy').val("发送成功");
                        }
                    }
                });
            });
        });
    </script>
</head>
<!--Head Ends-->
<!--Body-->

<body>
    <div class="login-container animated fadeInDown">
        <form action="" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">SIGN IN</div>
                <div class="loginbox-textbox">
                    <input id="yzm" class="form-control" placeholder="username" name="username" type="text">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" placeholder="password" name="password" type="password">
                </div>
                <!--<div class="loginbox-textbox">-->
                    <!--<input class="form-control" placeholder="code" style="width: 80px;float: left;" name="code" type="text">-->
                    <!--<img style="float: left;cursor: pointer" src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random();"/>-->
                <!--</div>-->
                <div class="loginbox-submit">
                    <input class="btn btn-primary btn-block" value="Login" type="submit">
                </div>
            </div>
        </form>
    </div>
    <!--Basic Scripts-->
    <script src="__PUBLIC__/jquery.js"></script>
    <script src="__PUBLIC__/bootstrap.js"></script>
    <script src="__PUBLIC__/jquery_002.js"></script>
    <!--Beyond Scripts-->
    <script src="__PUBLIC__/beyond.js"></script>


</body><!--Body Ends--></html>