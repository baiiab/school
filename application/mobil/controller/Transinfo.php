<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\mobil\controller;
use app\mobil\controller\Base;
use app\admin\model\Transinfo as modelTrans;
use app\admin\model\Transinfodata;
use app\admin\model\Message;
class Transinfo extends Base
{
    public function recedetail(){
        $messsage = new Message();
        $trans = new modelTrans();
        $map1 = ['gid'=>session('mobile'),'a.tid'=>input('tid')];
        $map2 = ['gid'=>session('mobile'),'a.tid'=>input('tid')];
        $map = ['gid'=>session('mobile'),'a.tid'=>input('tid'),'status'=>1];
        if(input('?name')){
            $map1['s.name']  = ['like','%'.input('name').'%'];
            $map2['s.name']  = ['like','%'.input('name').'%'];
            $map['s.name']  = ['like','%'.input('name').'%'];
        }
        $students = $messsage->alias('a')->field('a.sid,s.headimg,s.name,s.sex,s.cid')
            ->join('student s','a.sid=s.sid')
            ->where($map2)->select();
        $student = $trans->alias('a')->field('s.headimg,s.name,s.sex,s.cid')
            ->join('student s','a.sid=s.sid')
            ->where($map1)->where('status','neq',1)->select();
        $bstudent = $trans->alias('a')->field('s.headimg,s.name,s.sex,s.cid,reason')
            ->join('student s','a.sid=s.sid')
            ->where($map)->select();
        $this->assign(['students'=>$students,'student'=>$student,'bstudent'=>$bstudent]);
        return view();
    }
//  学员交接主界面
    public function handtran(){
        $tp = db('student')->where('tid',session('mobile'))->count();
        $g = db('transinfo')->where('gid',session('mobile'))->count();
        $p = db('message')->where('gid',session('mobile'))->count();
        $gp = $g+$p;
        $peo = db('message')->distinct(true)->field('tid')->where('gid',session('mobile'))->select();
        if(!$peo) db('transinfo')->where('gid',session('mobile'))->delete();
        foreach ($peo as $k=>$va){
            $result = db('transinfo')->where(['gid'=>session('mobile'),'tid'=>$va['tid'],'status'=>1])->select();
            $resul = db('message')->where(['gid'=>session('mobile'),'tid'=>$va['tid']])->select();
            $res = db('transinfo')->where(['gid'=>session('mobile'),'tid'=>$va['tid']])->select();
            $resu = db('transinfo')->where(['gid'=>session('mobile'),'tid'=>$va['tid']])->where('status','neq',1)->select();
            $peo[$k]['name'] = db('teacher')->field('tname')->where('mobile',$va['tid'])->find();
            $peo[$k]['num'] = count($res)+count($resul);
//            dump($resul);die;
            if(!$resul){
                db('transinfo')->where(['gid'=>session('mobile'),'tid'=>$va['tid']])->delete();
                unset($peo[$k]);
            }else{
                if($peo[$k]['name']){
                    $peo[$k]['name'] = $peo[$k]['name']['tname'];
                }else{
                    $peo[$k]['name'] = db('guardian')->field('gname')->where('mobile',$va['tid'])->find();
                    $peo[$k]['name'] = $peo[$k]['name']['gname'];
                }
                $peo[$k]['sendtime'] = $resul[0]['sendtime'];
                $peo[$k]['back'] = count($result);
                $peo[$k]['confirm'] = count($resu);
            }
        }
        $this->assign(['tp'=>$tp,'gp'=>$gp,'peo'=>$peo]);
        return view();
    }

    public function lst(){
        $time = strtotime('-30 day');
        $map['mobile'] = session('mobile');
        $map['backtime'] = ['>',$time];
        $students = db('transinfodata')
            ->field('name,headimg,reason,gender,cid,gname,backtime,status')
            ->where($map)->order('backtime desc')->select();
        $this->assign('list',$students);
        return view();
    }
    //根据日期检索学员接收情况
    public function searchDay(){
        $id = input('day');
        $starttime = strtotime($id.' 00:00:00');
        $endtime = strtotime($id.' 23:59:59');
        $students = db('transinfodata')->where('backtime',['>',$starttime],['<',$endtime],'and')
            ->where('mobile',session('mobile'))->select();
        $this->assign('list', $students);
        return $this->fetch('lst');
    }
//  点击确认接收按钮时
    public function receive(){
        $sid = input('sid');
        $sid = explode(',',$sid);
        foreach ($sid as $vo){
            $result = db('message')->where('sid',$vo)->find();
            $student = db('student')->where('sid',$vo)->find();
            unset($result['id']);
            $result['backtime'] = time();
            if(input('?reason')) $result['reason'] = input('reason');
            $result['status'] = 2;
            if(db('transinfo')->where('sid',input('sid'))->find()) db('transinfo')->where('sid',$sid)->delete();
            db('transinfo')->insert($result);
            db('message')->where('sid',$vo)->delete();
            $tname = db('teacher')->where('mobile',$result['tid'])->find();
            db('student')->where('sid',$vo)->update(['tid'=>session('mobile')]);

            $data['backtime'] = time();
            $data['status'] = 2;
            $data['sid'] = $vo;
            $data['tname'] = $tname['tname'];
            $data['sendtime'] = $tname['sendtime'];
            $data['reason'] = input('reason');
            $data['name'] = $student['name'];
            $data['gender'] = $student['sex'];
            $data['cid'] = $student['cid'];
            $data['gname'] = session('name');
            $data['headimg'] = $student['headimg'];
            $data['mobile'] = $result['tid'];
            db('transinfodata')->insert($data);
        }
        return;
    }
//  点击驳回时
    public function reject(){
        $result = db('message')->where('sid',input('sid'))->find();
        $tname = db('teacher')->where('mobile',$result['tid'])->find();
        $infodata = new Transinfodata();
        $trans = new modelTrans();
        unset($result['id']);
        $result['backtime'] = time();
        $result['tname'] = $tname['tname'];
        $result['reason'] = input('reason');
        $result['status'] = 1;
        $student = db('student')->where('sid',input('sid'))->find();
//        dump($student);die;
        $result['name'] = $student['name'];
        $result['gender'] = $student['sex'];
        $result['cid'] = $student['cid'];
        $result['gname'] = session('name');
        $result['headimg'] = $student['headimg'];
        $result['mobile'] = $result['tid'];
        if($trans->where('sid',input('sid'))->find())
            $nowhy = $trans->allowField(true)->save($result,['sid'=>input('sid')]);
        else $nowhy = $trans->allowField(true)->save($result);
        if($nowhy){
            $infodata->allowField(true)->save($result);
            $content = [
                'name' => session('name'),
                'sname' => $student['name'],
            ];
            $op = db('user')->where('mobile',$result['tid'])->find();
            push_weChatmsg($op['openid'],$content,'2');
            $news = [
                'sendtime' => $result['backtime'],
                'content' => session('name').'已驳回学员'.$student['name'].'，请尽快处理',
                'status' => $result['tid'],
            ];
            db('systemnews')->insert($news);
            db('message')->where('sid',input('sid'))->delete();
            show_msg('成功驳回');
        }else{
            show_msg('驳回失败');
        }
    }

}