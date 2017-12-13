<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\mobil\controller;
use app\mobil\controller\Base;
use think\Db;
class Arrange extends Base
{
    public function index(){
        $fsid = Db::field('sid')->table('message')->union('SELECT sid FROM transinfo WHERE status!=1')->select();
        $fsids = '';
        foreach ($fsid as $vo){
            $fsids .= $vo['sid'].',';
        }
        $map0 = ['sid'=>['not in',substr($fsids, 0, -1)],'tid'=>session('mobile')];

//        dump($result);die;
        $map = ['a.tid'=>session('mobile')];
        $map2 = ['a.tid'=>session('mobile'),'a.status'=>1];
        $map1 = ['a.tid'=>session('mobile'),'a.status'=>['neq',1]];
        if(input('?name')){
            $map0['name'] = ['like','%'.input('name').'%'];
            $map1['t.name']  = ['like','%'.input('name').'%'];
            $map2['t.name']  = ['like','%'.input('name').'%'];
            $map['s.name']  = ['like','%'.input('name').'%'];
        }
        $result = db('student')->where($map0)->select();
        $unconfirmed = db('message')->alias('a')->field('s.headimg,s.name,tname,s.sex,s.cid')
            ->join('student s','a.sid=s.sid')->join('teacher t','a.gid=t.mobile')
            ->where($map)->select();
        $confirmed = db('transinfo')->alias('a')->field('t.name,sex,t.cid,s.tname,t.headimg')
            ->join('teacher s','a.gid=s.mobile')->join('student t','t.sid=a.sid')
            ->where($map1)->select();
        $reject = db('transinfo')->alias('a')->field('t.name,sex,t.cid,s.tname,t.headimg,reason')
            ->join('teacher s','a.gid=s.mobile')->join('student t','t.sid=a.sid')
            ->where($map2)->select();
//        dump($reject);die;
        $this->assign(['students'=>$result,'unconfirmed'=>$unconfirmed,'confirmed'=>$confirmed,'reject'=>$reject]);
        return view();
    }
    public function chooset(){
        $sid = input('sid');
        if(input('?tname')){
            $teacher = db('teacher')->where('tname','like','%'.input('tname').'%')->select();
        }else{
            $teacher = db('teacher')->select();
        }
        $this->assign(['teacher'=>$teacher,'sids'=>$sid]);
        return view();
    }
    public function confirm(){
        $sid = input('sid');
        $map['sid'] = ['in',$sid];
        $sids = db('student')->field('sid,headimg,name')->where($map)->select();
        $gid = input('gid');
        $this->assign(['teacher'=>$gid,'sids'=>$sids,'sid'=>$sid]);
        return view();
    }
    public function change(){
        $value = input('value');
//        dump($value);die;
        $sid = explode(',',$value);
        $data = [
            'gid'=>array_pop($sid),
            'tid'=>session('mobile'),
            'sendtime'=>time(),
        ];
        foreach ($sid as $vo){
            $data['sid'] = $vo;
            db('message')->insert($data);
        }
        $content['name'] = session('name');
        $op = db('user')->where('mobile',$data['gid'])->find();
        push_weChatmsg($op['openid'],$content,'1');
        $news = [
            'sendtime' => $data['sendtime'],
            'content' => session('name').'已对您安排学员，请尽快确认',
            'status' => $data['gid'],
        ];
        db('systemnews')->insert($news);
        show_msg('安排成功，等待接收',url('arrange/index'));
    }
}