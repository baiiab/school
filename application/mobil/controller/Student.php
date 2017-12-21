<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/8
 * Time: 15:46
 */
namespace app\mobil\controller;
use app\mobil\controller\Base;
class Student extends Base
{
    public function lst(){
        $students = db('student')->where('detid',session('mobile'))->select();
        $this->assign('student',$students);
        return view();
    }

    public function detail(){
        $sid = input('id');
        if(input('?headimg')){
            if (strstr(input('headimg'),",")){
                $image = explode(',',input('headimg'));
                $image = $image[1];
            }
            $path = '/uploads/'.date("Ymd",time()).'/';
            $imageName = date("His",time())."_".rand(1111,9999).'.png';
//            dump($image);die;
            $img = base64_decode($image);
            $path1 = ROOT_PATH . 'public' . DS . 'static/mobil'.$path;
            if (!is_dir($path1)){ //判断目录是否存在 不存在就创建
                mkdir($path1,0777,true);
            }
            file_put_contents($path1.$imageName, $img);//返回的是字节数
//            $info = $file->move(ROOT_PATH . 'public' . DS . 'static/mobil/uploads');
//            $data['headimg'] = '/uploads/'.$info->getSaveName();
////            dump($pic);die;
//            if($pic['headimg']){
//                $pic['headimg'] = str_replace('\\','/',$pic['headimg']);
            $pic = db('student')->where('sid',$sid)->find();
            @unlink(ROOT_PATH . 'public' . DS .'static/mobil'.$pic['headimg']);
//            }
            $data['headimg'] = $path.$imageName;
            db('student')->where('sid',$sid)->update($data);
        }
        $student = db('student')->where('sid',$sid)->find();
        $this->assign('student',$student);
        return view();
    }

    public function addStudent()
    {
        if(request()->isPost()){
            $data = input('post.');
            if(db('student')->where('sid',$data['sid'])->find()) show_msg('学号不能与已有的重复');
            if(!$data['name']) show_msg('姓名不能为空');
            $data['tid'] = session('mobile');
            if (strstr(input('headimg'),",")){
                $image = explode(',',input('headimg'));
                $image = $image[1];
            }
            $path = '/uploads/'.date("Ymd",time()).'/';
            $imageName = date("His",time())."_".rand(1111,9999).'.png';
//            dump($image);die;
            $img = base64_decode($image);
            $path1 = ROOT_PATH . 'public' . DS . 'static/mobil'.$path;
            if (!is_dir($path1)){ //判断目录是否存在 不存在就创建
                mkdir($path1,0777,true);
            }
            file_put_contents($path1.$imageName, $img);
            $data['headimg'] = $path.$imageName;

            $data['year'] = '20'.substr($data['cid'],0,2);
            $data['detid'] = session('mobile');
            if(db('student')->insert($data)){
                return show_msg('添加学员成功',url('lst'));
            }else{
                return show_msg('添加学员失败');
            }
            return;
        }
        $class = db('class')->field('cid')->order('cid desc')->select();
        $this->assign('list',$class);
        return view();
    }

    public function headim(){
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

}