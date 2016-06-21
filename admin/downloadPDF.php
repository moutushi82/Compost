<?php
include_once("../utility/config.php");
include_once("../utility/dbclass.php");
include_once("../utility/functions.php");
include_once("../utility/fpdf/fpdf.php");

$action = "";
$objDB = new DB();

//$month = $_REQUEST['month'];
$year = $_REQUEST['year'];


class PDF extends FPDF {
	// Load data
	function LoadData($rs)
	{
		$data = array();
		$data = $rs;
		return $data;
	}
	
	function BasicTable($header, $dataArr)
	{
		$monthArr = array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
	    // Header
	    foreach($header as $col)
	        $this->Cell(40,7,$col,1,0,'C');
	    $this->Ln();
	    // Data
	    //pr($data);
	    $totalYardIn = 0;
		$totalYardOut = 0;
		$totalWasteInCnt = 0;
		$totalWasteOutCnt = 0;
		for($i=0; $i<12; $i++){
			$data = $dataArr[$i];
			$totalYardIn += $data['YARDSIN'];
			$totalYardOut += $data['YARDSOUT'];
			$totalWasteInCnt += $data['DOWASTEIN'];
			$totalWasteOutCnt += $data['DOWASTEOUT'];
			//pr($data);
			$this->Cell(40,6,$monthArr[$i+1],1);
			$this->Cell(40,6,$data['DOWASTEIN'],1,0,'C');
			$this->Cell(40,6,$data['DOWASTEOUT'],1,0,'C');
			$this->Cell(40,6,$data['YARDSIN'],1,0,'C');
			$this->Cell(40,6,$data['YARDSOUT'],1,0,'C');
	        $this->Ln();
		}
		$this->Cell(40,6,"",1);
		$this->Cell(40,6,$totalWasteInCnt,1,0,'C');
		$this->Cell(40,6,$totalWasteOutCnt,1,0,'C');
		$this->Cell(40,6,$totalYardIn,1,0,'C');
		$this->Cell(40,6,$totalYardOut,1,0,'C');
        $this->Ln();
	}

	function FancyTable($header, $dataArr)
	{
		$monthArr = array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
		
	    // Colors, line width and bold font
	    $this->SetFillColor(98,185,37);
	    $this->SetTextColor(0,0,0);
	    $this->SetDrawColor(0,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    // Header
	    $w = array(35, 40, 40, 30, 35);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $this->Ln();
	    // Color and font restoration
	    $this->SetFillColor(231,231,231);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    // Data
	    $fill = false;
		$totalYardIn = 0;
		$totalYardOut = 0;
		$totalWasteInCnt = 0;
		$totalWasteOutCnt = 0;
	    for($i=0; $i<12; $i++)
	    {
	        $data = $dataArr[$i];
			$totalYardIn += $data['YARDSIN'];
			$totalYardOut += $data['YARDSOUT'];
			$totalWasteInCnt += $data['DOWASTEIN'];
			$totalWasteOutCnt += $data['DOWASTEOUT'];
			//pr($data);
			$this->Cell(35,6,$monthArr[$i+1],1,0,'L',$fill);
			$this->Cell(40,6,$data['DOWASTEIN'],1,0,'C',$fill);
			$this->Cell(40,6,$data['DOWASTEOUT'],1,0,'C',$fill);
			$this->Cell(30,6,$data['YARDSIN'],1,0,'C',$fill);
			$this->Cell(35,6,$data['YARDSOUT'],1,0,'C',$fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
		
		$this->Cell(35,6,"",1,0,'C');
		$this->Cell(40,6,$totalWasteInCnt,1,0,'C');
		$this->Cell(40,6,$totalWasteOutCnt,1,0,'C');
		$this->Cell(30,6,$totalYardIn,1,0,'C');
		$this->Cell(35,6,$totalYardOut,1,0,'C');
        $this->Ln();
	    // Closing line
	    //$this->Cell(array_sum($w),0,'','T');
	}
}

$orderData = array();

for($i=1; $i<=12; $i++){
	$orderSql = "SELECT month, SUM(yardwastein) as YARDSIN, SUM(compostout) as YARDSOUT, COUNT(`id`) as COMPOSTOFF, COUNT(yardwastein) as DOWASTEIN, COUNT(compostout) as DOWASTEOUT FROM order_details WHERE month = '".$i."' AND year = '".$year."'";
	$objDB->setQuery($orderSql);
	$result = $objDB->select();
	
	$orderData[] = $result[0];
}

$fileName = "uprov_compost_".$year.".pdf";

$pdf = new PDF();
// Column headings
$header = array($_REQUEST['year'], '#DO (Yards In)', '#DO (Yards Out)', 'YARDS IN', 'YARDS OUT');
// Data loading
$data = $pdf->LoadData($orderData);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
//$pdf->Output('D',$fileName);

?>