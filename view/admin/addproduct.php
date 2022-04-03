<?php include '../../required/session.php'  ?>
<?php
include '../../model/database.php';
$dBcONNECT = new DatabaseConnection;

$shop_point = $dBcONNECT->connect()->prepare("SELECT * FROM shop_point");
$shop_point->execute();
$data1 = $shop_point->fetchAll();

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
  <?php require '../../required/navi.php';
  $message = "";
  ?>
  <!-- end of nav -->
    
    <div class="" style="">
        
        <div class=" " style="">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add Product</li>
                <li class="breadcrumb-item">
                    <a href="" data-toggle="modal" data-target="#changePassword">Change Password</a>
                </li>
            </ol>

            <div class="row" >
                
                <div class="col-md-6">
                    <div class="card" >
                         <div class="card-header bg-success text-white text-center"  id="success">Adding Product in Store</div>
                         <div class="card-body">
                               <form style="margin-bottom: 30px">
                               <!-- name="addproduct" method="POST" action="../../required/controller.php" -->
                                    <div class="form-group">
                                        <div class="row">
                                           <div class="col-md-2">
                                              <label for="">Product:</label>
                                           </div>
                                           <div class="col-md-5">
                                             <input name="product" type="text" class="form-control" required autofocus>
                                           </div>
                                           <div class="col-md-1">
                                              <label for="">Type:</label>
                                           </div>
                                           <div class="col-md-4">
                                           <select name="type" class="form-control" id="sel1" required>
                                                <option value="Kilogram">Kilogram</option>
                                                <option value="Pieces">Pieces</option>
                                                <option value="Litre">Litre</option>
                                                <option value="Packets">Packets</option>
                                                <option value="Dozen">Dozen</option>
                                                <option value="Caton">Caton</option>                                       
                                            </select>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                           <div class="col-md-2">
                                              <label for="">Buying Price:</label>
                                           </div>
                                           <div class="col-md-4">
                                             <input name="bp"  min="1" type="number" class="form-control" required placeholder="Per Product">
                                           </div>
                                           <div class="col-md-2">
                                              <label  for="">Selling Price:</label>
                                           </div>
                                           <div class="col-md-4">
                                               <input name="sp"  min="1" type="number" class="form-control" required placeholder="Per Product">
                                           </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                           <div class="col-md-2">
                                              <label for="">Quantity:</label>
                                           </div>
                                           <div class="col-md-4">
                                             <input name="qty"  min="1" type="number" class="form-control" required>
                                           </div>
                                           <div class="col-md-2">
                                              <label for="">Shop:</label>
                                           </div>
                                           <div class="col-md-4">
                                                <select name="shop" class="form-control" id="sel1">
                                                        <?php
                                                                foreach ($data1 as $shop) {
                                                                    $option = $shop['name'];
                                                                echo "
                                                                        <option value='".$option."'>".$option."</option>
                                                                        ";
                                                                }
                                                        ?>
                                                </select>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                          <div class="col-md-4">
                                             <label for="date">Expire Date</label>
                                             <input hidden value="<?php echo $date_of_today = date('Y-m-d'); ?>" name="date_bought" class="form-control" type="date" required>
                                             <input   name="expiredate" class="form-control" type="date" required>
                                          </div>
                                           <div class="col-md-2">
                                              <label for="">Description:</label>
                                           </div>
                                           <div class="col-md-6">
                                                 <textarea name="description" class="form-control" rows="2" id="comment"></textarea>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                           <button id="Addproduct_btn" type="submit" style="width: 100%;" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                
                                </form> 
                         </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="height: 450px; overflow-y: scroll;">
                        <div class="card-header bg-info text-center">Short Summary</div>
                        <div class="card-body">
                           <div class="table-responsive">
                            <table class="table  table-striped table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Type</th>
                                        <th>Selling Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="summary">
                                    
                                
                                    </tbody>
                                </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php include '../../required/footer.php' ?>
    </div>
    <?php include 'modal.php'; ?>
</body>
</html>