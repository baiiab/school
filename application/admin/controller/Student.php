<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Loader;

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

    function inserExcel()
    {
        Loader::import('PHPExcel.Classes.PHPExcel');
        Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
        Loader::import('PHPExcel.Classes.PHPExcel.Reader.Excel5');
        //获取表单上传文件
        $file = request()->file('excel');
        $info = $file->validate(['ext' => 'xlsx'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        //上传验证后缀名,以及上传之后移动的地址
        if ($info) {
//            echo $info->getFilename();
            $exclePath = $info->getSaveName();  //获取文件名
            $file_name = ROOT_PATH . 'public' . DS . 'uploads' . DS . $exclePath;   //上传文件的地址
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $obj_PHPExcel = $objReader->load($file_name, $encode = 'utf-8');  //加载文件内容,编码utf-8
            echo "<pre>";
            $excel_array = $obj_PHPExcel->getsheet(0)->toArray();   //转换为数组格式
            array_shift($excel_array);  //删除第一个数组(标题);
            $city = [];
            foreach ($excel_array as $k => $v) {
                $city[$k]['sid'] = $v[0];
                $city[$k]['name'] = $v[1];
                $city[$k]['cid'] = $v[2];
                $city[$k]['sex'] = $v[3];
                $city[$k]['tid'] = $v[4];
                $city[$k]['year'] = $v[5];
            }
            if(db('student')->insertAll($city)){
                $this->success('添加学员信息成功','lst');
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
    public function searchClass(){
        $year = input('year');
        $class = db('class')->field('cid')->where('year',$year)->order('cid')->select();
        return json_encode($class);
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
    public function logout(){
        session(null);
        $this->success('退出成功','Login/index');
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