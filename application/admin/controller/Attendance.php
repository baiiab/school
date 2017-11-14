<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 15:19
 */
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Signed;
use app\admin\model\Holiday;

class Attendance extends Base
{
    //签到情况表
    public function signed()
    {
        $signs = new Signed();
        $students = $signs
        ->alias('a')
        ->field('a.tid,t.tname,signtime,position')
        ->join('teacher t','a.tid = t.tid')
        ->order('signtime desc')->paginate(3);
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
            ->field('a.tid,t.tname,signtime,position')
            ->join('teacher t','a.tid = t.tid')
            ->where($map)->order('signtime desc')->paginate($listRows=3,$simple=false,                                $config=['query'=>['id'=>$id]]);
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
            ->field('a.tid,t.tname,signtime,position')
            ->join('teacher t','a.tid = t.tid')
            ->where('signtime',['>',$starttime],['<',$endtime],'and')
            ->order('signtime desc')->paginate($listRows=2,$simple=false,                                $config=['query'=>['id'=>$id]]);
        $this->assign('students', $students);
        return $this->fetch('lst');
    }

    public function holiday(){
//        echo strtotime('next week');die;
        $signs = new Holiday();
        $students = $signs
            ->alias('a')
            ->field('a.tid,t.tname,asktime,holidaytime,reason,g.gname')
            ->join('teacher t','a.tid = t.tid')
            ->join('guardian g','a.gid = g.gid')
            ->order('asktime desc')->paginate(3);
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
            ->field('a.tid,t.tname,asktime,holidaytime,reason,g.gname')
            ->join('teacher t','a.tid = t.tid')
            ->join('guardian g','a.gid = g.gid')
            ->where($map)->order('asktime desc')
            ->paginate($listRows=2,$simple=false,$config=['query'=>['id'=>$id]]);
        $this->assign('students', $students);
        return $this->fetch('holiday');
    }
}