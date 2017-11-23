<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"D:\kinggsoft\phpstudy\WWW\school\public/../application/admin\view\teacher\edit.html";i:1511318183;s:81:"D:\kinggsoft\phpstudy\WWW\school\public/../application/admin\view\common\top.html";i:1510920761;s:82:"D:\kinggsoft\phpstudy\WWW\school\public/../application/admin\view\common\left.html";i:1510805509;}*/ ?>
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
    <style type="text/css">
        #login{
            position: absolute;
            top: 45%;
            left:45%;
            margin: -15px 0 0 -50px;
            width: 400px;
            background-color: #aeaeae;
        }
    </style>
    <script type="text/javascript">
        $(function() {
            $("#login").hide();
            $('#showcid').click(function () {
                $("#login").show();
            });
            $('#changecid').click(function () {
                var str = '';
                var chk = document.getElementsByName('chk');
                for (var i = 0; i < chk.length; i++) {
                    if (chk[i].checked) {
                        str = str + chk[i].value + ',';
                    }
                }
                str = str.substring(0, str.length - 1);
                if(!str){
                    alert('还没选择班级');
                    die;
                }
                $("#login").hide();
//                alert(str);die;
                $('#cid').val(str);
            });
        })
    </script>

</head>
<body>
	<!-- 头部 -->
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
                                    <a href="<?php echo url('login/logout'); ?>">
                                            退出登录
                                        </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('manager/edit',array('id'=>\think\Request::instance()->session('uid'))); ?>">
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
                                <a href="<?php echo url('teacher/lst'); ?>">
                                    <span class="menu-text">
                                        教师列表                                   </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="menu-dropdown">
                                    <span class="menu-text">
                                        考勤管理                                   </span>
                                    <i class="menu-expand"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php echo url('attendance/signed'); ?>">
                                    <span class="menu-text">
                                        签到列表                                    </span>
                                            <i class="menu-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo url('attendance/holiday'); ?>">
                                    <span class="menu-text">
                                        请假列表                                    </span>
                                            <i class="menu-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo url('attendance/evection'); ?>">
                                    <span class="menu-text">
                                        出差列表                                    </span>
                                            <i class="menu-expand"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo url('Attendance/sysnews',['id'=>'0']); ?>">
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
                                <a href="<?php echo url('guardian/lst'); ?>">
                                    <span class="menu-text">
                                        监护人列表                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('Attendance/sysnews',['id'=>'1']); ?>">
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
                                <a href="<?php echo url('manager/lst'); ?>">
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
                        <li>
                            <a href="<?php echo url('lst'); ?>">教师管理</a>
                        </li>
                        <li class="active">编辑教师</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">编辑教师</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="" method="post">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">教师编号</label>
                            <div class="col-sm-6">
                                <input class="form-control" disabled="disabled" value="<?php echo $admin['tid']; ?>" required="" type="text">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                            <div class="col-sm-6">
                                <input class="form-control" id="sid" value="<?php echo $admin['tid']; ?>" name="tid" type="hidden">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">密码</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="password" value="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">姓名</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="username" value="<?php echo $admin['tname']; ?>" name="tname" required="" type="text">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label for="year" class="col-sm-2 control-label no-padding-right">所教班级</label>
                            <div class="col-sm-6" style="display: inline-block;width: 300px">
                                <input type="button" value="选择班级" id="showcid">
                                <input type="hidden" id="cid" name="cid">
                                <div id="login">
                                    <?php if(is_array($cid) || $cid instanceof \think\Collection || $cid instanceof \think\Paginator): $i = 0; $__LIST__ = $cid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <label style="margin-right: 2px"><input type="checkbox" name="chk" value="<?php echo $vo['cid']; ?>" <?php if(strstr($admin['cid'],$vo['cid'])): ?> checked <?php endif; ?>><?php echo $vo['cid']; ?></label>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                    <input type="button" value="确认" id="changecid">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">性别</label>
                            <div class="col-sm-6">
                                <select name="gender">
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                </select>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">课程</label>
                            <div class="col-sm-6">
                                <input class="form-control" value="<?php echo $admin['course']; ?>" name="course" required="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">职位</label>
                            <div class="col-sm-6">
                                <input class="form-control" value="<?php echo $admin['position']; ?>" name="position" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">手机号码</label>
                            <div class="col-sm-6">
                                <input class="form-control" value="<?php echo $admin['mobile']; ?>" name="mobile" required="" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">保存信息</button>
                            </div>
                        </div>
                    </form>
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
    


</body></html>