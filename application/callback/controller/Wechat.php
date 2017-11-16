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
       /* $client_ip = get_client_ip();
        $time = date("H:i:s");
        $heard = "{$time} - {$client_ip}";
        $file = 'data/log/user/'.date('Y-m-d').'.txt';
        file_put_contents($file,"{$heard} wechat_POSTdata:".json_encode($_POST)."\r\n",FILE_APPEND);
        file_put_contents($file,"{$heard} wechat_GETdata:".json_encode($_GET)."\r\n",FILE_APPEND);*/
       $code = $_GET['code'];
       $appid = config('PUBLIC_APPID');
       $secret = config('PUBLIC_APP_SECRET');
//        $durl="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx39daf877da7f62e9&secret=96e1b4e11afa00ec02240329e8d713c0&code=$code&grant_type=authorization_code ";
        $durl="https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code=$code&grant_type=authorization_code ";
        $r = curl_file_get_contents($durl);
        //查询是否有这个opendId的用户，有就登陆，无就注册,最后保存user的tokenSession到session中
        $data = json_decode($r,true);
        $openId = $data['openid'];
        $access_token = $data['access_token'];
        //判断access_token是否过期
        $judge_url ="https://api.weixin.qq.com/sns/auth?access_token=$access_token&openid=$openId";
        $judge = curl_file_get_contents($judge_url);
        if(json_decode($judge,true)['errmsg']!='ok'){
            $appId = $_GET['state'];
            $refresh_token =$data['refresh_token'];
            $refresh_url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$appId&grant_type=refresh_token&refresh_token=$refresh_token ";
            $access_token = json_decode(curl_file_get_contents($refresh_url),true)['access_token'];
        }

        //拉取用户信息
        $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openId&lang=zh_CN";
        $info = json_decode(curl_file_get_contents($info_url),true);
        $nickname = $info['nickname'];
        $headimgurl = $info['headimgurl'];
        $userWhere = array("openid"=>$openId);
        $addData = [$nickname,$headimgurl,$openId];

//        $user = db("user")->where($userWhere)->find();
//        $token = get_token();
//        if($user){
//            $saveData = array("tokenSession"=>$token,'nickname'=>$nickname,'userImg'=>$headimgurl);
//            if($user['nickname']){
//                unset($saveData['nickname']);
//            }
//            if($user['userImg']){
//                unset($saveData['userImg']);
//            }
////            db("user")->where($userWhere)->update($saveData);
////            $userId = $user['userId'];
//        }else{
//            $addData = array(
//                "tokenSession"=>$token,
//                "createdTime" => date("Y-m-d H:i:s"),
//                "openid" => $openId,
//                'nickname'=>$nickname,
//                'headimgurl'=>$headimgurl,
//            );
////            db("user")->insert($addData);
////            $userId = $addData['userId'];
//        }
        dump($addData);die;
    }


}