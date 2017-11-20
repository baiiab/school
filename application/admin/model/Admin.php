<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model
{
	public function login($data){
	    $user = Db::name('admin')->where('name','=',$data['username'])->find();
	    if($user){
	        if($user['password'] == md5($data['password'])){
	        	session('name',$user['name']);
	        	session('password',$user['password']);
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
