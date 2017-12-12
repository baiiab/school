<?php
namespace app\mobil\controller;
use think\Controller;
use app\admin\model\Guardian as guardianModle;
class Login extends Controller
{
    public function login(){
        $admin = new guardianModle();
        $result = db('user')->where('openid',session('openid'))->find();
        if($result){
            $res = db('guardian')->where('mobile',$result['mobile'])->find();
            session('name',$res['gname']);
            session('password',$res['password']);
            session('mobile',$res['mobile']);
            session('tokensession',get_token());
            db('user')->where('openid',session('openid'))->update(['tokensession'=>session('tokensession')]);
            $this->redirect('guardian/home');
        }
        if(request()->isPost()){
            $result = $admin->login(input('post.'));
            if($result==3){
//                $data = ['openid'=>session('openid'),'status'=>session('mobile')];
//                db('user')->insert($data);
                $this->redirect('guardian/home');
            }else{
                show_msg('用户名或密码错误');
            }
        }
        return view();
    }
}
