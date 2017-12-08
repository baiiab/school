<?php
namespace app\admin\model;
use think\Model;
class Transinfodata extends Model
{
    public function getStatusAttr($value)
    {
        $status = [0=>'课程异常',1=>'驳回',2=>''];
        return $status[$value];
    }
    public function getSendtimeAttr($value)
    {
        $status = date('Y-m-d H:i:s',$value);
        return $status;
    }
    public function getBacktimeAttr($value)
    {
        $status = date('Y-m-d H:i:s',$value);
        return $status;
    }

}
?>
