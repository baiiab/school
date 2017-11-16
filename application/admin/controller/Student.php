<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\admin\controller;
use app\admin\controller\Base;
class Student extends Base
{
    public function lst(){
        $students = db('student')->paginate(3);
        $this->assign('students',$students);
        if(input('id')){
            $year = db('class')->distinct(true)->field('year')->order('year')->select();
//          dump($class);die;
            $this->assign('year',$year);
            return $this->fetch('change');
        }
        return $this->fetch('lst');
    }

    public function addClass()
    {
        if(request()->isPost()){
            $data = input('post.');
            $result = db('class')->where(['year'=>$data['year'],'cid'=>$data['cid']])->find();
            if($result){
                $this->error('班级重复');
            }
            db('class')->insert($data);
            $this->success('添加班级成功','lst');
        }
        return view();
    }

    function outExcel(){
        $str = '学号,'.'姓名,'.'班级,'.'性别,'.'负责人,'.'入学年份';
        $field = 'sid,'.'name,'.'cid,'.'sex,'.'tid,'.'year';
        outputExcel('student',$str,$field);
    }

    function importExcel()
    {
        header("Content-type: text/html; charset=utf-8");
        $file = request()->file('excel');
        $info = $file->validate(['ext' => 'xlsx'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        //上传验证后缀名,以及上传之后移动的地址
        if ($info) {
            $arr = ['sid','name','cid','sex','tid','year'];
            $data = insertExcel('student',$info,$arr);
//            dump($data);die;
            $str = '';
            foreach ($data as $k => $vo){
                if (db('student')->where('sid',$vo['sid'])->find()) {
//                    dump($vo['sid']);die;
                    $str .= $vo['sid'].',';
                    unset($data[$k]);
                }
            }
//            unlink('D:\kinggsoft\phpstudy\WWW\school'.'/public/uploads/'.$info->getSaveName());
            if(db('student')->insertAll($data)){
                $this->success('学号'.$str.'重复,其它插入成功','lst');
            }else{
                $this->error('不能插入空表或全是重复学号');
            }
        } else {
            echo $file->getError();
        }
    }

    public function addStudent()
    {
        if(request()->isPost()){
            $data = input('post.');
//            die($data['sid']);die;
            if(db('student')->where('sid',$data['sid'])->find()){
                $this->error('添加学员失败,学号不能重复');
            }
            if(db('student')->insert($data)){
                return $this->success('添加学员成功','lst');
            }else{
                return $this->error('添加学员失败');
            }
        }

        $year = db('class')->distinct(true)->field('year')->order('year')->select();
//        dump($class);die;
        $this->assign('year',$year);
        return view();
    }
//  查找某年的所有班级
    public function searchClass($year = null){
        if(request()->isPost()||request()->isGet()){
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
            if(db('student')->where('sid',$data['sid'])->update($data)){
                $this->success('修改信息成功','lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $id = input('sid');
        $admin = db('student')->find($id);
        $year = db('class')->distinct(true)->field('year')->order('year')->select();
        $this->assign('year',$year);
        $this->assign('cid',$this->searchClass($admin['year']));
        $this->assign('admin',$admin);
        return view();
    }
    //  根据学号删除学员
    public function del(){
        $id = input('sid');
//        dump($id);die;
        if(db('student')->where('sid',$id)->delete()){
            $this->success('删除学员成功','lst');
        }else{
            $this->error('删除学员失败!');
        }
    }

//  根据姓名寻找学员
    public function searchStudent(){
        $id = input('id');
        $map['name']=['like','%'.$id.'%'];
        $students = db('student')->where($map)->paginate(8);
//        dump($students);die;
        $this->assign('students',$students);
        return $this->fetch('lst');
    }
    //根据班级查找学员
    public function findStudent(){
        $id = input('class');
        $map['cid']=['like','%'.$id.'%'];
        $students = db('student')->where($map)->paginate($listRows=3,$simple=false,                                $config=['query'=>['class'=>$id]]);
        $year = db('class')->distinct(true)->field('year')->order('year')->select();
//          dump($class);die;
        $this->assign('year',$year);
//        dump($students);die;
        $this->assign('students',$students);
        return $this->fetch('change');
    }

}