<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\admin\controller;
use app\admin\controller\Base;
class Manager extends Base
{
    public function lst()
    {
        $students = db('admin')->paginate(30);
        $this->assign('list', $students);
        return $this->fetch('lst');
    }

    public function addAdmin()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            $data['password'] = md5($data['password']);
            if(db('admin')->where('aid',$data['aid'])->find()){
                show_msg('添加管理员失败,编号不能重复');
            }
            if(db('admin')->insert($data)){
                return show_msg('添加管理员成功',url('lst'));
            }else{
                return show_msg('添加管理员失败');
            }
        }

        return view();
    }

    public function edit()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if($data['password']!='') $data['password'] = md5($data['password']);
            else unset($data['password']);
            if(db('admin')->where('aid',$data['aid'])->update($data)){
                show_msg('修改信息成功',url('manager/lst'));
            }else{
                show_msg('修改失败');
            }
            return;
        }
        $id = input('aid');
        $admin = db('admin')->find($id);

//        dump($admin['year']);die;
        $this->assign('admin',$admin);
        return view();
    }
    //  根据编号删除管理员
    public function del(){
        $id = input('aid');
//        dump($id);die;
        if(db('admin')->where('aid',$id)->delete()){
            show_msg('删除管理员成功',url('manager/lst'));
        }else{
            show_msg('删除管理员失败!');
        }
    }
//  根据姓名寻找管理员
    public function searchAdmin(){
        $id = input('id');
        $map['name']=['like','%'.$id.'%'];
        $students = db('admin')->where($map)->paginate($listRows=30,$simple=false,                                $config=['query'=>['id'=>$id]]);
//        dump($students);die;
        $this->assign('list',$students);
        return $this->fetch('lst');
    }
}