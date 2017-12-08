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

class Student extends Controller
{
    public function index(){
        $class = db('teacher')->field('cid')->where('mobile',session('mobile'))->find();
        $class['cid'] = explode(',',$class['cid']);
        foreach ($class['cid'] as $k=>$v){
            $cla[$k] = [
                'cid' => $v,
                'num' => db('student')->where('cid',$v)->count()
            ];
            if(input('?name')){
                if($v!=input('name')) unset($cla[$k]);
            }
        }
        if(input('?name')){
            $map['name'] = ['like','%'.input('name').'%'];
        }
        $map['tid'] = session('mobile');
        $group = db('studentgroup')->field('sgid,name,sids')->where($map)->select();
        $this->assign('class',$cla);
        $this->assign('group',$group);
        return view();
    }

    public function classdetail(){
        $cid = input('cid');
        $student = db('student')->where('cid',$cid)->select();
        $this->assign(['student'=>$student,'cid'=>$cid]);
        return view();
    }
    public function groupdetail(){
        $cid = input('sgid');
        $sids = db('studentgroup')->where(['sgid'=>$cid,'tid'=>session('mobile')])->find();
//        dump($sids);die;
        $sids['sids'] = input('sid').$sids['sids'];
        $student = db('student')->where('sid','in',$sids['sids'])->select();
        $this->assign(['student'=>$student,'cid'=>$sids]);
        if(input('sgid')=='') return $this->fetch('addgroup');
        return view();
    }
    //确认分组
    public function change(){
        $sids = input('sids');
        $sgid = input('sgid');
        if($sgid==''){
            $sids = substr($sids,0,-1);
            if(db('studentgroup')->insert(['name'=>input('name'),'sids'=>$sids,'tid'=>session('mobile')])){
                show_msg('添加分组成功');
            }else{
                show_msg('添加分组失败');
            }
        }else{
            if(db('studentgroup')->where('sgid',$sgid)->update(['sids'=>$sids])){
                show_msg('成功添加学员到分组',url('groupdetail',['sgid'=>$sgid]));
            }else{
                show_msg('添加学员到分组失败');
            }
        }

    }

    public function addgroup(){
        if(input('?sid')){
            $sids['sids'] = input('sid');
            $student = db('student')->where('sid','in',$sids['sids'])->select();
        }
        $this->assign(['student'=>$student,'cid'=>$sids]);
        return view();
    }

    public function chooses(){
        $sgid = input('sgid');
        $cids = db('teacher')->where('mobile',session('mobile'))->find();
        $map['cid'] = ['in',$cids['cid']];
        if($sgid){
            $sids = db('studentgroup')->where('sgid',$sgid)->find();
            $map['sid'] = ['not in',$sids['sids']];
        }
        if(input('?name')){
            $flag = preg_match('/[0-9]/', input('name'));
            if($flag){
                $map['cid'] = ['like','%'.input('name').'%'];
            }else{
                $map['name'] = ['like','%'.input('name').'%'];
            }
        }
        $student = db('student')->where($map)->select();
        $this->assign(['student'=>$student,'sgid'=>$sgid]);
        return view();
    }
    public function del(){
        $sgid = input('sgid');
        if(db('studentgroup')->where('sgid',$sgid)->delete()){
            show_msg('删除分组成功',url('index'));
        }else{
            show_msg('删除分组失败');
        }
    }

}