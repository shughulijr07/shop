<?php include '../../required/session.php';  ?>
<?php
include '../../model/database.php';
include '../../model/shop.php';
$dBcONNECT = new DatabaseConnection;
$users = new Shop;
$today = date("Y-m-d");
$today_sells = $dBcONNECT->connect()->prepare("SELECT SUM(total_buying) as buying,SUM(total_selling) as selling FROM product_store");
$today_sells->execute();
$sells = $today_sells->fetchAll();
foreach ($sells as $selled) {

  $total_selling_price = $selled['selling'];
  $total_buying_price = $selled['buying'];
 # code...
}
$shop_points = $dBcONNECT->connect()->prepare("SELECT * FROM shop_point");
$shop_points->execute();
$data1 = $shop_points->fetchAll();

$shop_point_sells = $dBcONNECT->connect()->prepare("SELECT * FROM product_store");
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
          <li class="breadcrumb-item active">All Products</li>
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
                    All products Details | <?php echo date("l"); ?>
                </div>
                <div class="col-md-6" style="color: maroon">
                  <div class="row">
                    
                   
                  </div>
                </div>
                <div class="col-md-1">
                    <a href="productpdf.php" class="btn bg-danger btn-sm" title="Get PDF Report" style=""><i class="fa fa-print" ></i></a>
                </div>
                <div class="col-md-1">
                   
                </div>
              </div>
             
            </div>
            <div class="card-body">
            <div class="row" id="successUpdate_product"></div>
              <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Shop</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                      <?php 

                      ?>
                  <tbody>
                   <?php
                   $users->AllUsers();
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