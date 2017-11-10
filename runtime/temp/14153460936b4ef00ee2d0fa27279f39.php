<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\kinggsoft\phpstudy\WWW\school\public/../application/admin\view\student\change.html";i:1510302396;s:81:"D:\kinggsoft\phpstudy\WWW\school\public/../application/admin\view\common\top.html";i:1510193418;s:82:"D:\kinggsoft\phpstudy\WWW\school\public/../application/admin\view\common\left.html";i:1510282535;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__PUBLIC__/bootstrap.css" rel="stylesheet">
    <link href="__PUBLIC__/font-awesome.css" rel="stylesheet">
    <link href="__PUBLIC__/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="__PUBLIC__/beyond.css" rel="stylesheet" type="text/css">
    <link href="__PUBLIC__/demo.css" rel="stylesheet">
    <link href="__PUBLIC__/typicons.css" rel="stylesheet">
    <link href="__PUBLIC__/animate.css" rel="stylesheet">
    <script src="__PUBLIC__/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cid").hide();
            $('#year').change(function () {
//                alert('q');die;
                $.ajax({
                    type: "GET",
                    url: "__JQUERY__/public/admin/Student/searchClass",
                    data: {'year':$("#year").val()},
                    dataType: "json",
                    success: function(data){
                        $('#cid').show();
                        var arr = JSON.parse(data);
//                        alert(arr[0]['cid']);die;
                        var str = "<select id='scid' onchange='findStudent();'><option>请选择班级</option>";
                        for(var i in arr){
                            str += "<option value='"+arr[i]['cid']+"'>"+arr[i]['cid']+"</option>"
//                            alert(arr[i]['cid']);die;
                        }
//                        alert(str);die;
                        $("#choose").html(str+"</select>");
                    }
                });
            });
        });
        function findStudent() {
            window.location.href="__JQUERY__/public/admin/Student/findStudent?class="+$('#scid').val();
        }
        function change() {
            var str = '';
            var obj = prompt("请输入监护人");

            var chk = document.getElementsByName('chk');
            for (var i = 0; i < chk.length; i++) {
                if (chk[i].checked) {
                    str = str + chk[i].value + ',';
                }
            }
            str = str.substring(0, str.length - 1);
//            alert(obj);die;
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4) {
                    alert("交接成功，等待对方确认");
                }
            }
            ajax.open('get', '__JQUERY__/public/admin/Handmessage?sid=' + str +' '+obj, true);
            ajax.send(null);
        }
        function allchoose() {
            var CheckAll=document.getElementById('allchk');
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
    </script>
</head>
<body>
<!-- 头部 -->
	<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                            <img src="__IMG__/logo.png" alt="">
                        </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="__IMG__/adam-jansen.jpg">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo \think\Request::instance()->session('name'); ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a>David Stevenson</a></li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/logout'); ?>">
                                            退出登录
                                        </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/edit',array('id'=>\think\Request::instance()->session('uid'))); ?>">
                                            修改密码
                                        </a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                        <!-- /Account Area -->
                        <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                        <!-- Settings -->
                    </ul>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>
</div>

<!-- /头部 -->

<div class="main-container container-fluid">
    <div class="page-container">
        <!-- Page Sidebar -->
         <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input class="searchinput" type="text">
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    <!--Dashboard-->
                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">学员管理</span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('student/lst'); ?>">
                                    <span class="menu-text">
                                        学员列表                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="menu-dropdown">
                                    <span class="menu-text">交接异常</span>
                                    <i class="menu-expand"></i>
                                </a>
                                <ul style="cursor: pointer;">
                                    <li>
                                        <a href="<?php echo url('transinfo/trans',['id'=>'0']); ?>">
                                    <span class="menu-text">
                                        课程异常列表                                    </span>
                                            <i class="menu-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo url('transinfo/trans',['id'=>'1']); ?>">
                                    <span class="menu-text">
                                        驳回异常列表                                    </span>
                                            <i class="menu-expand"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo url('student/lst',['id'=>'1']); ?>">
                                    <span class="menu-text">
                                        交接划拔                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text">教师管理</span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('cate/lst'); ?>">
                                    <span class="menu-text">
                                        教师列表                                   </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('cate/lst'); ?>">
                                    <span class="menu-text">
                                        考勤管理                                   </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('cate/lst'); ?>">
                                    <span class="menu-text">
                                        系统消息                                   </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-file-text"></i>
                            <span class="menu-text">监护人管理</span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('article/lst'); ?>">
                                    <span class="menu-text">
                                        监护人列表                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('article/lst'); ?>">
                                    <span class="menu-text">
                                        系统消息                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-file-text"></i>
                            <span class="menu-text">权限管理</span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('article/lst'); ?>">
                                    <span class="menu-text">
                                        管理员列表                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        </ul>
                    </li>


                                           
                    
                </ul>
                <!-- /Sidebar Menu -->
            </div>
        <!-- /Page Sidebar -->
        <!-- Page Content -->
        <div class="page-content">
            <!-- Page Breadcrumb -->
            <div class="page-breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="#">系统</a>
                    </li>
                    <li class="active">学员管理</li>
                </ul>
            </div>
            <!-- /Page Breadcrumb -->

            <!-- Page Body -->
            <div class="page-body">
                <label><input type="checkbox" value="df" id="allchk" onclick="allchoose();"/><span style="margin-left: 5px;">全选</span></label>
                <button type="button" class="btn btn-sm btn-azure btn-addon" onClick="change();"> 确认交接</button>

                <div class="btn btn-sm btn-azure btn-addon">
                    <div class="col-sm-6">
                        <select name="year" id="year">
                            <option value="">请选择年份</option>
                            <?php if(is_array($year) || $year instanceof \think\Collection || $year instanceof \think\Paginator): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['year']; ?>"><?php echo $vo['year']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="btn btn-sm btn-azure btn-addon" id='cid' >
                    <div class="col-sm-6" id="choose">

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <div class="widget-body">
                                <div class="flip-scroll">
                                    <table class="table table-bordered table-hover">
                                        <thead class="">
                                        <tr>
                                            <th class="text-center" width="10%">交接选择</th>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">姓名</th>
                                            <th class="text-center">性别</th>
                                            <th class="text-center">所属班级</th>
                                            <th class="text-center">目前负责人</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($students) || $students instanceof \think\Collection || $students instanceof \think\Paginator): $i = 0; $__LIST__ = $students;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" name="chk" value="<?php echo $vo['sid']; ?>"/>
                                            </td>
                                            <td align="center"><?php echo $vo['sid']; ?></td>
                                            <td align="center"><?php echo $vo['name']; ?></td>
                                            <td align="center"><?php echo $vo['sex']; ?></td>
                                            <td align="center"><?php echo $vo['cid']; ?></td>
                                            <td align="center"><?php echo $vo['tid']; ?></td>
                                        </tr>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    <?php echo $students->render(); ?>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Page Body -->
        </div>
        <!-- /Page Content -->
    </div>
</div>

<!--Basic Scripts-->
<script src="__PUBLIC__/jquery_002.js"></script>
<script src="__PUBLIC__/bootstrap.js"></script>
<script src="__PUBLIC__/jquery.js"></script>
<!--Beyond Scripts-->
<script src="__PUBLIC__/beyond.js"></script>


</body>
</html>