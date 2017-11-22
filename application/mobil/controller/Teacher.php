<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\mobil\controller;
use app\admin\controller\Base;
class Teacher extends Base
{
    public function lst()
    {
        $students = db('teacher')->select();
        $this->assign('teachers', $students);
        return view();
    }
    public function detail()
    {
        $students = db('teacher')->where('tid',input('id'))->find();
//        $class = db('class')->where('')
        $arr = explode(',',$students['cid']);
        $this->assign(['teacher'=>$students,'cids'=>$arr]);
        return view();
    }

}