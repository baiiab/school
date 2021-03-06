<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 15:19
 */
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Evection;
use app\admin\model\Signed;
use app\admin\model\Holiday;
use app\admin\model\Systemnews;

class Attendance extends Base
{
    //签到情况表
    public function signed()
    {
        $signs = new Signed();
        $students = $signs
        ->alias('a')
        ->field('a.tid,t.tname,signtime,a.position')
        ->join('teacher t','a.tid = t.mobile')
        ->order('signtime desc')->paginate(30);
//        dump($students);die;
        $this->assign('students', $students);
        return $this->fetch('lst');
    }
    //根据姓名检索签到教师
    public function searchTeacher(){
        $id = input('id');
        $map['tname']=['like','%'.$id.'%'];
        $signs = new Signed();
        $students = $signs
            ->alias('a')
            ->field('a.tid,t.tname,signtime,a.position')
            ->join('teacher t','a.tid = t.mobile')
            ->where($map)->order('signtime desc')->paginate($listRows=30,$simple=false,                                $config=['query'=>['id'=>$id]]);
//        dump($students);die;
        $this->assign('students', $students);
        return $this->fetch('lst');
//        dump($students);die;
    }
    //根据日期检索签到教师情况
    public function searchDay(){
        $id = input('id');
//        dump($id);die;
        $starttime = strtotime($id.' 00:00:00');
        $endtime = strtotime($id.' 23:59:59');
//        $signs = new Signed();
        $signs = new Signed();
        $students = $signs
            ->alias('a')
            ->field('a.tid,t.tname,signtime,a.position')
            ->join('teacher t','a.tid = t.mobile')
            ->where('signtime',['>',$starttime],['<',$endtime],'and')
            ->order('signtime desc')->paginate($listRows=30,$simple=false,                                $config=['query'=>['id'=>$id]]);
        $this->assign('students', $students);
        return $this->fetch('lst');
    }
//  请假老师信息
    public function holiday(){
//        echo strtotime('next week');die;
        $signs = new Holiday();
        $students = $signs
            ->alias('a')
            ->field('a.tid,t.tname,asktime,holidaytime,reason,tutor')
            ->join('teacher t','a.tid = t.mobile')
            ->order('asktime desc')->paginate(30);
        $this->assign('students', $students);
        return view();
    }
    //根据姓名检索请假教师
    public function searchholiday(){
//        echo strtotime('next week');die;
        $id = input('id');
        $map['tname']=['like','%'.$id.'%'];
        $signs = new Holiday();
        $students = $signs
            ->alias('a')
            ->field('a.tid,t.tname,asktime,holidaytime,reason,tutor')
            ->join('teacher t','a.tid = t.mobile')
            ->where($map)->order('asktime desc')
            ->paginate($listRows=30,$simple=false,$config=['query'=>['id'=>$id]]);
        $this->assign('students', $students);
        return $this->fetch('holiday');
    }
//  出差教师信息
    public function evection(){
//        echo strtotime('next week');die;
        $signs = new Evection();
        $students = $signs
            ->alias('a')
            ->field('a.tid,t.tname,asktime,holidaytime,place,purpose,tutor')
            ->join('teacher t','a.tid = t.mobile')
            ->order('asktime desc')->paginate(30);
        $this->assign('students', $students);
        return view();
    }
    //根据姓名检索请假教师
    public function searchevection(){
//        echo strtotime('next week');die;
        $id = input('id');
        $map['tname']=['like','%'.$id.'%'];
        $signs = new Evection();
        $students = $signs
            ->alias('a')
            ->field('a.tid,t.tname,asktime,holidaytime,place,purpose,tutor')
            ->join('teacher t','a.tid = t.mobile')
            ->where($map)->order('asktime desc')
            ->paginate($listRows=30,$simple=false,$config=['query'=>['id'=>$id]]);
        $this->assign('students', $students);
        return $this->fetch('evection');
    }
    //系统消息
    public function sysnews(){
        $id = input('id');
        $map['status']=$id;
        $sysnews = new Systemnews();
        $students = $sysnews
            ->alias('a')
            ->field('sendtime,content')
            ->where($map)
            ->order('sendtime desc')->paginate(30);
        $this->assign(['students'=> $students,'status'=>$id]);
        return view();
    }
    public function sendMsg(){
        if(request()->isPost()){
            $data = input('post.');
            if(strlen($data['content'])>700) show_msg('字符串过长');
            $data['sendtime'] = time();
            if(db('systemnews')->insert($data)){
                show_msg('发送成功',url('sysnews?id='.$data['status']));
            }else{
                show_msg('发送失败');
            }
        }
        $this->assign('status',input('id'));
        return view();
    }
}