<?php
/**
 * Created by PhpStorm.
 * User: Bill
 * Date: 2017/11/23
 * Time: 16:07
 */
namespace app\callback\controller;
use think\Controller;
use think\Loader;
class Outexcel extends Controller
{
    public function out(){
        $path = dirname(__FILE__); //找到当前脚本所在路径
        Loader::import('PHPExcel.Classes.PHPExcel');
        Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
        $PHPExcel = new \PHPExcel();
        $table = input('a');
        $str = input('b');
        $field = input('c');
        $PHPSheet = $PHPExcel->getActiveSheet();
        $db_admin = db($table)->select();
        $PHPSheet->setTitle("demo"); //给当前活动sheet设置名称
        $arr = explode(',',$str);
        $assc = 65;
        foreach($arr as $vo){
            $PHPSheet->setCellValue(chr($assc++).'1', $vo);
        }
        $j = 2;
        $array = explode(',',$field);
        foreach ($db_admin as $key => $value) {
            $assc = 65;
            foreach($array as $vo) {
                foreach ($value as $k => $v) {
                    if($k==$vo) $PHPSheet->setCellValue(chr($assc++) . $j, $v);
                }
            }
            $j++;
        }
        switch ($table) {
            case 'student':
                $filename = '学生列表';
                break;
            case 'teacher':
                $filename = '教师列表';
                break;
            default:
                $filename = '监护人列表';
        }
        $filename .= date('Ymd').'.xlsx';
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007");
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
    }
}