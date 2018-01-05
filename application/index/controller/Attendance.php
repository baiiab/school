<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 15:19
 */
namespace app\index\controller;
use app\index\controller\Base;
use app\admin\model\Evection;
use app\admin\model\Holiday;

class Attendance extends Base
{
    public function index()
    {
        $date = date('Y-m-d', time());
        $starttime = strtotime($date . ' 00:00:00');
        $endtime = strtotime($date . ' 23:59:59');
        if (db('signed')->where('tid', session('mobile'))->where('signtime', ['>', $starttime], ['<', $endtime], 'and')->find()) {
            $str = '今天已经签到';
        } else {
            $str = '今天未签到';
        }
        $date = getWxConfig();
        $date = implode(',', $date);
//        dump($data);die;
        $this->assign(['data' => $date, 'str' => $str]);
        return view();
    }
    public function sign(){
        $data = input('get.');
        $data['tid'] = session('mobile');
        $data['signtime'] = time();
        if(db('signed')->insert($data)){
            show_msg('签到成功',url('index'));
        }else{
            show_msg('签到不成功');
        }
    }

    public function evection(){
        $data = input('post.');
        $data['tid'] = session('mobile');
        $data['tutor'] = $data['tutor1'];
        $data['asktime'] = time();
        $data['holidaytime'] = strtotime($data['estime']).'-'.strtotime($data['eetime']);
        $evection = new Evection();
        if($evection->allowField(true)->save($data)){
            show_msg('出差申请已提交',url('index'));
        }else{
            show_msg('提交失败');
        }
    }

    public function holiday(){
        $data = input('post.');
        $data['tid'] = session('mobile');
        $data['asktime'] = time();
        $data['holidaytime'] = strtotime($data['stime']).'-'.strtotime($data['etime']);
        $holiday = new Holiday();
        if($holiday->allowField(true)->save($data)){
            show_msg('请假申请已提交',url('index'));
        }else{
            show_msg('提交失败');
        }
    }

    //签到情况表
    public function signed()
    {
        $signs = new Signed();
        $students = $signs
        ->alias('a')
        ->field('a.tid,t.tname,signtime,position')
        ->join('teacher t','a.tid = t.tid')
        ->order('signtime desc')->paginate(30);
//        dump($students);die;
        $this->assign('students', $students);
        return $this->fetch('lst');
    }
}