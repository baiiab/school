<?php
use think\Loader;
use think\Db;

/*curl get方式*/
function curl_file_get_contents($durl){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $durl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;

}
//获取唯一token
function get_token() {
    $token = '';
    while (strlen($token) < 32) {
        $token .= mt_rand(0, mt_getrandmax());
    }
    $token = md5(uniqid($token, TRUE));
    return $token;
}
/*curl post方式*/
function curl_file_post_contents($url,$postdata){
    $ch = curl_init();
    $header[] = "Content-type: text/xml";//定义content-type为xml
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//定义是否直接输出返回流
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
}
