<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\index\controller;
//use app\admin\controller\Base;
use think\Controller;
use think\Db;
class Arrange extends Controller
{
    public function home(){
        $class = db('student')->distinct(true)->field('cid')->where('tid',session('mobile'))->select();
        foreach ($class as $k=>$vo){
            $class[$k]['num'] = db('student')->where(['cid'=>$vo['cid'],'tid'=>session('mobile')])->count();
            $class[$k]['confirmed'] = db('transinfo')->alias('a')->join('student s','a.sid=s.sid')
                ->where('s.cid',$vo['cid'])->where('status','neq',1)->count();
            $class[$k]['back'] = db('transinfo')->alias('a')->join('student s','a.sid=s.sid')
                ->where('s.cid',$vo['cid'])->where('status',1)->count();
        }
//        dump($class);die;
        $groups = db('studentgroup')->where('tid',session('mobile'))->select();
        foreach ($groups as $k=>$group) {
            $sids = $group['sids'];
            $map['sid'] = ['in', $sids];
            $map['tid'] = session('mobile');
            $result = db('student')->where($map)->select();
            $confirmed = db('transinfo')->where('status','neq',1)->where($map)->select();
            $back = db('transinfo')->where('status',1)->where($map)->select();
            if ($result||$confirmed) {
                $groups[$k]['num'] = substr_count($sids,',')+1;
                $groups[$k]['confirmed'] = count($confirmed);
                $groups[$k]['back'] = count($back);
            } else {
                unset($groups[$k]);
            }
        }
        $this->assign(['class'=>$class,'groups'=>$groups]);
        return view();
    }
    //分组或班级学员交接详情
    public function index(){
        $fsid = Db::field('sid')->table('message')->union('SELECT sid FROM transinfo WHERE status!=1')->select();
        $fsids = '';
        foreach ($fsid as $vo){
            $fsids .= $vo['sid'].',';
        }
        $map = ['sid'=>['not in',substr($fsids, 0, -1)],'tid'=>session('mobile')];
        $map1 = ['a.tid'=>session('mobile')];
        $map2 = ['a.tid'=>session('mobile'),'a.status'=>['neq',1]];
        $map3 = ['a.tid'=>session('mobile'),'a.status'=>1];
        if(input('?name')){
            $map1['s.name'] = ['like','%'.input('name').'%'];
            $map2['t.name']  = ['like','%'.input('name').'%'];
            $map3['t.name']  = ['like','%'.input('name').'%'];
            $map['name']  = ['like','%'.input('name').'%'];
        }
        if(input('?cid')) {
            $data = input('cid');
            $map['cid'] = $data;
            $map0 = true;
            $map1['s.cid'] = $data;
            $map2['t.cid'] = $data;
            $map3['t.cid'] = $data;
        }
        if(input('?group')){
            $data = input('group');
            $group = db('studentgroup')->where('name',$data)->where('tid',session('mobile'))->find();
            $sids = $group['sids'];
            $map0['sid'] = ['in',$sids];
            $map1['s.sid'] = ['in',$sids];
            $map2['t.sid'] = ['in',$sids];
            $map3['t.sid'] = ['in',$sids];
        }
        $result = db('student')->where($map0)->where($map)->select();
        $unconfirmed = db('message')->alias('a')->field('s.headimg,s.name,tname,s.sex,s.cid')
            ->join('student s','a.sid=s.sid')->join('teacher t','a.gid=t.mobile')
            ->where($map1)->select();
        $confirmed = db('transinfo')->alias('a')->field('t.name,sex,t.cid,s.tname,t.headimg')
            ->join('teacher s','a.gid=s.mobile')->join('student t','t.sid=a.sid')
            ->where($map2)->select();
        $reject = db('transinfo')->alias('a')->field('t.name,sex,t.cid,s.tname,t.headimg,reason')
            ->join('teacher s','a.gid=s.mobile')->join('student t','t.sid=a.sid')
            ->where($map3)->select();
        $this->assign(['students'=>$result,'unconfirmed'=>$unconfirmed,'confirmed'=>$confirmed,'reject'=>$reject]);
//        dump($result);die;

        return view();
    }
    public function choosep(){
        $sid = input('sid');
        if(input('?tname')){
            $teacher = db('teacher')->where('tname','like','%'.input('tname').'%')->select();
            $guardian = db('guardian')->where('gname','like','%'.input('tname').'%')->select();
        }else{
            $teacher = db('teacher')->select();
            $guardian = db('guardian')->select();
        }
        $this->assign(['teacher'=>$teacher,'guardian'=>$guardian,'sids'=>$sid]);
        return view();
    }
    //分配到相应监护人
    public function detid(){
        $sid = input('sid');
        $detid = db('student')->where('sid','in',$sid)->select();
        foreach ($detid as $vo){
            $data = [
                'gid'=>$vo['detid'],
                'tid'=>session('mobile'),
                'sendtime'=>time(),
                'sid' => $vo['sid'],
            ];
            db('message')->insert($data);
        }
        show_msg('成功分配到相应监护人，等待接收',url('home'));
    }
    //选择教师或监护人
    public function confirm(){
        $sid = input('sid');
        $map['sid'] = ['in',$sid];
        $sids = db('student')->field('sid,headimg,name')->where($map)->select();
        $gid = input('gid');
        $sgid = substr($gid,0,11);
        if(db('guardian')->where('mobile',$sgid)->find()){
            $sid = explode(',',$sid);
            $data = [
                'gid'=>$sgid,
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
            show_msg('安排成功，等待接收',url('home'));
        }
        $this->assign(['teacher'=>$gid,'sids'=>$sids,'sid'=>$sid]);
        return view();
    }
    //教师确认详情页面
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