<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\admin\controller;
use app\admin\controller\Base;
class Teacher extends Base
{
    public function lst()
    {
        $students = db('teacher')->paginate(3);
        $this->assign('students', $students);
        return $this->fetch('lst');
    }

    function outExcel(){
        $str = '教师编号,'.'姓名,'.'性别,'.'手机号,'.'科目,'.'任课班级';
        $field = 'tid,'.'tname,'.'gender,'.'mobile,'.'course,'.'cid';
        outputExcel('teacher',$str,$field);
    }

    function importExcel()
    {
        header("Content-type: text/html; charset=utf-8");
        $file = request()->file('excel');
        $info = $file->validate(['ext' => 'xlsx'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        //上传验证后缀名,以及上传之后移动的地址
        if ($info) {
//            echo $info->getFilename();
            $arr = ['tid','tname','gender','mobile','course','cid'];
            $data = insertExcel('teacher',$info,$arr);
//            dump($data);die;
            $str = '';
            foreach ($data as $k => $vo){
                if (db('teacher')->where('tid',$vo['tid'])->find()) {
//                    dump($vo['sid']);die;
                    $str = $vo['tid'].',';
                    unset($data[$k]);
                }
            }
            if(db('teacher')->insertAll($data)){
                if(empty($str)) $this->success('插入成功','lst');
                else $this->success('教师编号'.$str.'重复,其它插入成功','lst');
            }else{
                $this->error('不能插入空表或全是重复学号');
            }
        } else {
            echo $file->getError();
        }
    }

    public function addTeacher()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if(db('teacher')->where('tid',$data['tid'])->find()){
                $this->error('添加教师失败,教师编号不能重复');
            }
            if(db('teacher')->insert($data)){
                return $this->success('添加教师成功','lst');
            }else{
                return $this->error('添加教师失败');
            }
        }

        $year = db('class')->distinct(true)->field('year')->order('year')->select();
//        dump($class);die;
        $this->assign('year',$year);
        return view();
    }
//  查找某年的所有班级
    public function searchClass($year = null){
        if(request()->isPost()){
            $year = input('year');
            $class = db('class')->field('cid')->where('year',$year)->order('cid')->select();
            return json_encode($class);
        }
        $class = db('class')->field('cid')->where('year',$year)->order('cid')->select();
        return $class;
    }

    public function edit()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if(empty($data['password'])) $data['password'] = '123654';
            if(db('teacher')->where('tid',$data['tid'])->update($data)){
                $this->success('修改信息成功','lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $id = input('tid');
        $admin = db('teacher')->find($id);

//        dump($admin['year']);die;
        $year = db('class')->distinct(true)->field('year')->order('year')->select();
        $this->assign('year',$year);
        $this->assign('cid',$this->searchClass($admin['year']));
        $this->assign('admin',$admin);
        return view();
    }
    //  根据编号删除教师
    public function del(){
        $id = input('tid');
//        dump($id);die;
        if(db('teacher')->where('tid',$id)->delete()){
            $this->success('删除教师成功','lst');
        }else{
            $this->error('删除教师失败!');
        }
    }
//  根据姓名寻找教师
    public function searchTeacher(){
        $id = input('id');
        $map['tname']=['like','%'.$id.'%'];
        $students = db('teacher')->where($map)->paginate(8);
//        dump($students);die;
        $this->assign('students',$students);
        return $this->fetch('lst');
    }
}