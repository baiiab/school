<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
//处理请求
if(!empty($_GET['echostr'])){
	$wechatObj->valid();
}else{
	$wechatObj->responseMsg();
}
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
	//这个函数就是专门处理业务逻辑
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		//如果请求代码不为空
		if (!empty($postStr)){
                //这里是xml技术解析数据
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
				$event=$postObj->Event;
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";          
				//当用户关注我们微信平台时，会发送一个订阅时间，我就处理这个事件
				switch($postObj->MsgType){
					case 'event':
						//如果是用户订阅
						if($event == 'subscribe'){
							$contentStr="Welcome,搞笑制作者\r\n\r\n *菜单如下\r\n\r\n 1.输入新闻就新闻列表";
							//这里先返回菜单，填充模板即可
							$msgType = "text";
							$textTplRes=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
							echo $textTplRes;
						}
						break;
					case 'text':
						if($keyword == 'token'){
							$contentStr="getToken()";
							$msgType = "text";
							$textTplRes=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
							echo $textTplRes;
						}
						if($keyword == '新闻'){
							//返回<图文信息>新闻列表，
							$newsTplHeader="<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[news]]></MsgType>
									<ArticleCount>%s</ArticleCount>
									<Articles>";
							$newsTplItem="<item>
									<Title><![CDATA[%s]]></Title> 
									<Description><![CDATA[%s]]></Description>
									<PicUrl><![CDATA[%s]]></PicUrl>
									<Url><![CDATA[%s]]></Url>
									</item>";
							$newTplFooter="</Articles></xml>";
							//从数据库中循环取出新闻条目
							$connect=mysql_connect('123.207.124.250','root','root');
							mysql_select_db('weixin');
							mysql_query("SET NAME UTF8");
							$sql="SELECT title,description,picUrl,url FROM news ORDER BY id  LIMIT 0,8";
							$res=mysql_query($sql);
							$itemCount=0;
							while($row = mysql_fetch_assoc($res)){
								++$itemCount;
								$contentStr .= sprintf($newsTplItem,$row['title'],$row['description'],$row['picUrl'],$row['url']);
							}
							//拼接返回结果
							$newTplHeader=sprintf($newsTplHeader,$fromUsername,$toUsername,$time,$itemCount);
							$resultStr=$newTplHeader.$contentStr.$newTplFooter;
							
							echo $resultStr;
						}
						if($keyword == '音乐'){
							//返回点播菜单
							$contentStr="欢迎来到搞笑制作者\r\n菜单如下\r\n 1.邓紫棋-喜欢你\r\n 2.刘德华-一起走过的日子\r\n 3.黄家驹-灰色轨迹输入歌曲编号可听该首歌";
							$msgType = "text";
							$textTplRes=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
							echo $textTplRes;
						}else if(preg_match("/^[1-9](\d){0,2}$/",$keyword)){
							//
							if($keyword=='1'){
								$desc='邓紫棋-喜欢你';
							}else if($keyword=='2'){
								$desc='刘德华-一起走过的日子';
							}else if($keyword=='3'){
								$desc='黄家驹-灰色轨迹';
							}else{
								//如果不存在
								$desc='邓紫棋-喜欢你';
								$keyword==1;
							}
							$musicTpl="<xml>
										<ToUserName><![CDATA[%s]]></ToUserName>
										<FromUserName><![CDATA[%s]]></FromUserName>
										<CreateTime>%s</CreateTime>
										<MsgType><![CDATA[music]]></MsgType>
										<Music>
										<Title><![CDATA[邓紫棋-喜欢你]]></Title>
										<Description><![CDATA[%s]]></Description>
										<MusicUrl><![CDATA[%s]]></MusicUrl>
										<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
										</Music>
										</xml>";
							$musicUrl="http://123.207.124.250/upload/mp3/{$keyword}.mp3";
							//填充返回的结果
							$musicTplRes=sprintf($musicTpl,$fromUsername,$toUsername,$time,$desc,$musicUrl,$musicUrl);
							echo $musicTplRes;
						}
						//规定，如果用户想查询某个关系的地方，要求输入cxwz地方名称->正则表达式
						else if(preg_match("/^cx([\x{4e00}-\x{9fa5}]+)/ui",$keyword,$res)){
							$address=$res[1];
							//还要取出这个用户的地址位置
							$connect=mysql_connect('123.207.124.250','root','root');
							mysql_select_db('weixin');
							mysql_query("SET NAME UTF8");
							//1.用户存在，更新
							$sql="SELECT longitude,latitude FROM members WHERE wxname='{$fromUsername}'";
							$res =mysql_query($sql);
							if($row = mysql_fetch_assoc($res)){
								//根据用户的地理位置，查询该地点 ->LBS知识
								$contentStr="请点击该链接，就可以查询到\r\n\r\n http://api.map.baidu.com/place/search?query=".urlencode($address)."&location={$row['latitude']},{$row['longitude']}&radius=10000&output=html&coord_type=gcj02";
								//这里先返回菜单，填充模板即可
								$msgType = "text";
								$textTplRes=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
								echo $textTplRes;
							}else{
								$contentStr="您还没上传地理位置！";
								//这里先返回菜单，填充模板即可
								$msgType = "text";
								$textTplRes=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
								echo $textTplRes;
							}
						}
						break;
					//如果用户上传的是位置
					case 'location':
						//获取用户的经度和纬度
						//经度
						$Location_Y = $postObj->Location_Y;
						$Location_X = $postObj->Location_X;
						$contentStr="你好！我们已经收到您上报的地理位置\r\n\r\n经度{$Location_Y}\r\n\r\n纬度{$Location_X}\r\n\r\n 请输入'cx+你需要查询的地方！'";
						//这里先返回菜单，填充模板即可
						$msgType = "text";
						$textTplRes=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
						echo $textTplRes;
						//将得到的经度和纬度入库，备用！
						//直接连接数据库
						$connect=mysql_connect('123.207.124.250','root','root');
						mysql_select_db('weixin');
						mysql_query("SET NAME UTF8");
						//1.用户存在，更新
						$sql="SELECT wxname FROM members WHERE wxname='{$fromUsername}'";
						$res =mysql_query($sql);
						if($row = mysql_fetch_assoc($res)){
							//更新
							$sql="UPDATE members SET longitude='{$Location_Y}',latitude='{$Location_X}',join_time='{$time}' WHERE wxname='{$fromUsername}'";
							mysql_query($sql);
						}else{
							//添加
							$sql="INSERT INTO members (wxname,longitude,latitude,join_time) VALUES('{$fromUsername}','{$Location_Y}','{$Location_X}','{$time}')";
							mysql_query($sql);
						}
						break;
					default:
						break;
				}
				
				//如果用户输入不为空
				/*if(!empty( $keyword ))
                {
              		$msgType = "text";
					
					//返回的内容是"Welcome to wechat world!";
                	$contentStr = "Welcome to wechat world!";
					if($keyword == "OK"){
						$contentStr = "Welcome to Haha";
					}else{
						$result="";
						preg_match('/(\d+)([+-])(\d+)/i',$keyword,$res);
						if($res[2]=='+'){
							$result =$res[1]+$res[3];
						}else if($res[2]=='-'){
							$result =$res[1]-$res[3];
						}
						$contentStr = "Welcome ! 结果是：".$result;
					}
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					//结果返回
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }
				*/
        }else {
        	echo "";
        	exit;
        }
    }
	private function getToken(){
		$appid="wx3df51c08fa2bf107";
		$appsecret="1b6f7edc7a255abd17709a65ffba9fa6";
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$output=curl_exec($ch);
		curl_close($ch);
		$jsoninfo=json_decode($output,true);
		$access_token=$jsoninfo["access_token"];
		return $access_token."..";
		
	}	
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>