<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/14
 * Time: 15:21
 */
namespace app\admin\model;
use think\Model;
class Signed extends Model
{
    public function getSigntimeAttr($value)
    {
        $status = date('Y-m-d H:i:s',$value);
        return $status;
    }

}
?>
