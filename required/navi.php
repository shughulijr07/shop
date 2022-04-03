<?php
    $date_of_today = date('Y-m-d');
    $expiredCount = $dBcONNECT->connect()->prepare("SELECT * FROM product_store WHERE expiredate = '$date_of_today'");
    $expiredCount->execute();
    $expierd = $expiredCount->rowCount();

   $penging_request = $dBcONNECT->connect()->prepare("SELECT * FROM ordering WHERE status = 'old'");
   $penging_request->execute();
  
   $pending = $penging_request->rowCount();
   $shop_order_total = $dBcONNECT->connect()->prepare("SELECT * FROM ordering WHERE status = 'new'");
   $shop_order = $dBcONNECT->connect()->prepare("SELECT * FROM ordering WHERE status = 'new' LIMIT 5");
   $shop_order->execute();
   $orders = $shop_order->fetchAll();
   $shop_order_total->execute();
   $total_order = $shop_order_total->rowCount();
?>
<nav class="navbar  navbar-expand-md ">
  <!-- Brand -->
  <a class="navbar-brand" href="#"></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    
    </ul>
    <ul class="navbar-nav ml-auto">
    <?php 
        if (!isset($_SESSION['username'])) {
          ?>
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">Login</button> 
          <?php
        } else {
          ?>
           <!-- Dropdown -->
           <?php if($_SESSION['role'] == "admin"){?>
            <li class="nav-item" style="margin-right: 5px">  <a href="expired.php"  class="btn btn-info" style=""><span class="badge badge-danger"><?php echo $expierd ?></span> Expired Product</a></li>
            <li class="nav-item" style="margin-right: 5px"><a href="#" data-toggle="modal" data-target="#saleReportAdmin" class="d-none d-sm-inline-block btn  btn-info shadow-sm"><i class="fas fa-file-pdf fa-sm text-white-50"></i> Generate Report</a></li>
            <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-bell fa-fw"></i>
                          <!-- Counter - Alerts -->
                          <span class="badge badge-danger badge-counter"><?php echo $total_order ?>+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                          <h6 class="dropdown-header">
                            Product Requests
                          </h6>
                         <?php 
                            foreach ($orders as $value) {
                         ?> 
                          <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                              <div class="icon-circle bg-primary">
                                <i class="fas fa-bell text-white"></i>
                              </div>
                            </div>
                            <div>
                              <div class="small text-gray-500"><?php echo $value['date'] ?></div>
                              
                              <span class="text-truncate"><?php echo $value['shop'] ?></span>
                              , <span class="text-truncate"><?php echo $value['product'] ?></span>
                                <span class="text-truncate"><?php echo $value['type'] ?></span>
                            </div>
                          </a>
                            <?php } ?>  
                          <a class="dropdown-item text-center  text-primary" href="requests.php">Show All Request</a>
                        </div>
                </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Shop
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item btn btn-primary"  data-toggle="modal" data-target="#addShop">Add new Shop</a>
              
              <a class="dropdown-item" href="updateshop.php">Shop Points</a>
            </div>
          </li>
         

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
             Store
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="addproduct.php">Add new Product</a>
              <!-- <div class="dropdown-divider"></div>  -->
              <a class="dropdown-item" href="shoppoints.php">Shop Points</a>
              <!-- <div class="dropdown-divider"></div>  -->
              <a class="dropdown-item" href="internalTransfer.php">Internal Transfer</a>
              <!-- <a class="dropdown-item" href="product.php">View Products</a> -->
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
             Users
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item btn btn-primary" data-toggle="modal" data-target="#addUser">Add new User</a>
              <a class="dropdown-item" href="users.php">Update User</a>
            </div>
          </li>

         <?php  }?>
          
            <?php
               if ($_SESSION['role'] == "shopkeeper") {?>
                <!-- <li class="nav-item" style="margin-right: 5px">  <a href="expired.php"  class="btn btn-info" style=""><span class="badge badge-danger"><?php // echo $expierd ?></span> Expired Product</a></li> -->
                <li class="nav-item" style="margin-right: 5px"><a href="#" data-toggle="modal" data-target="#saleReport" class="d-none d-sm-inline-block btn  btn-info shadow-sm"><i class="fas fa-file-pdf-o fa-sm text-white-50"></i> Generate Report</a></li>
                <li class="nav-item" style="margin-right: 5px">  <a href="place_order.php" class="btn btn-info" style="">Place an Order</a></li>
                <li class="nav-item" style="margin-right: 5px">  <a href="#" data-toggle="modal" data-target="#changePassword" class="btn btn-info" style="">Change Password</a></li>
             <?php  }
            ?>
           
           
            <li><a class="btn btn-primary" href="../../required/logout.php">Logout</a></li>
        <?php
        }
        
      ?>
         
    </ul>
           
  </div>
</nav> 

<!-- The Modal -->
<div class="modal fade " id="login">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">Informatics Shop | Login Form</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="background-color: #ffe6ff">
           <form class="">
              <div class="row">
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                    <label for="Username">Username</label>
                      <input name="username" type="text" class="form-control" >
                    <label for="Password">Password</label>
                      <input name="password" type="password" class="form-control" autofocus>
                 </div>
                 <div class="col-md-2"></div>
              </div>
              <div id="login_sms">

              </div>

              <button class="btn btn-success" id="login_btn" style="width: 40%;margin-top: 10px;margin-left: 120px">Login</button>
           </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal fade " id="saleReport">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center text-white">Informatics Shop | Generate Sales Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="">
           <form class="" method="POST" action="../../required/controller.php">
              <div class="row">
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                    <label for="start">From Date</label>
                      <input name="start" type="date" class="form-control" >
                      <input hidden name="point" type="text" value="<?php echo $_SESSION['point'] ?>" class="form-control" >
                    <label for="end">To Date</label>
                      <input name="end" type="date" class="form-control" autofocus>
                 </div>
                 <div class="col-md-2"></div>
              </div>
              <div id="">
                  
              </div>
                 
              <button name="sellReport" type="submit" style="width: 40%;margin-top: 10px;margin-left: 120px"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
           </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>