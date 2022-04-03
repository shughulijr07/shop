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
      
      ///  $this->Image('../pictures/logoo.png',10,6);
      date_default_timezone_set("Africa/Dar_es_Salaam");
        $today = date("Y-m-d");
        $shop = $_REQUEST['shop'];
        $database = new DatabaseConnection;
        $today_sells = $database->connect()->prepare("SELECT SUM(totalSelling) as total_sell FROM issue WHERE shop = '$shop' ");
        $today_sells->execute();
        $sells = $today_sells->fetchAll();
        foreach ($sells as $selled) {

        $total_sells = number_format($selled['total_sell']);
        # code...
        }
		$this->SetFont('Arial','B',14);
		$this->Cell(266,5,"$shop Informatics Shop",0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,"PDF DOCUMENT OF $shop of $today with Total sells $total_sells",0,0,'C');
		
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
		$this->Cell(45,10,'Date & Time',1,0,'C');
		$this->Cell(65,10,'Product',1,0,'C');
		$this->Cell(60,10,'Type',1,0,'C');
		$this->Cell(25,10,'Price',1,0,'C');
		$this->Cell(30,10,'Quantity',1,0,'C');
		$this->Cell(40,10,'Total',1,0,'C');
		$this->Ln();
	}

	function SlipDetails()
	{
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $today = date("Y-m-d");
        $database = new DatabaseConnection;
        $shop = $_REQUEST['shop'];
        $query = $database->connect()->query("SELECT * FROM issue WHERE shop = '$shop'");
        while($data = $query->fetch(PDO::FETCH_OBJ))
		{
		$this->SetFont('Times','',12);
		$this->Cell(45,10,$data->date,1,0,'L');
		$this->Cell(65,10,$data->product,1,0,'L');
		$this->Cell(60,10,$data->type,1,0,'L');
        $this->Cell(25,10,number_format($data->price),1,0,'L');
        $this->Cell(30,10,$data->qty,1,0,'L');
        $this->Cell(40,10,number_format($data->totalSelling),1,0,'L');
		
		$this->Ln();
	   }
    }

 }
$pdf = new pdfDocument();
$pdf-> AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();

$pdf->SlipDetails();

$pdf->Output('shoppdf.pdf','D');