<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\mobil\controller;
use think\Controller;
use app\admin\model\Guardian as guardianModle;
class Guardian extends Controller
{
    public function home(){
        $guardian = guardianModle::getByMobile(input('mobile'));
        $this->assign('guardian',$guardian);
        return view();
    }

    public function login(){
        if(request()->isPost()){
            $admin = new guardianModle();
            $result = $admin->login(input('post.'));
            if($result==3){
                $this->redirect('home',['mobile'=>input('mobile')]);
            }else{
                show_msg('用户名或密码错误');
            }
        }
        return view();
    }

    public function logout(){
        session(null);
        $this->redirect('login');
    }

    public function editpas(){
        if(request()->isPost()){
            $guardian = guardianModle::getByMobile(session('mobile'));
            if($guardian->password == md5(input('oldpas'))){
                $guardian->password = md5(input('password'));
                if($guardian->save()){
                    show_msg('修改密码成功',url('home'));
                }
            }else{
                show_msg('原来密码输入不正确');
            }
        }
        return view();
    }
}