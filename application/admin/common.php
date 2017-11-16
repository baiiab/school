<?php
use think\Loader;
use think\Db;

//公众号获取openId
function get_openId(){
//    $appId = 'wx39daf877da7f62e9';
    $appId = config('PUBLIC_APPID');
    $uri = urlencode(WB_CALLBACK_URL);
    $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$uri&response_type=code&scope=snsapi_userinfo&state=$appId#wechat_redirect";
    return $url;
}

function insertExcel($table,$info,$arr)
{
    Loader::import('PHPExcel.Classes.PHPExcel');
    Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    Loader::import('PHPExcel.Classes.PHPExcel.Reader.Excel5');
    //上传验证后缀名,以及上传之后移动的地址
//            echo $info->getFilename();
    $exclePath = $info->getSaveName();  //获取文件名
    $file_name = ROOT_PATH . 'public' . DS . 'uploads' . DS . $exclePath;   //上传文件的地址
    $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
    $obj_PHPExcel = $objReader->load($file_name, $encode = 'utf-8');  //加载文件内容,编码utf-8
    echo "<pre>";
    $excel_array = $obj_PHPExcel->getsheet(0)->toArray();   //转换为数组格式
    array_shift($excel_array);  //删除第一个数组(标题);
    $city = [];
    $sql = "select COLUMN_NAME from information_schema.COLUMNS where table_name = '".$table."' and table_schema = 'school'";
    $result = Db::query($sql);
    foreach ($excel_array as $k => $v) {
        $i = 0;
        foreach ($result as $value){
            if(in_array($value['COLUMN_NAME'],$arr)) $city[$k][$value['COLUMN_NAME']] = $v[$i++];
        }
    }
    return $city;
}
function outputExcel($table,$str,$field)
{
    $path = dirname(__FILE__); //找到当前脚本所在路径
    Loader::import('PHPExcel.Classes.PHPExcel');
    Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    $PHPExcel = new \PHPExcel();

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
    $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007");
    header('Content-Disposition: attachment;filename="表单数据.xlsx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
}
