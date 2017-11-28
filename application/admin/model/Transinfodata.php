<?php
namespace app\admin\model;
use think\Model;
class Transinfodata extends Model
{
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
