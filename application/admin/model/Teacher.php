<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/10
 * Time: 14:35
 */
namespace app\admin\model;
use think\Model;
class Teacher extends Model
{
    public function login($data){
        $user = db('teacher')->where('mobile',$data['mobile'])->find();
        if($user){
            if($user['password'] == md5($data['password'])){
                session('name',$user['tname']);
                session('password',$user['password']);
                session('mobile',$user['mobile']);
                return 3;
            }else{
                return 2;
            }
        }else{
            return 1;
        }
    }
}
?>