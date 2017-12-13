<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/22
 * Time: 11:53
 */
namespace app\mobil\controller;
use app\mobil\controller\Base;
class News extends Base
{
    public function home()
    {
        $sys = db('systemnews')->where('status','1')->order('sendtime desc')->select();
        if(!$sys) $sys[0]['content'] = '暂时没有新消息';
        $tran = db('systemnews')->where('status',session('mobile'))->order('sendtime desc')->select();
        if(!$tran) $tran[0]['content'] = '暂时没有新消息';
        $this->assign(['sys'=>$sys,'tran'=>$tran]);
        return view();
    }
    public function transnews(){
        $tran = db('systemnews')->where('status',session('mobile'))->order('sendtime desc')->select();
        $result = db('systemnews')->where('status',session('mobile'))->select();
        foreach ($result as $k=>$v){
            if(!strstr($v['isread'],session('mobile'))) db('systemnews')->where('id',$v['id'])->update(['isread'=>$v['isread'].session('mobile')]);
        }
        $this->assign(['tran'=>$tran]);
        return view();
    }
    public function sysnews(){
        $sys = db('systemnews')->where('status','1')->order('sendtime desc')->select();
        $result = db('systemnews')->where('status','1')->select();
        foreach ($result as $k=>$v){
            if(!strstr($v['isread'],session('mobile'))) db('systemnews')->where('id',$v['id'])->update(['isread'=>$v['isread'].session('mobile')]);
        }
        $this->assign(['sys'=>$sys]);
        return view();
    }
}