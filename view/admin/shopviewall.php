<?php include '../../required/session.php';  ?>
<?php
include '../../model/database.php';
$dBcONNECT = new DatabaseConnection;
$shop_point = $_REQUEST['shop'];
$today = date("Y-m-d");
$today_sells = $dBcONNECT->connect()->prepare("SELECT SUM(totalSelling) as total_sell FROM issue WHERE shop = s$shop_pointhop_point ");
$today_sells->execute();
$sells = $today_sells->fetchAll();
foreach ($sells as $selled) {

  $total_sells = $selled['total_sell'];
 # code...
}
$shop_points = $dBcONNECT->connect()->prepare("SELECTshop_pointcy_point");
$shop_points->execute();
$data1 = $shop_points->fetchAll();

$shop_point_sells = $dBcONNECT->connect()->prepare("SELECT * FROM issue WHERE shop = s$shop_pointhop_point");
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
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
          <li class="breadcrumb-item active"><?php echo $shop_point ?></li>
          <li class="breadcrumb-item">
            <a href="#" data-toggle="modal" data-target="#changePassword" style="text-decoration: none;">Change Password</a>
          </li>
        </ol>

        <!-- Icon Cards-->

        <div class="card mb-3">
            <div class="bg-info" style="width: 100%;height: 5px"></div>
            <div class="card-header" style="background-color: white">
              <div class="row">
                <div class="col-md-4" style="color: maroon;">
                    <i class="fas fa-table"></i>
                    Sales Details Of <?php echo $shop_point ?> | <?php echo date("l"); ?>
                </div>
                <div class="col-md-6" style="color: maroon">
                  <div class="row">
                    <div class="col-md-6">Total Sales: <?php echo number_format($total_sells) ?> /= Tshs</div>
                  
                    <div class="col-md-6"> </div>
                   
                  </div>
                </div>
                <div class="col-md-1">
                    <a href="shopviewallpdf.php?shop=<?php echo $shop_point ?>" class="btn bg-danger btn-sm" title="Get PDF Report" style=""><i class="fa fa-print" ></i></a>
                </div>
                <div class="col-md-1">
                    
                    <a href="moredetails.php?shop=<?php echo $shop_point ?>" class="btn bg-danger btn-sm" title="Today" style=""><i class="fas  fa-list"></i></a>
                </div>
              </div>
             
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Document NO</th>
                    </tr>
                  </thead>
                      <?php 
                         foreach ($get_shop_point_sells as $get_point) {
                             echo '
                             <tr>
                                <td>'.$get_point['date'].'</td>
                                <td>'.$get_point['product'].'</td>
                                <td>'.$get_point['type'].'</td>
                                <td>'.number_format($get_point['price']).'</td>
                                <td>'.$get_point['qty'].'</td>
                                <td>'.number_format($get_point['totalSelling']).'</td>
                                <td>'.$get_point['insue_no'].'</td>
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
    <?php include '../../required/footer.php' ?>
</div>
  <?php include 'modal.php'; ?>
</body>
</html>

<script>
   $(".dataTable").DataTable();
</script>