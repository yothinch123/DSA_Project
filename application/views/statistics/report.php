<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

$sheet = $spreadsheet->getActiveSheet();

// manually set table data value
$sheet->setCellValue('A1', 'โยธิน ช่องผักแว่น');
$sheet->setCellValue('A2', 'Gipsy Avenger');
$sheet->setCellValue('A3', 'Striker Eureka');

$writer = new Xlsx($spreadsheet); // instantiate Xlsx

$filename = 'list-of-jaegers'; // set filename for excel file to be exported

header('Content-Type: application/vnd.ms-excel'); // generate excel file
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');  // download file 
