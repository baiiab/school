<!doctype html>
<%@ page contentType="text/html;charset=UTF-8" language="java"
	pageEncoding="UTF-8"%>
<html lang="en">
<head>
<meta charset="UTF-8" />
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core_rt"%>

<title>打卡</title>
<meta name="viewport"
	content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<link rel="stylesheet" type="text/css" href="../../css/mui.min.css" />
<style>
body {
	font-size: 62.5%;
}

ul, li {
	list-style: none;
	margin: 0px;
	-webkit-margin: 0px;
	padding: 0px;
}

.timeAttendan {
	margin-top: 10px;
	background-color: #FFFFFF;
}

.timeAttendan>li {
	font-size: 1.3em;
	padding: 10px;
	border-top: solid #DFDFDF 1px;
	border-bottom: solid #DFDFDF 1px;
}

.timeAttendan>li:first-child {
	border: none;
	border-top: solid #DFDFDF 1px;
}

.timeAttendan>li:last-child {
	border: none;
	border-bottom: solid #DFDFDF 1px;
}

.timeAttendan>li>span:first-of-type {
	color: #999999;
}

.btnPosition {
	
}

.btnPosition>button {
	display: block;
	margin: 0px auto;
	margin-top: 150px;
	width: 60%;
	height: 3em;
}
</style>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"type="text/javascript" charset="utf-8"></script>

</head>

<script>
if(${checkWorkBool}==false){
	wx.config({
		debug : false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
		appId : '${appid}', // 必填，公众号的唯一标识
		timestamp : '${timestamp}', // 必填，生成签名的时间戳
		nonceStr : '${noncestr}', // 必填，生成签名的随机串
		signature : '${signature}',// 必填，签名，见附录1
		jsApiList : [ 'getLocation' ]
	// 必填，需要使用的JS接口列表，所有JS接口列表见附录2
	});
}

</script>
<body>
	<ul class="timeAttendan">
		<c:choose>
			<c:when test="${checkWorkBool==false}">
				<li style="text-align: center;"><span>今日未考勤</span></li>
			</c:when>
			<c:when test="${checkWorkBool==true}">
				<li><span>考勤定位：</span> <span>${checkWork.checkWorkAddress}</span>
				</li>
				<li><span>考勤时间：</span> <span>${checkWork.checkWorkTime}</span>
				</li>
			</c:when>
			 <c:otherwise>   
			    <div>?asdasd${checkWorkBool }${url }</div>
			  </c:otherwise> 
		</c:choose>

	</ul>


	<div class="btnPosition">
		<c:choose>
			<c:when test="${checkWorkBool==true}">
				<button disabled="disabled" class="mui-btn mui-disabled">已考勤</button>
			</c:when>
			<c:when test="${checkWorkBool==false}">
				<button class="mui-btn mui-btn-blue"
					onclick="submitOrderInfoClick();">打卡考勤</button>
			</c:when>
		</c:choose>

	</div>

	<input id="error" value="ok" type="hidden">
	<script src="../../js/mui.js" type="text/javascript" charset="utf-8"></script>
	<script src="../../js/config.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		mui.init();
		function submitOrderInfoClick() {
			var error = document.getElementById('error');
			if(error.value=="ok"){
				GetLocal(); 
			}else{
				//ticket失效，重新获取
				window.location.href="/wechat_order/server/checkwork/recheck?timestamp="+${timestamp};
			}
		}
		
		// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
		wx.error(function(res){
			for(var i in res){
				if(i=="errMsg" && res[i]=="config:invalid signature"){
					var error = document.getElementById('error');
					error.value = res[i];
				}
			}
		});
		
	    function GetLocal(){
	    	wx.getLocation({
				type: 'wgs84', 
				success : function(res) {
					var latitude = res.latitude;
					var longitude = res.longitude;
					GetAddress(latitude,longitude)
				},
				fail : function(error) {
					mui.toast("获取地理位置失败，请确保开启GPS且允许微信获取您的地理位置！");
				}
			}); 
	    }
	    
		function GetAddress(lat,log){
			var url = domain+'wechat_order/server/checkwork/docheckwork';
			mui.ajax(url,{
				data:{
					"lat":lat,
					"log":log,
				}
				,dataType:'json'
				,type:'post'
				,success:function(data){
					if(data.ret == true){
						mui.toast("打卡成功");
						location.reload();   
					}else{
						mui.toast(data.forUser);
					}
				}
				,error:function(data){
					mui.toast("网络错误");
				}
			});
		}
	</script>
</body>
</html>
