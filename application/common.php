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
    $info = $jssdk->getSignPackage("http://www.zsletel.com/school/public/index/attendance/index.html");
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
//判断是否移动端
function is_mobile_request()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array('nokia',  'sony','ericsson','mot',
            'samsung','htc','sgh','lg','sharp','xiaomi',
            'sie-','philips','panasonic','alcatel',
            'lenovo','iphone','ipod','blackberry',
            'meizu','android','netfront','symbian',
            'ucweb','windowsce','palm','operamini',
            'operamobi','openwave','nexusone','cldc',
            'midp','wap','mobile'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
}

