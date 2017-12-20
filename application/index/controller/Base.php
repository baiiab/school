<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize(){
        if(!session('?name')){
//            $url=url('Login/login');
            show_msg('请先登录系统！',url('Login/login'));
        }
        $result = db('user')->where('mobile',session('mobile'))->find();
        if(session('tokensession')!=$result['tokensession']){
            db('user')->where('openid',session('openid'))->delete();
            show_msg('登录过期或您的账号已在其它地方登录',url('login/login'));
        }
    }
}
