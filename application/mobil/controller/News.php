<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/22
 * Time: 11:53
 */
namespace app\mobil\controller;
use app\admin\controller\Base;
class News extends Base
{
    public function home()
    {
        $sys = db('systemnews')->where('status','1')->order('sendtime desc')->select();
        $tran = db('systemnews')->where('status',session('mobile'))->order('sendtime desc')->select();
        $this->assign(['sys'=>$sys,'tran'=>$tran]);
        return view();
    }
    public function transnews(){
        $tran = db('systemnews')->where('status',session('mobile'))->order('sendtime desc')->select();
        $this->assign(['tran'=>$tran]);
        return view();
    }
    public function sysnews(){
        $sys = db('systemnews')->where('status','1')->order('sendtime desc')->select();
        $this->assign(['sys'=>$sys]);
        return view();
    }
}