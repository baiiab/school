<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\index\controller;
use app\index\controller\Base;
use app\admin\model\Teacher as teacherModle;
class Teacher extends Base
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
        $syss = db('systemnews')->where('status','0')->select();
        $news = 0;
        foreach ($syss as $vo){
            if(!strstr($vo['isread'],session('mobile'))) $news++;
        }
        $trans = db('systemnews')->where('status',session('mobile'))->select();
        foreach ($trans as $vo){
            if(!strstr($vo['isread'],session('mobile'))) $news++;
        }
        $guardian = teacherModle::getByMobile(session('mobile'));
        $this->assign('news',$news);
        $this->assign('guardian',$guardian);
        return view();
    }

    public function logout(){
        db('user')->where('mobile',session('mobile'))->delete();
        $this->redirect('login/login');
    }

    public function editpas(){
        if(request()->isPost()){
            $guardian = teacherModle::getByMobile(session('mobile'));
            if($guardian->password == md5(input('oldpas'))){
                $guardian->password = md5(input('password'));
                if($guardian->save()){
                    show_msg('修改密码成功',url('home'));
                }
            }else{
                show_msg('旧密码输入不正确');
            }
        }
        return view();
    }

}