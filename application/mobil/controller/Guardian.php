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
        if(request()->isPost()){
            $file = request()->file('headimg');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static/mobil/uploads');
            $data['headimg'] = '/uploads/'.$info->getSaveName();
            $pic = db('guardian')->where('mobile',session('mobile'))->find();
            $pic['headimg'] = str_replace('\\','/',$pic['headimg']);
            unlink(ROOT_PATH . 'public' . DS .'static/mobil'.$pic['headimg']);
            db('guardian')->where('mobile',session('mobile'))->update($data);
        }
        $guardian = guardianModle::getByMobile(session('mobile'));
        $this->assign('guardian',$guardian);
        return view();
    }

    public function login(){
//        $result = db('user')->where('openid',session('openid')->find();
//        if(){
//            db('guardian')->where('mobile',)
//        }
        if(request()->isPost()){
            $admin = new guardianModle();
            $result = $admin->login(input('post.'));
            if($result==3){
                $data = ['openid'=>session('openid'),'status'=>session('mobile')];
                db('user')->insert($data);
                $this->redirect('home');
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