<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 18:36
 */
namespace app\admin\model;
use think\Model;
class Systemnews extends Model
{
    public function getSendtimeAttr($value)
    {
        $status = date('Y-m-d H:i:s',$value);
        return $status;
    }

}
?>