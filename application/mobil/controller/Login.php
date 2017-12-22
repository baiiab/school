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
            if(!$res) show_msg('你还不是监护人用户，请联系管理员添加',url('index/login/login'));
            session('name',$res['gname']);
            session('password',$res['password']);
            session('mobile',$res['mobile']);
            session('tokensession',get_token());
            db('user')->where('openid',session('openid'))->update(['tokensession'=>session('tokensession')]);
            $this->redirect('transinfo/lst');
        }
        if(request()->isPost()){
            $result = $admin->login(input('post.'));
            if($result==3){
                $this->redirect('transinfo/lst');
            }else{
                show_msg('用户名或密码错误');
            }
        }
        return view();
    }
}
