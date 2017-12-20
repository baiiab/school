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
function getWxConfig(){
    $APPID = config('PUBLIC_APPID');
    $APPSECRET = config('PUBLIC_APP_SECRET');
    $jssdk = new Jssdk($APPID, $APPSECRET);
    $info = $jssdk->getSignPackage("wechat.dreamwintime.com/school/public/index/attendance/index.html");
    $data = array(
        'appId' => $info['appId'],
        'timestamp'=> $info['timestamp'],
        'nonceStr'=> $info['nonceStr'],
        'signature'=> $info['signature'],
        'url'=> $info['url'],
    );
    return $data;
}
function push_weChatmsg($touser, $content,$type)
{

    $APPID = config('PUBLIC_APPID');
    $APPSECRET = config('PUBLIC_APP_SECRET');

    $jssdk = new Jssdk($APPID, $APPSECRET);
    $accessToken = $jssdk->getAccessToken();

    $send_template_id = 'bfa1Uz4Wlo_HhuB0B9w9I0UgGYcbWcQ5xmOkuQpXHzg';   //test
    $send_confirm_id = 'a8m4N0lsnem3b617-Ib3D6dbyvnL-Jwy2HaUIMdjH8Y';   //安排确认
    $send_reject_id = 'iS6RLmYZzZvTNmiHdimPVka2Imrx0VcpBnVtPQQOv_k';   //驳回
    $now = date('Y-m-d H:i');

    if($type == '1') {
        $postdata = json_encode(
            array(
                "touser" => $touser,
                "template_id" => $send_confirm_id,
                "data" => array(
                    "first" => array("value" => "您有新的学员待确认接收", "color" => "#173177"),
                    "keyword1" => array("value" => "{$content['name']}", "color" => "#173177"),
                    "keyword2" => array("value" => "{$now}", "color" => "#173177"),
                    "keyword3" => array("value" => "{$content['num']}", "color" => "#173177"),
                    "remark" => array("value" => "请尽快确认,确保学员考勤无误", "color" => "#173177"),
                ),
            )
        );
    }else{
        $postdata = json_encode(
            array(
                "touser" => $touser,
                "template_id" => $send_reject_id,
                "data" => array(
                    "first" => array("value" => "您有新的学员被驳回", "color" => "#173177"),
                    "keyword1" => array("value" => "{$content['name']}", "color" => "#173177"),
                    "keyword2" => array("value" => "{$content['sname']}", "color" => "#173177"),
                    "keyword3" => array("value" => "{$now}", "color" => "#173177"),
                    "remark" => array("value" => "请尽快确认,确保学员考勤无误", "color" => "#173177"),
                ),
            )
        );
    }
//  普通文本
//    $data = '{
//        "touser":"'.$touser.'",
//        "msgtype":"text",
//        "text":
//        {
//             "content":"'.$content.'"
//        }
//    }';

    if ($touser) {
        //普通文本
//        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $accessToken;
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$accessToken";
        $result = https_post($url, $postdata);
        if ($result === true) {
            return true;
        } else {
            return $result;
        }
    }
}

//公众号获取openId
function get_openId(){
//    $appId = 'wx39daf877da7f62e9';
    $appId = config('PUBLIC_APPID');
    $uri = urlencode(WB_CALLBACK_URL);
    $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$uri&response_type=code&scope=snsapi_userinfo&state=$appId#wechat_redirect";
    return $url;
}

function get_token() {
    $token = '';
    while (strlen($token) < 32) {
        $token .= mt_rand(0, mt_getrandmax());
    }
    $token = md5(uniqid($token, TRUE));
    return $token;
}

function https_post($url, $data)
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
        return 'Errno' . curl_error($curl);
    }
    curl_close($curl);
    return $result;
}

function show_msg($msg = "", $url = "")
{

//    @header("Content-Type:text/html;charset=utf-8");
    echo '<script src="/school/public/static/common/myJs.js"></script>';
    echo '<script type="text/javascript">';

    echo  'alert("' . $msg . '");';

    if (!empty($url)) {
        echo 'location.href = "' . $url . '"';
    } else {
        echo 'history.go(-1);';
    }

    echo '</script>';
    exit;
}

function curl_file_get_contents($durl)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $durl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;

}

