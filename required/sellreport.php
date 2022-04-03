<?php

 
require "../PDF/fpdf.php";
include '../model/database.php';


/**
* 
*/
class pdfDocument extends FPDF
{
    
	function header(){
      
      ///  $this->Image('../pictures/logoo.png',10,6);
      date_default_timezone_set("Africa/Dar_es_Salaam");
        $today = date("Y-m-d");
        
        $from    = $_REQUEST['start'];
        $to      = $_REQUEST['end'];
        $point   = $_REQUEST['point'];
        $database = new DatabaseConnection;
        $today_sells = $database->connect()->prepare("SELECT SUM(totalSelling) as total_sell FROM issue WHERE shop = '$point' AND date_issued BETWEEN '$from' AND '$to'");
        $today_sells->execute();
        $sells = $today_sells->fetchAll();
        foreach ($sells as $selled) {

        $total_sells = number_format($selled['total_sell']);
        # code...
        }
		$this->SetFont('Arial','B',14);
		$this->Cell(266,5,"Informatics Shop ",0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,"$point SALES REPORT FROM  $from TO $to with Total sells $total_sells",0,0,'C');
		
		$this->Ln(20);

	}
    
   
	function footer()
	{
		# code...
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C'); 

	}
   
	function headerTable(){
        
		$this->SetFont('Times','B',12);
		$this->Cell(45,10,'Date',1,0,'C');
		$this->Cell(70,10,'Product',1,0,'C');
		$this->Cell(60,10,'Type',1,0,'C');
		$this->Cell(30,10,'Price',1,0,'C');
		$this->Cell(20,10,'Qty',1,0,'C');
		$this->Cell(45,10,'Total Sell',1,0,'C');
		$this->Ln();
	}

	function SlipDetails()
	{
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $from    = $_REQUEST['start'];
        $to      = $_REQUEST['end'];
        $point   = $_REQUEST['point'];
        $database = new DatabaseConnection;
        $query = $database->connect()->query("SELECT *  FROM issue WHERE shop = '$point' AND date_issued BETWEEN '$from' AND '$to'");
        while($data = $query->fetch(PDO::FETCH_OBJ))
		{
		$this->SetFont('Times','',12);
		$this->Cell(45,10,$data->date_issued,1,0,'L');
		$this->Cell(70,10,$data->product,1,0,'L');
		$this->Cell(60,10,$data->type,1,0,'L');
        $this->Cell(30,10,number_format($data->price),1,0,'L');
        $this->Cell(20,10,$data->qty,1,0,'L');
        $this->Cell(45,10,number_format($data->totalSelling),1,0,'L');
		$this->Ln();
	   }
    }

    // public function sellReport(){
    //     $from    = $_POST['start'];
    //     $to      = $_POST['end'];
    //     $point   = $_POST['point'];
    //     $this->header($from,$to,$point);
    //     $this->AliasNbPages();
    //     $this->AddPage('L','A4',0);
    //     $this->headerTable();
    //     $this->SlipDetails($from,$to,$point);
       
    //     $this->Output('sellsReport.pdf','D');
    // }

 }
$pdf = new pdfDocument();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();

$pdf->SlipDetails();

$pdf->Output('sellsReport.pdf','D');