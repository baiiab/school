<?php
namespace app\Admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $captcha = new \think\captcha\Captcha();
            if(!$captcha->check(input('code'))){
                $this->error('验证码错误');
            }
            $admin = new Admin();
            $result = $admin->login(input('post.'));
            if($result==3){
                $this->success('登录成功','Index/index');
            }else{
                $this->error('用户名或密码错误');
            }
        }
        return $this->fetch('index');
    }

    //微信返回
    public function getUserInfo(){
        $wx = new Wechat();
        $code = $wx->get_authorize_url('baice');
        if($code){
            $access_data = $wx->get_access_token($code);
            dump($access_data);die;
            $userinfo = $wx->get_user_info($access_data['access_token'],$access_data['openid']);
        }else{
            dump('没code');
        }
    }

    public function sendYzm(){
        $to = $_GET['name'];
        $param = rand(1000,9999);
        $pas = ['to'=>$to,'param'=>$param];
        cookie('name', $pas, 180);
        $options['accountsid']='08f3a7af20317de07927226e625eed32';
        $options['token']='967eb242781e5a9a57710d7d29be36fd';
        //初始化 $options必填
        $ucpass = new Ucpaas($options);
        $appId = "31ab390d33a946fa97d38be8098cd8c1";
        $templateId = "179702";

        $result = $ucpass->templateSMS($appId,$to,$templateId,$param);
        return json_decode($result)->resp->respCode;
    }

    //微博返回
    public function  callback()
    {
        $o = new SaeTOAuthV2(WB_AKEY,WB_SKEY);
        $keys = array();
        $keys['code'] = $_REQUEST['code'];
        $keys['redirect_uri'] = WB_CALLBACK_URL;
        $token = $o->getAccessToken('code',$keys);
        if($token){
            $c = new SaeTClientV2( WB_AKEY , WB_SKEY , $token['access_token'] );
//            $uid_get = $c->get_uid();
//            $uid = $uid_get['uid'];
            $user_message = $c->show_user_by_id( $token['uid']);
            session('username',$user_message['screen_name']);
            $this->redirect('Index/index');
        }else{
            return $this->error('授权失败');
        }
    }

    public function weibolist()
    {
        $o = new SaeTClientV2(WB_AKEY,WB_SKEY,session('token')['access_token']);
        $uid_get = $o->get_uid();
        $uid = $uid_get['uid'];
        $user_message = $o->show_user_by_id( $uid);
        session('username',$user_message['screen_name']);
        $this->redirect('Index/index');
    }

    public function send(){
        $o = new SaeTClientV2(WB_AKEY,WB_SKEY,session('token')['access_token']);
        $ret = $o->share( $_REQUEST['text'] );	//发送微博
        if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
            echo "<p>发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
        } else {
            echo "<p>发送成功</p>";
        }
    }

}
