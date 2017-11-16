<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\admin\controller;
use app\admin\controller\Base;
class Guardian extends Base
{
    public function lst()
    {
        $guardians = new \app\admin\model\Guardian();
        $students = db('guardian')->select();
        foreach ($students as $key =>$student){
            $student['num'] = db('student')->where('tid',$student['gid'])->count();
            $guardians->save($student, ['gid' => $student['gid']]);
//            dump($student);die;
        }
        $list = $guardians->paginate(3);
        $this->assign('list', $list);
        return $this->fetch('lst');
    }

    function outExcel(){
        $str = '监护人编号,'.'姓名,'.'性别,'.'手机号';
        $field = 'gid,'.'gname,'.'gender,'.'mobile';
        outputExcel('guardian',$str,$field);
    }

    function importExcel()
    {
        header("Content-type: text/html; charset=utf-8");
        $file = request()->file('excel');
        $info = $file->validate(['ext' => 'xlsx'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        //上传验证后缀名,以及上传之后移动的地址
        if ($info) {
            $arr = ['gid','gname','gender','mobile'];
            $data = insertExcel('guardian',$info,$arr);
//            dump($data);die;
            $str = '';
            foreach ($data as $k => $vo){
                if (db('guardian')->where('gid',$vo['gid'])->find()) {
//                    dump($vo['sid']);die;
                    $str .= $vo['gid'].',';
                    unset($data[$k]);
                }
            }
            if(db('guardian')->insertAll($data)){
                if(empty($str)) $this->success('插入成功','lst');
                else $this->success('教师编号'.$str.'重复,其它插入成功','lst');
            }else{
                $this->error('不能插入空表或全是重复编号');
            }
        } else {
            echo $file->getError();
        }
    }

    public function addGuardian()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if(db('guardian')->where('gid',$data['gid'])->find()){
                $this->error('添加监护人失败,监护人编号不能重复');
            }
            if(db('guardian')->insert($data)){
                return $this->success('添加监护人成功','lst');
            }else{
                return $this->error('添加监护人失败');
            }
        }

        return view();
    }

    public function edit()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if(empty($data['password'])) $data['password'] = '123654';
            if(db('guardian')->where('gid',$data['gid'])->update($data)){
                $this->success('修改信息成功','lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $id = input('gid');
        $admin = db('guardian')->find($id);

//        dump($admin['year']);die;
        $this->assign('admin',$admin);
        return view();
    }
    //  根据编号删除监护人
    public function del(){
        $id = input('gid');
//        dump($id);die;
        if(db('guardian')->where('gid',$id)->delete()){
            $this->success('删除监护人成功','lst');
        }else{
            $this->error('删除监护人失败!');
        }
    }
//  根据姓名寻找监护人
    public function searchGuardian(){
        $id = input('id');
        $map['gname']=['like','%'.$id.'%'];
        $students = db('guardian')->where($map)->paginate($listRows=3,$simple=false,                                $config=['query'=>['id'=>$id]]);
//        dump($students);die;
        $this->assign('list',$students);
        return $this->fetch('lst');
    }
}