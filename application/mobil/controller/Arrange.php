<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\mobil\controller;
//use app\admin\controller\Base;
use think\Controller;
use think\Db;
class Arrange extends Controller
{
    public function index(){
        $sql = 'select * from student where tid='.session('mobile'). ' and sid not in(select sid from message UNION SELECT sid FROM transinfo)';
        $result = Db::query($sql);
//        dump($result);die;
        $unconfirmed = db('message')->alias('a')->field('s.headimg,s.name,tname,s.sex,s.cid')
            ->join('student s','a.sid=s.sid')->join('teacher t','a.gid=t.mobile')
            ->where('a.tid',session('mobile'))->select();
        $confirmed = db('transinfo')->alias('a')->field('t.name,sex,t.cid,s.tname,t.headimg')
            ->join('teacher s','a.gid=s.mobile')->join('student t','t.sid=a.sid')
            ->where('a.tid',session('mobile'))->where('a.status','neq',1)->select();
        $reject = db('transinfo')->alias('a')->field('t.name,sex,t.cid,s.tname,t.headimg,reason')
            ->join('teacher s','a.gid=s.mobile')->join('student t','t.sid=a.sid')
            ->where(['a.tid'=>session('mobile'),'a.status'=>1])->select();
        $this->assign(['students'=>$result,'unconfirmed'=>$unconfirmed,'confirmed'=>$confirmed,'reject'=>$reject]);
        return view();
    }
}