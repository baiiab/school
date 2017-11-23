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
use app\admin\model\Transinfo as modelTrans;
class Transinfo extends Controller
{
    public function handtran(){
        return view();
    }

    public function lst($name = null){
        $map['status'] = '1';
        $map['a.tid'] = session('mobile');
        $transinfo = new modelTrans();
        $students = $transinfo->alias('a')
            ->field('s.name,s.headimg,reason,s.sex,cid,a.gid,backtime')
            ->join('student s','a.sid=s.sid')
            ->where($map)->order('backtime desc')->select();

        foreach ($students as $k=>$student){
            $result = db('teacher')->field('tname')->where('tid',$student['gid'])->find();
            if($result){
                $students[$k]['gname'] = $result['tname'];
            }else{
                $result = db('guardian')->field('gname')->where('gid',$student['gid'])->find();
                $students[$k]['gname'] = $result['gname'];
            }
            unset($students[$k]['gid']);
        }
        if($name){
            return $students;
        }
        $this->assign('list',$students);
        return view();
    }
    //根据姓名查找异常学员
    public function searchStudent(){
        $result = $this->lst(input('name'));
        foreach ($result as $k=>$v){
            if(!strstr($v['name'],input('name'))){
                unset($result[$k]);
            }
        }
        $this->assign('list',$result);
        return $this->fetch('lst');
    }

}