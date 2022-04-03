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

        $database = new DatabaseConnection;
        $today_sells = $database->connect()->prepare("SELECT SUM(total_selling) as total_sell,SUM(total_buying) as total_buys FROM product_store");
        $today_sells->execute();
        $sells = $today_sells->fetchAll();
        foreach ($sells as $selled) {
        $total_buys = number_format($selled['total_buys']);
        $total_sells = number_format($selled['total_sell']);
        # code...
        }
		$this->SetFont('Arial','B',14);
		$this->Cell(266,5,"Informatics Shop",0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,"PDF DOCUMENT OF ALL PRODUCT PRINTED  $today with Total Buying price $total_buys and Total Selling price $total_sells",0,0,'C');
		
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
		$this->Cell(40,10,'Shop',1,0,'C');
		$this->Cell(40,10,'Product',1,0,'C');
		$this->Cell(30,10,'Product Type',1,0,'C');
		$this->Cell(80,10,'Description',1,0,'C');
		$this->Cell(30,10,'Buying Price',1,0,'C');
		$this->Cell(30,10,'Selling Price',1,0,'C');
		$this->Cell(25,10,'Quantity',1,0,'C');
		$this->Ln();
	}

	function SlipDetails()
	{
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $today = date("Y-m-d");
        $database = new DatabaseConnection;
        $query = $database->connect()->query("SELECT * FROM product_store");
        while($data = $query->fetch(PDO::FETCH_OBJ))
		{
		$this->SetFont('Times','',12);
		$this->Cell(40,10,$data->shop,1,0,'L');
		$this->Cell(40,10,$data->product_name,1,0,'L');
		$this->Cell(30,10,$data->product_type,1,0,'L');
		$this->Cell(80,10,$data->description,1,0,'L');
        $this->Cell(30,10,number_format($data->buying_price),1,0,'L');
        $this->Cell(30,10,number_format($data->selling_price),1,0,'L');
        $this->Cell(25,10,$data->quantity,1,0,'L');
		$this->Ln();
	   }
    }

 }
$pdf = new pdfDocument();
$pdf-> AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();

$pdf->SlipDetails();

$pdf->Output('Productlist.pdf','D');