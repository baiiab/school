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
        $students = db('student')->paginate(30);
        $this->assign('students',$students);
        if(input('id')){
            $year = db('class')->distinct(true)->field('year')->order('year')->select();
            $teacher = db('teacher')->select();
            $this->assign('teacher',$teacher);
            $this->assign('year',$year);
            $this->assign(['deyear'=>'','decid'=>'','cid'=>'']);
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
                show_msg('班级重复');
            }
            db('class')->insert($data);
            show_msg('添加班级成功',url('delClass'));
        }
        return view();
    }

    function outExcel(){
        $str = '学号,'.'姓名,'.'班级,'.'性别,'.'目前负责人,'.'默认负责人,'.'入学年份';
        $field = 'sid,'.'name,'.'cid,'.'sex,'.'tid,'.'detid,'.'year';
        outputExcel('student',$str,$field);
    }

    function importExcel()
    {
        header("Content-type: text/html; charset=utf-8");
        $file = request()->file('excel');
        if(!$file){
            show_msg('请选择导入文件',url('lst'));
        }
        $info = $file->validate(['ext' => 'xlsx,xls'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        //上传验证后缀名,以及上传之后移动的地址
        if ($info) {
            $arr = ['sid','name','cid','sex','tid','detid','year'];
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
                if(empty($str)) show_msg('插入成功',url('lst'));
                else show_msg('学号'.$str.'重复,其它插入成功',url('lst'));
            }else{
                show_msg('不能插入空表或全是重复学号');
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
            if($data['detid']=='') show_msg('监护人不能为空');
            if(db('student')->where('sid',$data['sid'])->find()){
                show_msg('添加学员失败,学号不能重复');
            }
            $data['tid'] = $data['detid'];
            if(db('student')->insert($data)){
                return show_msg('添加学员成功',url('lst'));
            }else{
                return show_msg('添加学员失败');
            }
        }

        $year = db('class')->distinct(true)->field('year')->order('year')->select();
        $guardian = db('guardian')->select();
//        dump($class);die;
        $this->assign('year',$year);
        $this->assign('guardian',$guardian);
        return view();
    }

    public function delClass(){
        if(input('class')){
            $class = db('class')->where('year',input('class'))->order('cid')->paginate($listRows=30,$simple=false,                                $config=['query'=>['class'=>input('class')]]);
            $this->assign('students',$class);
            return view();
        }
        if(input('id')){
            if(db('class')->delete(input('id'))) show_msg('删除班级成功',url('delClass'));
        }
        $students = db('class')->order('year desc')->paginate(30);
        $this->assign('students',$students);
        return view();
    }

    public function edit()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if(db('student')->where('sid',$data['sid'])->update($data)){
                show_msg('修改信息成功',url('lst'));
            }else{
                show_msg('修改失败');
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
            show_msg('删除学员成功',url('lst'));
        }else{
            show_msg('删除学员失败!');
        }
    }

//  根据姓名寻找学员
    public function searchStudent(){
        $id = input('id');
        $map['name']=['like','%'.$id.'%'];
        $students = db('student')->where($map)->paginate(30);
//        dump($students);die;
        $this->assign('students',$students);
        return $this->fetch('lst');
    }
    //根据年份或班级查找学员
    public function findStudent(){
        $year = db('class')->distinct(true)->field('year')->order('year')->select();
        if(input('?class')){
            $ids = explode(',',input('class'));
            if($ids[1]=='所有班级') $this->redirect('findStudent',['year'=>$ids[0]]);
            $id = $ids[1];
            $students = db('student')->where('cid',$id)->paginate($listRows=30,$simple=false,                                $config=['query'=>['class'=>$id]]);
            $teacher = db('teacher')->select();
            $this->assign('teacher',$teacher);
            $cids = db('class')->field('cid')->where('year',$ids[0])->order('cid')->select();
//          dump($class);die;
            $this->assign('year',$year);
            $this->assign('cid',$cids);
            $this->assign('deyear',$ids[0]);
            $this->assign('decid',$ids[1]);
//        dump($students);die;
            $this->assign('students',$students);
        }
        if(input('?year')){
            if(input('year')=='所有年级') $this->redirect('lst',['id'=>1]);
            $students = db('student')->where('year',input('year'))->paginate($listRows=30,$simple=false,                                $config=['query'=>['year'=>input('year')]]);
            $cids = db('class')->field('cid')->where('year',input('year'))->order('cid')->select();
            $teacher = db('teacher')->select();
//            dump(json_decode($cids));die;
            $this->assign(['year'=>$year,'students'=>$students,'decid'=>'','cid'=>$cids,'teacher'=>$teacher,'deyear'=>input('year')]);
        }

        return $this->fetch('change');
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
}