<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use wxSdk\Jssdk;
// 应用公共文件
function push_weChatmsg($touser,$content){

    $APPID=config('PUBLIC_APPID');
    $APPSECRET=config('PUBLIC_APP_SECRET');

    $jssdk = new Jssdk($APPID,$APPSECRET);
    $accessToken = $jssdk->getAccessToken();

    $data = '{
        "touser":"'.$touser.'",
        "msgtype":"text",
        "text":
        {
             "content":"'.$content.'"
        }
    }';

    if($touser){
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$accessToken;
        $result = https_post($url,$data);
        if($result===true){
            return true;
        }else{
            return $result;
        }
    }
}

function https_post($url,$data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        return 'Errno'.curl_error($curl);
    }
    curl_close($curl);
    return $result;
}

