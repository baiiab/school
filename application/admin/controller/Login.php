<?php
namespace app\Admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function login()
    {
        if(request()->isPost()){
//            $captcha = new \think\captcha\Captcha();
//            if(!$captcha->check(input('code'))){
//                show_msg('验证码错误');
//            }
            $admin = new Admin();
            $result = $admin->login(input('post.'));
            if($result==3){
                $this->redirect('student/lst');
            }else{
                show_msg('用户名或密码错误');
            }
        }
        return view();
    }

    public function logout(){
        session(null);
        $this->redirect('login/login');
    }

}
