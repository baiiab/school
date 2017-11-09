<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\admin\controller;
use app\admin\controller\Base;
class Student extends Base
{
    public function lst(){
        $students = db('student')->paginate(8);
        $this->assign('students',$students);
        return $this->fetch('lst');
    }

    public function addClass()
    {
        if(request()->isPost()){
            $data = input('post.');
            if(db('class')->where('cid',$data['cid'])){
                $this->error('班级号重复');
            }
            db('class')->insert($data);
            $this->success('添加班级成功','lst');
        }
        return view();
    }

    public function addStudent()
    {
        if(request()->isPost()){
            $data = input('post.');
//            die($data['sid']);die;
            if(db('student')->where('sid',$data['sid'])->find()){
                $this->error('添加学员失败,学号不能重复');
            }
            if(db('student')->insert($data)){
                return $this->success('添加学员成功','lst');
            }else{
                return $this->error('添加学员失败');
            }
        }
        return view();
    }
    public function edit()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if(db('student')->where('sid',$data['sid'])->update($data)){
                $this->success('修改信息成功','lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $id = input('sid');
        $admin = db('student')->find($id);
        $this->assign('admin',$admin);
        return view();
    }
    public function del(){
        $id = input('sid');
//        dump($id);die;
        if(db('student')->where('sid',$id)->delete()){
            $this->success('删除学员成功','lst');
        }else{
            $this->error('删除学员失败!');
        }
    }
    public function logout(){
        session(null);
        $this->success('退出成功','Login/index');
    }

    public function searchStudent(){
        $id = input('id');
        $map['name']=['like','%'.$id.'%'];
        $students = db('student')->where($map)->paginate(8);
//        dump($students);die;
        $this->assign('students',$students);
        return $this->fetch('lst');
    }

}