<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\mobil\controller;
use app\mobil\controller\Base;
use app\admin\model\Guardian as guardianModle;
class Guardian extends Base
{
    public function home(){
        $syss = db('systemnews')->where('status','1')->select();
        $news = 0;
        foreach ($syss as $vo){
            if(!strstr($vo['isread'],session('mobile'))) $news++;
        }
        $trans = db('systemnews')->where('status',session('mobile'))->select();
        foreach ($trans as $vo){
            if(!strstr($vo['isread'],session('mobile'))) $news++;
        }
        $guardian = guardianModle::getByMobile(session('mobile'));
        $this->assign('guardian',$guardian);
        $this->assign('news',$news);
        return view();
    }

    public function logout(){
        db('user')->where('mobile',session('mobile'))->delete();
        $this->redirect('login/login');
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