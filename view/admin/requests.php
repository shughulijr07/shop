<?php include '../../required/session.php';  ?>
<?php
include '../../model/database.php';
$dBcONNECT = new DatabaseConnection;
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

$shop_point_sells = $dBcONNECT->connect()->prepare("SELECT * FROM ordering ORDER BY order_id DESC");
$shop_point_sells->execute();
$get_shop_point_sells = $shop_point_sells->fetchAll();

$old_equest = $dBcONNECT->connect()->prepare("SELECT * FROM ordering WHERE status = 'new'");
$old_equest->execute();
$get_id  =  $old_equest->fetchAll();


foreach ($get_id as $value) {
    $id = $value['order_id'];
    $update_request = $dBcONNECT->connect()->prepare("UPDATE ordering SET status = 'old' WHERE  order_id=$id ");
    $update_request->execute();
}

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
          <li class="breadcrumb-item active">Product Request</li>
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
                    Product Requests | <?php echo date("l"); ?>
                </div>
                <div class="col-md-6" style="color: maroon">
                  <div class="row">
                    <div class="col-md-6"></div>
                  
                    <div class="col-md-6"> </div>
                   
                  </div>
                </div>
                <div class="col-md-1">
                    
                </div>
                <div class="col-md-1">
                   
                </div>
              </div>
             
            </div>
            <div class="card-body" style="height: 350px; overflow: auto;">
              <div class="table-responsive">
                <table class="table table-bordered  table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Shop</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Date & Time</th>
                        <th></th>
                    </tr>
                  </thead>
                      <?php 
                         foreach ($get_shop_point_sells as $get_point) {
                             echo '
                             <tr>
                                <td>'.$get_point['shop'].'</td>
                                <td>'.$get_point['product'].'</td>
                                <td>'.$get_point['type'].'</td>
                                <td>'.$get_point['date'].'</td>
                                <td><a request_id = '.$get_point['order_id'].' class="btn btn-danger delete_request">Delete</a></td>
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