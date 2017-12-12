<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\mobil\controller;
use app\mobil\controller\Base;
class Student extends Base
{
    public function lst(){
        $students = db('student')->where('tid',session('mobile'))->select();
        $this->assign('student',$students);
        return view();
    }

    public function detail(){
        $sid = input('id');
        $student = db('student')->where('sid',$sid)->find();
        $this->assign('student',$student);
        return view();
    }

    public function addStudent()
    {
        if(request()->isPost()){
            $data = input('post.');
            $data['tid'] = session('mobile');
            if($_FILES['headimg']['tmp_name']){
                $file = request()->file('headimg');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/mobil/uploads');
                $data['headimg'] = '/uploads/'.$info->getSaveName();
            }
            $data['year'] = '20'.substr($data['cid'],0,2);
            $data['detid'] = session('mobile');
            if(db('student')->insert($data)){
                return show_msg('添加学员成功',url('lst'));
            }else{
                return show_msg('添加学员失败');
            }
            return;
        }
        $class = db('class')->field('cid')->order('cid desc')->select();
        $this->assign('list',$class);
        return view();
    }

    //  根据学号删除学员
    public function del(){
        $id = input('sid');
//        dump($id);die;
        if(db('student')->where('sid',$id)->update(['tid'=>''])){
            show_msg('删除学员成功',url('lst'));
        }else{
            show_msg('删除学员失败!');
        }
    }

}