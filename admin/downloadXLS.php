<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This Code should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
include_once("../utility/config.php");
include_once("../utility/dbclass.php");
include_once("../utility/functions.php");
include_once("../utility/fpdf/fpdf.php");

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$action = "";
$objDB = new DB();

//$month = $_REQUEST['month'];
$year = $_REQUEST['year'];
$fileName = "uprov_compost_".$year.".xls";

// Set document properties
$objPHPExcel->getProperties()->setCreator("UPT COMPOST")
							 ->setLastModifiedBy("UPT COMPOST")
							 ->setTitle("uprov_compost_".$year)
							 ->setSubject("uprov_compost_".$year)
							 ->setDescription("UPT COMPOST order report ")
							 ->setKeywords("")
							 ->setCategory("");
							 
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	
$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

$objPHPExcel->getDefaultStyle()->applyFromArray($style);

$orderData = array();
for($i=1; $i<=12; $i++){
	$tempArr[] = array();
	$orderSql = "SELECT month, SUM(yardwastein) as YARDSIN, SUM(compostout) as YARDSOUT FROM order_details WHERE month = '".$i."' AND year = '".$year."'";
	$objDB->setQuery($orderSql);
	$result = $objDB->select();
	
	$tempArr['month'] = $result[0]['month'];
	$tempArr['YARDSIN'] = $result[0]['YARDSIN'];
	$tempArr['YARDSOUT'] = $result[0]['YARDSOUT'];
	
	$orderSql1 = "SELECT COUNT(yardwastein) as DOWASTEIN FROM order_details WHERE month = '".$i."' AND year = '".$year."' AND yardwastein != 0.00";
	$objDB->setQuery($orderSql1);
	$result1 = $objDB->select();
	$tempArr['DOWASTEIN'] = $result1[0]['DOWASTEIN'];
	
	$orderSql2 = "SELECT COUNT(compostout) as DOWASTEOUT FROM order_details WHERE month = '".$i."' AND year = '".$year."' AND compostout != 0.00";
	$objDB->setQuery($orderSql2);
	$result2 = $objDB->select();
	$tempArr['DOWASTEOUT'] = $result2[0]['DOWASTEOUT'];
	
	$orderData[] = $tempArr;
}

//HEADER ROW
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $year)
            ->setCellValue('B1', '#DO (Yards In)')
            ->setCellValue('C1', '#DO (Yards Out)')
            ->setCellValue('D1', 'YARDS IN')
            ->setCellValue('E1', 'YARDS OUT');
$objPHPExcel->getActiveSheet()
				    ->getStyle('A1:E1')
				    ->applyFromArray(
				        array(
				            'fill' => array(
				                'type' => PHPExcel_Style_Fill::FILL_SOLID,
				                'color' => array('rgb' => '62b925')
				            )
				        )
				    );          
            
//DATA	
$totalYardIn = 0;
$totalYardOut = 0;
$totalWasteInCnt = 0;
$totalWasteOutCnt = 0;		
$row = 0;
$fill = false;
$monthArr = array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
		
for($i=0; $i<12; $i++){
	$row = $i + 2;
	$data = $orderData[$i];
	$totalYardIn += $data['YARDSIN'];
	$totalYardOut += $data['YARDSOUT'];
	$totalWasteInCnt += $data['DOWASTEIN'];
	$totalWasteOutCnt += $data['DOWASTEOUT'];
	
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $monthArr[$i+1])
            ->setCellValue('B'.$row, $data['DOWASTEIN'])
            ->setCellValue('C'.$row, $data['DOWASTEOUT'])
            ->setCellValue('D'.$row, $data['YARDSIN'])
            ->setCellValue('E'.$row, $data['YARDSOUT']);
	
	$style1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        )
    );

	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($style1);
	if($fill){
		$objPHPExcel->getActiveSheet()
				    ->getStyle('A'.$row.":".'E'.$row)
				    ->applyFromArray(
				        array(
				            'fill' => array(
				                'type' => PHPExcel_Style_Fill::FILL_SOLID,
				                'color' => array('rgb' => 'e7e7e7')
				            )
				        )
				    );
	}
	$fill = !$fill;
}
	
// Add total data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A14', '')
            ->setCellValue('B14', $totalWasteInCnt)
            ->setCellValue('C14', $totalWasteOutCnt)
            ->setCellValue('D14', $totalYardIn)
			->setCellValue('E14', $totalYardOut);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($fileName);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$fileName);
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
