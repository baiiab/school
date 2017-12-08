<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Transinfodata as modelTrans;
class Transinfo extends Base
{
//  某学员所有异常信息
    public function index(){
        $id = input('id');
        $transinfo = new modelTrans();
//        dump($id);die;
        $result = $transinfo
//            ->alias('c')
            ->field('sid,name,tname,gname,sendtime,backtime,reason,status')
//            ->join('student s','s.sid = c.sid')
//            ->join('teacher t','t.mobile = c.tid')
//            ->join('guardian g','c.gid = g.mobile')
            ->where('sid',$id)->order('sendtime desc')->paginate(30);
//        dump($result);die;
        $this->assign('admin',$result);
        return view();
    }

//  根据学号查找学员异常信息
    public function searchBySid(){
        $id = input('id');
//        $arr = explode($id);
//        dump($id[0]);die;
        $map['sid']=$id[0];
        $map['status']=$id[2];
        $transinfo = new modelTrans();
//        dump($id);die;
        $result = $transinfo
//            ->alias('c')
            ->field('sid,name,tname,gname,sendtime,backtime,reason')
//            ->join('student s','s.sid = c.sid')
//            ->join('teacher t','t.mobile = c.tid')
//            ->join('guardian g','c.gid = g.mobile')
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
//            ->alias('c')
            ->field('sid,name,tname,gname,sendtime,backtime,reason')
//            ->join('student s','s.sid = c.sid')
//            ->join('teacher t','t.mobile = c.tid')
//            ->join('guardian g','c.gid = g.mobile')
            ->where('status',$id)->order('sendtime desc')->paginate(30);
//        dump($result);die;
        $this->assign('admin',$result);
        return view();
    }
}
