<?php 
include '../../required/session.php';
include '../../model/database.php';
include '../../model/shop.php';
$shop = new Shop;
$dBcONNECT = new DatabaseConnection;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include '../../required/links.php'  ?>
    <title>Shop | ShopKeeper</title>
</head>
<body class="">
  <!-- header -->
  <?php require '../../required/header.php' ?>
  <!-- end of header -->

  <!-- nav  tambuka reli-->
  <?php require '../../required/navi.php' ?>
  <!-- end of nav -->
    
  <div class="" style="">
    
    <div class="text-center" style="">
         <!-- <h1>NOT YET STILL IN PROGRESS</h1>
         <h5>selling product</h5>
         <h5>searching product </h5>
         <h5>priting invoice</h5>
         <h5>sending request to admin for new product</h5>
         <h5>.......other suggetions........</h5> -->
         <div class="row">
            <div class="col-md-6">
              <div class="card" >
                  <div class="card-header bg-success text-white"><?php echo $_SESSION['point'] ?> Informatics Shop </div>
                  <div class="card-body">
                         <div class="row" id="invoice_message"></div>
                        <div class="table-responsive">
                          <table class="table table-bordered dataTable table-sm" id="dataTable" cellspacing="0">
                            <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Type</th>
                                  <th>Price</th>
                                  <th>qty</th>
                                  <th>Select</th>
                              </tr>
                            </thead>
                          
                            <tbody id="sellProduct_list">
                             
                            </tbody>
                          </table>
                    </div>
                      
                  </div>
              </div>
            </div>
            <div class="col-md-6" id="">
              <div class="row" id="cart_msg"></div>
            <div class="alert alert-success text-center" style="width: 95%;">
               Receipt check out.
            </div> 
               <div class="row" style='margin-right: 5px'>
                    <div class="col-md-3"><b>Product</b></div>
                    <div class="col-md-2"><b>Qty</b></div>
                    <div class="col-md-2"><b>Price</b></div>
                    <div class="col-md-3"><b>Total</b></div>
                    <div class="col-md-2"><b>Action</b></div>
                </div>
                <br />

                <div id="invoiced"></div>
                
            </div>
         
         
    </div>
    <?php include 'modal.php' ?>
    <?php include '../../required/footer.php' ?>
</div>
  
</body>
</html>
<script>
   $(".dataTable").DataTable();
</script>

<!-- <form >
                            <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4"><label for="name">Product Name</label></div>
                                  <div class="col-sm-8"> <input type="text" name="product" class="form-control autoProduct" id="autoProduct">
                                      <div id="product_auto"></div>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4"><label for="name">Type</label></div>
                                  <div class="col-sm-8"><input name="Type" type="text" class="form-control"></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4"><label for="name">Selling Price</label></div>
                                  <div class="col-sm-8"><input disabled name="price" type="number" class="form-control"></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4"><label for="name">Quatity</label></div>
                                  <div class="col-sm-8"><input name="address" type="number" class="form-control"></div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6"></div>
                              <div class="col-md-6"><button style="width: 100%;" id="" class="btn btn-primary">Save</button></div>
                            </div>
                        </form> -->