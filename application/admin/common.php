<?php

function inserExcel()
{
    Loader::import('PHPExcel.Classes.PHPExcel');
    Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    Loader::import('PHPExcel.Classes.PHPExcel.Reader.Excel5');
    //获取表单上传文件
    $file = request()->file('excel');
    $info = $file->validate(['ext' => 'xlsx'])->move(ROOT_PATH . 'public' . DS . 'uploads');
    //上传验证后缀名,以及上传之后移动的地址
    if ($info) {
//            echo $info->getFilename();
        $exclePath = $info->getSaveName();  //获取文件名
        $file_name = ROOT_PATH . 'public' . DS . 'uploads' . DS . $exclePath;   //上传文件的地址
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $obj_PHPExcel = $objReader->load($file_name, $encode = 'utf-8');  //加载文件内容,编码utf-8
        echo "<pre>";
        $excel_array = $obj_PHPExcel->getsheet(0)->toArray();   //转换为数组格式
        array_shift($excel_array);  //删除第一个数组(标题);
        $city = [];
        foreach ($excel_array as $k => $v) {
            $city[$k]['sid'] = $v[0];
            $city[$k]['name'] = $v[1];
            $city[$k]['cid'] = $v[2];
            $city[$k]['sex'] = $v[3];
            $city[$k]['tid'] = $v[4];
            $city[$k]['year'] = $v[4];
        }
        if(db('student')->insertAll($city)){
            $this->success('添加学员信息成功','lst');
        }
    } else {
        echo $file->getError();
    }
}
function outexcel()
{
    $path = dirname(__FILE__); //找到当前脚本所在路径
    Loader::import('PHPExcel.Classes.PHPExcel');
    Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    $PHPExcel = new \PHPExcel();

    $PHPSheet = $PHPExcel->getActiveSheet();
    $db_admin = db('student')->select();
    $PHPSheet->setTitle("demo"); //给当前活动sheet设置名称
    $PHPSheet->setCellValue('A1', '学号')->setCellValue('B1', 'name')->setCellValue('C1', 'cid')->setCellValue('D1', 'sex')->setCellValue('E1', 'tid')->setCellValue('F1', 'year');
    $j = 2;
    foreach ($db_admin as $key => $value) {
        $PHPSheet->setCellValue('A' . $j, $value['sid'])->setCellValue('B' . $j, $value['name'])->setCellValue('C' . $j, $value['cid'])->setCellValue('D' . $j, $value['sex'])->setCellValue('E' . $j, $value['tid'])->setCellValue('F' . $j, $value['year']);
        $j++;
    }
    $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007");
    header('Content-Disposition: attachment;filename="表单数据.xlsx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
}
