<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Student;
use wxSdk\Jssdk;
class Handmessage extends Controller
{
    public function index(){
        $sid = input('sid');
        $arr = explode(' ',$sid);
        $list = Student::all($arr[0]);
        if(empty($arr[1])) return 0;
        foreach ($list as $vo){
            $data=[
                'sid' => $vo->sid,
                'tid' => $vo->tid,
                'gid' => $arr[1],
                'sendtime' => time()
            ];
            db('message')->insert($data);
        }
        return 1;
//        dump($list);die;

    }
}
