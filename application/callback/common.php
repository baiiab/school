<?php
use think\Loader;
use think\Db;

/*curl get方式*/

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
