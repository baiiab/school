<?php
namespace app\Admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function login()
    {
        if(request()->isPost()){
            $captcha = new \think\captcha\Captcha();
            if(!$captcha->check(input('code'))){
                $this->error('验证码错误');
            }
            $admin = new Admin();
            $result = $admin->login(input('post.'));
            if($result==3){
                $this->success('登录成功','student/lst');
            }else{
                $this->error('用户名或密码错误');
            }
        }
        return view();
    }

    public function logout(){
        session(null);
        $this->success('退出成功','login');
    }

}
