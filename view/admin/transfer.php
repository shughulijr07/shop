<?php include '../../required/session.php';  ?>
<?php
include '../../model/database.php';
$dBcONNECT = new DatabaseConnection;
$today = date("Y-m-d");
$today_sells = $dBcONNECT->connect()->prepare("SELECT SUM(totalSelling) as total_sell FROM issue");
$today_sells->execute();
$sells = $today_sells->fetchAll();
foreach ($sells as $selled) {

  $total_sells = $selled['total_sell'];
 # code...
}
$shop_points = $dBcONNECT->connect()->prepare("SELECT * FROM shop_point");
$shop_points->execute();
$data1 = $shop_points->fetchAll();

$point = $_REQUEST['point'];
$shop_point_sells = $dBcONNECT->connect()->prepare("SELECT * FROM product_store WHERE shop = '$point'");
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
          <li class="breadcrumb-item active"><?php echo $point ?></li>
          <li class="breadcrumb-item">
            <a href="#" data-toggle="modal" data-target="#changePassword" style="text-decoration: none;">Change Password</a>
          </li>
        </ol>

        <!-- Icon Cards-->

        <div class="card mb-3">
            <div class="bg-info" style="width: 100%;height: 5px"></div>
            <div class="card-header" style="background-color: white">
              <div class="row">
                <div class="col-md-4" style="color: maroon">
                    <i class="fas fa-table"></i>
                    <?php echo $point ?> | <?php echo date("l"); ?>
                </div>
                <div class="col-md-6" style="color: maroon">
                  <div class="row">
                    <div class="col-md-6"></div>
                  
                    <div class="col-md-6"> </div>
                   
                  </div>
                </div>
                <div class="col-md-1">
                    <!-- <a href="" class="btn bg-danger btn-sm" title="Get PDF Report" style=""><i class="fa fa-print" ></i></a> -->
                </div>
                <div class="col-md-1">
                    
                    <!-- <a href="shopviewall.php?shop=" class="btn bg-danger btn-sm" title="View All" style=""><i class="fas  fa-list"></i></a> -->
                </div>
              </div>
             
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Item title</th>
                        <th>Item Title</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Total Sell</th>
                        <th>Total buying</th>
                        <th>Action</th>
                       
                    </tr>
                  </thead>
                      <?php 
                         foreach ($get_shop_point_sells as $get_point) {
                             echo '
                             <tr>
                                <td>'.$get_point['product_name'].'</td>
                                <td>'.$get_point['product_type'].'</td>
                                <td>'.$get_point['buying_price'].'</td>
                                <td>'.$get_point['selling_price'].'</td>
                                <td>'.$get_point['quantity'].'</td>
                                <td>'.$get_point['total_selling' ].'</td>
                                <td>'.$get_point['total_buying' ].'</td>
                                <td>
                                     <a href="transferProd.php?product='.$get_point['product_id'].'" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                     <a onclick="confirm("Are you sure you want to delete ?")" href="pointproddelete.php?id='.$get_point['product_id'].'&point='.$get_point['shop'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
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