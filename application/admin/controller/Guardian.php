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
//        dump($students);die;
        foreach ($students as $key =>$student){
            $student['num'] = db('student')->where('detid',$student['mobile'])->count();
//            dump($student);die;
            db('guardian')->where('mobile',$student['mobile'])->update(['num'=>$student['num']]);
        }
        $list = $guardians->paginate(30);
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
        if(!$file){
            show_msg('请选择导入文件',url('lst'));
        }
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
                if(empty($str)) show_msg('插入成功','lst');
                else show_msg('教师编号'.$str.'重复,其它插入成功','lst');
            }else{
                show_msg('不能插入空表或全是重复编号');
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
            $data['password'] = md5('123456');
            if (!preg_match("/^1[34578]{1}\d{9}$/", $data['mobile'])) show_msg('请填入正确手机号码');
            if(db('guardian')->where('gid',$data['gid'])->whereOr('mobile',$data['mobile'])->find()){
                show_msg('添加监护人失败,监护人编号或手机号不能重复');
            }
            if(db('guardian')->insert($data)){
                return show_msg('添加监护人成功','lst');
            }else{
                return show_msg('添加监护人失败');
            }
        }

        return view();
    }

    public function edit()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);die;
            if($data['password']!='') $data['password'] = md5($data['password']);
            else unset($data['password']);
            if(db('guardian')->where('gid',$data['gid'])->update($data)){
                show_msg('修改信息成功',url('lst'));
            }else{
                show_msg('修改失败');
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
            show_msg('删除监护人成功',url('lst'));
        }else{
            show_msg('删除监护人失败!');
        }
    }
//  根据姓名寻找监护人
    public function searchGuardian(){
        $id = input('id');
        $map['gname']=['like','%'.$id.'%'];
        $students = db('guardian')->where($map)->paginate($listRows=30,$simple=false,                                $config=['query'=>['id'=>$id]]);
//        dump($students);die;
        $this->assign('list',$students);
        return $this->fetch('lst');
    }
}