<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 18:36
 */
namespace app\admin\model;
use think\Model;
class Holiday extends Model
{
    public function getAsktimeAttr($value)
    {
        $status = date('Y-m-d H:i:s',$value);
        return $status;
    }

    public function getHolidaytimeAttr($value)
    {
        $arr = explode('-',$value);
        $str = date('Y-m-d H:i:s',$arr[0]).'~'.date('Y-m-d H:i:s',$arr[1]);
        return $str;
    }

}
?>