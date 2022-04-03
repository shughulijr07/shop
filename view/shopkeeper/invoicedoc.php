<?php
session_start(); 
 if(!isset($_SESSION['username'])){
    header("location:../../");//if the username is incorrect or the session is destroyed then return to login page/index.php
 }
 
require "../../PDF/fpdf.php";
include '../../model/database.php';


/**
* 
*/
class pdfDocument extends FPDF
{

	function header(){
       // session_start();
         $shop = $_SESSION['point'];
      ///  $this->Image('../pictures/logoo.png',10,6);
        $invoice_no = $_REQUEST['doc_id'];
		$this->SetFont('Arial','B',14);
		$this->Cell(266,5,"$shop Informatics Shop",0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,"Sales Report Number $invoice_no",0,0,'C');
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
		$this->Cell(85,10,'Product',1,0,'C');
		$this->Cell(60,10,'Type',1,0,'C');
		$this->Cell(40,10,'Price',1,0,'C');
		$this->Cell(30,10,'Quantity',1,0,'C');
		$this->Cell(60,10,'Total',1,0,'C');
		$this->Ln();
	}

	function SlipDetails()
	{

       
        $database = new DatabaseConnection;
        $invoiceNO = $_REQUEST['doc_id'];
        $query = $database->connect()->query("SELECT * FROM issue WHERE insue_no = $invoiceNO");
        while($data = $query->fetch(PDO::FETCH_OBJ))
		{
		$this->SetFont('Times','',12);
		$this->Cell(85,10,$data->product,1,0,'L');
		$this->Cell(60,10,$data->type,1,0,'L');
        $this->Cell(40,10,$data->price,1,0,'L');
        $this->Cell(30,10,$data->qty,1,0,'L');
        $this->Cell(60,10,$data->totalSelling,1,0,'L');
		
		$this->Ln();
	   }
    }

 }
$pdf = new pdfDocument();
$pdf-> AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();

$pdf->SlipDetails();

$pdf->Output('invoiceDoc.pdf','D');