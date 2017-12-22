<?php
namespace app\index\controller;
use think\Controller;
use app\admin\model\Teacher  as guardianModle;
class Login extends Controller
{
    public function login(){
        $admin = new guardianModle();
        $result = db('user')->where('openid',session('openid'))->find();
        if($result){
            $res = db('teacher')->where('mobile',$result['mobile'])->find();
            if(!$res) show_msg('你还不是教师用户，请联系管理员添加',url('mobil/login/login'));
            session('name',$res['tname']);
            session('password',$res['password']);
            session('mobile',$res['mobile']);
            session('tokensession',get_token());
            db('user')->where('openid',session('openid'))->update(['tokensession'=>session('tokensession')]);
            $this->redirect('transinfo/handtran');
        }
        if(request()->isPost()){
            $result = $admin->login(input('post.'));
            if($result==3){
//                $data = ['openid'=>session('openid'),'status'=>session('mobile')];
//                db('user')->insert($data);
                $this->redirect('transinfo/handtran');
            }else{
                show_msg('用户名或密码错误');
            }
        }
        return view();
    }
}
