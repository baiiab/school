<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Transinfo as modelTrans;
class Transinfo extends Controller
{
//  某学员所有异常信息
    public function index(){
        $id = input('id');
        $transinfo = new modelTrans();
//        dump($id);die;
        $result = $transinfo
            ->alias('c')
            ->field('c.sid,student.name,teacher.tname,guardian.gname,sendtime,backtime,reason,status')
            ->join('student s','s.sid = c.sid')
            ->join('teacher t','t.tid = c.tid')
            ->join('guardian g','c.gid = g.gid')
            ->where('c.sid',$id)->order('sendtime desc')->paginate(30);
//        dump($result);die;
        $this->assign('admin',$result);
        return view();
    }

//  根据学号查找学员异常信息
    public function searchBySid(){
        $id = input('id');
//        $arr = explode($id);
//        dump($id[0]);die;
        $map['c.sid']=$id[0];
        $map['c.status']=$id[2];
        $transinfo = new modelTrans();
//        dump($id);die;
        $result = $transinfo
            ->alias('c')
            ->field('c.sid,student.name,teacher.tname,guardian.gname,sendtime,backtime,reason')
            ->join('student s','s.sid = c.sid')
            ->join('teacher t','t.tid = c.tid')
            ->join('guardian g','c.gid = g.gid')
            ->where($map)->order('sendtime desc')->paginate($listRows=30,$simple=false,                                $config=['query'=>['id'=>$id]]);
//        dump($result);die;
        $this->assign('admin',$result);
        return $this->fetch('trans');
    }

//  所有学员课程或驳回异常信息
    public function trans(){
        $id = input('id');
        session('exception',$id);
//        dump($id);die;
        $transinfo = new modelTrans();

//        dump($id);die;
        $result = $transinfo
            ->alias('c')
            ->field('c.sid,student.name,teacher.tname,guardian.gname,sendtime,backtime,reason')
            ->join('student s','s.sid = c.sid')
            ->join('teacher t','t.tid = c.tid')
            ->join('guardian g','c.gid = g.gid')
            ->where('c.status',$id)->order('sendtime desc')->paginate(30);
//        dump($result);die;
        $this->assign('admin',$result);
        return view();
    }
}
