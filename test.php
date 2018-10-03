<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $spreadsheet = new Spreadsheet();
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('demo.xlsx');

$names_data = file_get_contents('names.json');
$names_json = json_decode($names_data,true);

$comp_names_data = file_get_contents('compare.json');
$comp_names_json =json_decode($comp_names_data,true);

$result_comp_json = array_diff($names_json,$comp_names_json);

if(empty($comp_names_json)){
        foreach ($names_json as $k1 => $namevalue) {
                # code...
                $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $namevalue);
                $spreadsheet->addSheet($myWorkSheet);
        }
$comp_names_json=$names_json;
$final_data_json=json_encode($comp_names_json,true);
file_put_contents('compare.json',$final_data_json);
        // foreach ($result_comp_json as $k2 => $namevalue1) {
        //         # code...
        //         $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $namevalue1);
        //         $spreadsheet->addSheet($myWorkSheet);
        // }
}
else{
        if(!empty($result_comp_json))
        foreach ($result_comp_json as $k2 => $namevalue1) {
                # code...
                $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $namevalue1);
                $spreadsheet->addSheet($myWorkSheet);
        }
        $comp_names_json=$names_json;
$final_data_json=json_encode($comp_names_json,true);
file_put_contents('compare.json',$final_data_json);
}

foreach ($names_json as $key => $value) {
        # code...

//         $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $value);
//        $spreadsheet->addSheet($myWorkSheet);
       $spreadsheet->setActiveSheetIndexByName($value);
       $activeSheet = $spreadsheet->getActiveSheet();

       if(file_exists('realexceldata.json')){
               $excel_json_file=file_get_contents('realexceldata.json');
               $excel_json_data=json_decode($excel_json_file,true);
               
               $retriew_excel_amount = array();
               $retriew_excel_date = array();

               foreach ($excel_json_data as $key => $excel_data_values) {
                       # code...
                       $retriew_excel_date[]=$excel_data_values[$value][0];
                       $retriew_excel_amount[]=$excel_data_values[$value][1];
               }
       }
       
       $styleArray =[
               'font'=>[
                       'size'=>15,
                       'bold'=>true
               ]
       ];

       $activeSheet->setCellValue('H8', 'Date');
       $activeSheet->setCellValue('J8','Amount');
       $activeSheet->getStyle('H8:J8')->applyFromArray($styleArray);

       $columnArray = array_chunk($retriew_excel_date,1);

       $activeSheet
                  ->fromArray(
                          $columnArray,
                          NULL,
                          'H9'
                  );
        
        $columnArray1 = array_chunk($retriew_excel_amount,1);

        $activeSheet->fromArray(
                $columnArray1,
                NULL,
                'J9'
        );

        $activeSheet->getColumnDimension('H')->setAutoSize(true);
        $activeSheet->getColumnDimension('J')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $writer->save('demo.xlsx');
}
?>