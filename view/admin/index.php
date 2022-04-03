<?php include '../../required/session.php';  ?>
<?php
include '../../model/database.php';
$dBcONNECT = new DatabaseConnection;

$shop_point = $dBcONNECT->connect()->prepare("SELECT * FROM shop_point");
$shop_point->execute();
$data1 = $shop_point->fetchAll();

$total_product = $dBcONNECT->connect()->prepare("SELECT * FROM product_store");
$total_product->execute();
$product = $total_product->fetchAll();
$seling_price = $dBcONNECT->connect()->prepare("SELECT SUM(total_selling) as selling FROM product_store");
$seling_price->execute();
$data4 = $seling_price->fetchAll();

foreach ($data4 as $price) {

   $sp = $price['selling'];
  # code...
}



$stock = $dBcONNECT->connect()->prepare("SELECT *  FROM product_store");
$stock->execute();
$all = $stock->rowCount();
$get_out = $dBcONNECT->connect()->prepare("SELECT *  FROM product_store WHERE quantity < 10");
$get_out->execute();
$out = $get_out->rowCount();
$get_pharmacist = $dBcONNECT->connect()->prepare("SELECT *  FROM users ");
$get_pharmacist->execute();
$Pharmacist = $get_pharmacist->rowCount();
$get_shop = $dBcONNECT->connect()->prepare("SELECT *  FROM shop_point");
$get_shop->execute();
$shop_list = $get_shop->rowCount();

$buying_price = $dBcONNECT->connect()->prepare("SELECT SUM(total_buying) as buying FROM product_store");
$buying_price->execute();
$data2 = $buying_price->fetchAll();
foreach ($data2 as $buying) {

  $bp = $buying['buying'];
 # code...
}
$balance = $sp - $bp;
$today = date("Y-m-d");
$erningMonth = $dBcONNECT->connect()->prepare("SELECT SUM(totalSelling) as total_sell FROM issue ");
$erningMonth->execute();
$ening = $erningMonth->fetchAll();
foreach ($ening as $earn) {

  $earningMonth = $earn['total_sell'];
 # code...
}
$today_sells = $dBcONNECT->connect()->prepare("SELECT SUM(totalSelling) as total_sell FROM issue WHERE date_issued = '$today' ");
$today_sells->execute();
$sells = $today_sells->fetchAll();
foreach ($sells as $selled) {

  $total_sells = $selled['total_sell'];
 # code...
}

$shop_point_sells = $dBcONNECT->connect()->prepare("SELECT shop,date_issued, SUM(totalSelling) AS totalsells FROM issue WHERE date_issued = '$today' GROUP BY shop");
$shop_point_sells->execute();
$get_shop_point_sells = $shop_point_sells->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include '../../required/links.php'  ?>
    <title>Shop | Admin</title>
</head>
<body class="">
  <!-- header -->
  <?php require '../../required/header.php' ?>
  <!-- end of header -->

  <!-- nav -->
  <?php require '../../required/navi.php' ?>
  <!-- end of nav -->
    
   <div class="" style="">
    
    <div class=" " style="">
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
          
          <li class="breadcrumb-item">
            <a href="#" data-toggle="modal" data-target="#changePassword" style="text-decoration: none;">Change Password</a>
          </li>
        </ol>

        <!-- Icon Cards DASHBOARD-->
 <div class="row">

<!-- Earnings  Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($earningMonth) ?> Tshs</div>
        </div>
        <div class="col-auto">
          <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
          <img src="../../images/pesa.jpg" alt="" srcset="">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Today)</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total_sells) ?> Tshs</div>
        </div>
        <div class="col-auto">
          <!-- <i class="fas fa-dollar fa-2x text-gray-300"></i> -->
          <img src="../../images/ten.jpg" alt="" srcset="">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total out of Stock Product</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span class="badge badge-danger"><?php echo $out ?></span></div>
            </div>
            <div class="col">
            <a href="stocklevel.php">View details</a>
              <!-- <div class="progress progress-sm mr-2">
                <div class="progress-bar bg-info" role="progressbar" style="width: <?php// echo $out ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending ?></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-comments fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
        <!-- mwisho -->

        <div class="card mb-3">
            <div class="bg-info" style="width: 100%;height: 5px"></div>
            <div class="card-header" style="background-color: white">
              <div class="row">
                <div class="col-md-4" style="color: maroon">
                    <i class="fas fa-table"></i>
                    Sales Details Of Today | <?php echo date("l"); ?>
                </div>
                <div class="col-md-6" style="color: maroon">
                  <div class="row">
                    <div class="col-md-6">Total Sales: <?php echo number_format($total_sells) ?> /= Tshs</div>
                  
                    <div class="col-md-6"> </div>
                   
                  </div>
                </div>
                <div class="col-md-1">
                    <a href="shoppointpdf.php" class="btn bg-danger btn-sm" title="Get PDF Report" style=""><i class="fa fa-print" ></i></a>
                </div>
                <div class="col-md-1">
                    
                    <a href="allshoppoint.php" class="btn bg-danger btn-sm" title="View All" style=""><i class="fas  fa-list"></i></a>
                </div>
              </div>
             
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Date</th>
                        <th>Shop</th>
                        <th>Total Sells</th>
                        <th></th>
                    </tr>
                  </thead>
                      <?php 
                         foreach ($get_shop_point_sells as $get_point) {
                             echo '
                             <tr>
                                <td>'.$get_point['date_issued'].'</td>
                                <td>'.$get_point['shop'].'</td>
                                <td>'.number_format($get_point['totalsells']).'</td>
                                <td><a style="float: right;" href="moredetails.php?shop='.$get_point['shop'].'" class="btn btn-info" >View More</a>
                              </tr>  
                             ';
                         }
                      ?>
                  <tbody>
                   <?php
                    
                   ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">
               <div class="row"><div class="col-md-5"> </div> <div class="col-md-6"></div><div class="col-md-1"></div></div>
            </div>
        </div>

    </div>
    </div>
<?php include 'modal.php' ?>
<?php include '../../required/footer.php' ?>
</body>
</html>

<script>
   $(".dataTable").DataTable();
</script>