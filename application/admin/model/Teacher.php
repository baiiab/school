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
                session('tokensession',$this->get_token());
//                $result = db('user')->where('mobile',session('mobile'))->find();
//                if($result){
//                        db('user')->where('mobile',session('mobile'))->update(['openid'=>session('openid'),'tokensession'=>session('tokensession')]);
//                }else{
//                    db('user')->insert(['openid'=>session('openid'),'tokensession'=>session('tokensession'),'mobile'=>session('mobile')]);
//                }
                return 3;
            }else{
                return 2;
            }
        }else{
            return 1;
        }
    }
    public function get_token() {
        $token = '';
        while (strlen($token) < 32) {
            $token .= mt_rand(0, mt_getrandmax());
        }
        $token = md5(uniqid($token, TRUE));
        return $token;
    }
}
?>