<?php
namespace app\admin\validate;
use think\Validate;
class Student extends Validate
{
    protected $rule = [
        'sid'  =>  'require',
    ];

    protected $message  =   [
        'sid.unique' => '学号不得重复',
        'sid.require' => '学号不能为空',
    ];

    protected $scene = [
        'add'  =>  ['sid'=>'unique:student'],
    ];




}
