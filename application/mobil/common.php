<?php
use think\Loader;
use think\Db;

//公众号获取openId
function get_openId(){
//    $appId = 'wx39daf877da7f62e9';
    $appId = config('PUBLIC_APPID');
    $uri = urlencode(WB_CALLBACK_URL);
    $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$uri&response_type=code&scope=snsapi_userinfo&state=$appId#wechat_redirect";
    return $url;
}

