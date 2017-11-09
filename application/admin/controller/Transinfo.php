<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Transinfo as modelTrans;
class Transinfo extends Controller
{
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
            ->where('c.sid',$id)->order('sendtime desc')->paginate(3);
//        dump($result);die;
        $this->assign('admin',$result);
        return view();
    }
    public function trans(){
        $id = input('id');
        if($id==0){
            session('exception','课程异常');
        }else{
            session('exception','驳回');
        }
//        dump($id);die;
        $transinfo = new modelTrans();

//        dump($id);die;
        $result = $transinfo
            ->alias('c')
            ->field('c.sid,student.name,teacher.tname,guardian.gname,sendtime,backtime,reason')
            ->join('student s','s.sid = c.sid')
            ->join('teacher t','t.tid = c.tid')
            ->join('guardian g','c.gid = g.gid')
            ->where('c.status',$id)->order('sendtime desc')->paginate(3);
//        dump($result);die;
        $this->assign('admin',$result);
        return view();
    }
}
