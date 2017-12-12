<?php
/**
 * Created by PhpStorm.
 * User: xiong
 * Date: 2017/8/11
 * Time: 11:01
 */
namespace app\callback\controller;

use think\Controller;

class Wechat extends Controller{
    public function openId(){
       $code = $_GET['code'];
       $state = $_GET['state'];
       $appid = config('PUBLIC_APPID');
       $secret = config('PUBLIC_APP_SECRET');
        $durl="https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code=$code&grant_type=authorization_code ";
        $r = curl_file_get_contents($durl);
        //查询是否有这个opendId的用户，有就登陆，无就注册,最后保存user的tokenSession到session中
        $data = json_decode($r,true);
        session('openid',$data['openid']);
//        dump(session('openid'));die;
        //判断access_token是否过期
        if($state==1){
            $this->redirect('index/login/login');
        }else{
            $this->redirect('mobil/login/login');
        }
    }


}