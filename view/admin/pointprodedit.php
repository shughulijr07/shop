<?php include '../../required/session.php' ; ?>
<?php include '../../model/database.php';

$dBcONNECT = new DatabaseConnection;
$product_id = $_REQUEST['product'];
$stmt = $dBcONNECT->connect()->prepare("SELECT * FROM product_store WHERE product_id = ?");
$stmt->execute([$product_id]);

if($stmt->rowCount()){
    while($row = $stmt->fetch()){  

      $product_name = $row['product_name'];
      $product_type = $row['product_type'];
      $buying_price  = $row['buying_price'];
      $selling_price = $row['selling_price	'];
      $description   = $row['description'];
      $date_bought   = $row['date_bought'];
      $shop      = $row['shop'];
      $quantity      = $row['quantity'];
        	
    }

}

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
                <li class="breadcrumb-item active"><?php echo $shop ?> Edit Product</li>
                <li class="breadcrumb-item">
                      <a href="" data-toggle="modal" data-target="#changePassword">Change Password</a>
                </li>
            </ol>

            <div class="row">
            <div class="col-md-3">  </div>
                <div class="col-md-6">
                    <div class="card">
                         <div class="card-header bg-success text-white text-center" id="success">Updating Product in <?php echo $shop ?> Store</div>
                         <div class="card-body">
                               <form name="pointmedEdit" method="POST" action="../../required/controller.php">
                               <!-- name="addproduct" method="POST" action="../../required/controller.php" -->
                                    <div class="form-group">
                                        <div class="row">
                                           <div class="col-md-2">
                                              <label for="">Product:</label>
                                           </div>
                                           <div class="col-md-5">
                                             <input value="<?php echo $product_name ?>" name="product" type="text" class="form-control" required autofocus>
                                             <input hidden value="<?php echo $product_id ?>" name="product_id" type="number" class="form-control" required >
                                           </div>
                                           <div class="col-md-1">
                                              <label for="">Type:</label>
                                           </div>
                                           <div class="col-md-4">
                                           <select name="type" class="form-control" id="sel1" required>
                                                <option value="<?php echo $product_type ?>"><?php echo $product_type ?></option>
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
                                             <input value="<?php echo $buying_price ?>" name="bp"  min="1" type="number" class="form-control" required>
                                           </div>
                                           <div class="col-md-2">
                                              <label  for="">Selling Price:</label>
                                           </div>
                                           <div class="col-md-4">
                                               <input value="<?php echo $selling_price ?>" name="sp"  min="1" type="number" class="form-control" required>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                           <div class="col-md-2">
                                              <label for="">Quantity:</label>
                                           </div>
                                           <div class="col-md-4">
                                             <input value="<?php echo $quantity ?>" name="qty"  min="1" type="number" class="form-control" required>
                                           </div>
                                           <div class="col-md-2">
                                              <label for="">Shop:</label>
                                           </div>
                                           <div class="col-md-4">
                                               <select name="shop" class="form-control" id="sel1">
                                                      <option value="<?php echo $shop ?>"><?php echo $shop ?></option>
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
                                             <label for="date">Date</label>
                                             <input hidden value="<?php echo $date_bought ?>" name="date_bought" class="form-control" type="date" required>
                                             <input disabled value="<?php echo $date_bought ?>" name="date_bought" class="form-control" type="date" required>
                                          </div>
                                           <div class="col-md-2">
                                              <label for="">Description:</label>
                                           </div>
                                           <div class="col-md-6">
                                                 <input value="<?php echo $description ?>" name="description" class="form-control"  id="comment">
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                           <button name="pointmedEdit" id="" type="submit" style="width: 100%;" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                
                                </form> 
                         </div>
                    </div>
                </div>
                <div class="col-md-3">
                   
                </div>
            </div>

        </div>
        <?php include '../../required/footer.php' ?>
    </div>
    <?php include 'modal.php'; ?>
</body>
</html>