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
    <script type="text/javascript">
        function add_row()
        {
         //   $point = $_SESSION['point'];
            $rowno=$("#order_product_table tr").length;
            $rowno=$rowno+1;
            $("#order_product_table tr:last").after("<tr id='row"+$rowno+"'><td><input class='form-control' type='text' name='product[]' placeholder='Product Name'></td><td> <select name='type[]' class='form-control' id='sel1' required> <option value='Kilogram'>Kilogram</option><option value='Pieces'>Pieces</option><option value='Litre'>Litre</option><option value='Packets'>Packets</option> <option value='Dozen'>Dozen</option><option value='Caton'>Caton</option> </select></td><td><input class='btn btn-danger btn-sm' type='button' value='Remove' onclick=delete_row('row"+$rowno+"')></td></tr>");



        }
        function delete_row(rowno)
        {
            $('#'+rowno).remove();
        }
    </script>
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
            <div class="col-md-3"> </div>
            <div class="col-md-6"> 
                <div class="card" >
                    <div class="card-header bg-success text-white"><?php echo $_SESSION['point'] ?> | Request Product</div>
                    <div class="card-body">
                       <div id="wrapper">

                            <div id="form_div">
                            <form method="post" action="../../required/controller.php">
                            <table class="table hover" id="order_product_table" align=center>
                                <tr id="row1">
                                    <td>
                                        <input class="form-control" type="text" name="product[]" placeholder="Product Name">
                                        <input hidden class="form-control" type="text" name="point" value="<?php echo $_SESSION['point'] ?>">
                                    </td>
                                    <td>
                                          <select name="type[]" class="form-control" id="sel1" required>
                                                <option value="Kilogram">Kilogram</option>
                                                <option value="Pieces">Pieces</option>
                                                <option value="Litre">Litre</option>
                                                <option value="Packets">Packets</option>
                                                <option value="Dozen">Dozen</option>
                                                <option value="Caton">Caton</option> 
                                            </select>
                                    </td>
                                </tr>
                            </table>
                            <input type="button" class='btn btn-primary' onclick="add_row();" value="Add Product">
                            <input type="submit" class='btn btn-success' name="place_order_btn" value="Place an Order">
                            </form>
                            </div>

                            </div>
                        </div>
                </div>
            </div> 
            <div class="col-md-3"> </div> 
         </div>
    <?php include 'modal.php' ?>
    <?php include '../../required/footer.php' ?>
</div>
  
</body>
</html>
<script>
   $(".dataTable").DataTable();
</script>


