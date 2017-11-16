<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 10:31
 */
namespace app\admin\controller;
use app\admin\controller\Base;
class Manager extends Base
{
    public function lst()
    {
        $students = db('admin')->paginate(3);
        $this->assign('list', $students);
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
//            echo $info->getFilename();
            $arr = ['gid','gname','gender','mobile'];
            $data = insertExcel('guardian',$info,$arr);
//            dump($data);die;
            $str = '';
            foreach ($data as $k => $vo){
                if (db('admin')->where('gid',$vo['gid'])->find()) {
//                    dump($vo['sid']);die;
                    $str .= $vo['gid'].',';
                    unset($data[$k]);
                }
            }
            if(db('admin')->insertAll($data)){
                if(empty($str)) $this->success('插入成功','lst');
                else $this->success('教师编号'.$str.'重复,其它插入成功','lst');
            }else{
                $this->error('不能插入空表或全是重复编号');
            }
        } else {
            echo $file->getError();
        }
    }

    public function addAdmin()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if(db('admin')->where('aid',$data['aid'])->find()){
                $this->error('添加管理员失败,编号不能重复');
            }
            if(db('admin')->insert($data)){
                return $this->success('添加管理员成功','lst');
            }else{
                return $this->error('添加管理员失败');
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
            if(db('admin')->where('aid',$data['aid'])->update($data)){
                $this->success('修改信息成功','lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $id = input('aid');
        $admin = db('admin')->find($id);

//        dump($admin['year']);die;
        $this->assign('admin',$admin);
        return view();
    }
    //  根据编号删除管理员
    public function del(){
        $id = input('aid');
//        dump($id);die;
        if(db('admin')->where('aid',$id)->delete()){
            $this->success('删除管理员成功','lst');
        }else{
            $this->error('删除管理员失败!');
        }
    }
//  根据姓名寻找管理员
    public function searchAdmin(){
        $id = input('id');
        $map['name']=['like','%'.$id.'%'];
        $students = db('admin')->where($map)->paginate($listRows=3,$simple=false,                                $config=['query'=>['id'=>$id]]);
//        dump($students);die;
        $this->assign('list',$students);
        return $this->fetch('lst');
    }
}