<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Student;
use wxSdk\Jssdk;
class Handmessage extends Controller
{
    public function index(){
        $sid = input('sid');
        $arr = explode(' ',$sid);
        if(empty($arr[1])) return '请选择老师';
        db('message')->where('sid','in',$arr[0])->delete();
        db('transinfo')->where('sid','in',$arr[0])->delete();
        if(db('student')->where('sid','in',$arr[0])->update(['tid'=>$arr[1]])){
            $result = db('user')->where('mobile',$arr[1])->find();
            if($result){
                $content['name'] = session('name');
                $content['num'] = substr_count($arr[0],',')+1;
                push_weChatmsg($result['openid'],$content,'1');
                $news = [
                    'sendtime' => time(),
                    'content' => '管理员已对您安排学员，请尽快确认',
                    'status' => $arr[1],
                ];
                db('systemnews')->insert($news);
                return '学生负责人已更改，并提醒老师查看';
            }else{
                return '学生负责人已更改，此老师尚未绑定微信号';
            }
        }else{
            return '负责人已经是此老师，无需再更改';
        }

    }
}
