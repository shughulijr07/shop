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
                <li class="breadcrumb-item active">Shop Points</li>
                <li class="breadcrumb-item">
                    <a href="" data-toggle="modal" data-target="#changePassword">Change Password</a>
                </li>
            </ol>

            <div class="row">
                
                <div class="col-md-1">
                    
                </div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">Shop Points | Update | Delete</div>
                        <div class="card-body">
                          <div class="row" id="successUpdate"></div>
                            <table class="table table-striped table-hover table-condensed " id="dataTables">
                                <thead>
                                <tr>
                                    <th class="text-primary">Shop Point</th>
                                    <th class="text-primary">Phone</th>
                                    <th class="text-primary">Address</th>
                                    <th class="text-primary">Date</th>
                                    <th class="text-primary">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                                  <?php foreach ($data1 as $shop) { ?>
                                                  <tr>
                                                       <td id="name<?php echo $shop['shop_id'] ?>" contenteditable><?php echo $shop['name'] ?></td> 
                                                       <td id="phone<?php echo $shop['shop_id'] ?>" contenteditable><?php echo $shop['phone'] ?></td> 
                                                       <td id="address<?php echo $shop['shop_id'] ?>" contenteditable><?php echo $shop['address'] ?></td> 
                                                       <td><?php echo $shop['date_inserted'] ?></td>
                                                       <td>
                                                           <a id="updatePharmacy" title='Update' update_id = '<?php echo $shop['shop_id'] ?>' class='btn btn-success updatePharmacy'><i class='fas fa-check'></i></a>
                                                           <a title='Delete' href="shop_delete.php?delete_id=<?php echo $shop['shop_id'] ?>&shop=<?php echo $shop['name'] ?>" class='btn btn-danger '><i class='fas fa-trash'></i></a>
                                                           <!-- <a title='Delete' delete_id = ''  class='btn btn-danger '><i class='fas fa-trash'></i></a> -->
                                                       </td> 
                                                  </tr>
                                                  <?php //echo $shop['shop_id']  ?>
                                                  <?php } ?>
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-1"> </div>
            </div>

        </div>
        <?php include '../../required/footer.php' ?>
    </div>
    <?php include 'modal.php'; ?>
</body>
</html>
<script>
    $(".table").DataTable();
</script>
<script src="../../dataTable/js/dataTables.bootstrap4.min.js"></script>
<script src="../../dataTable/js/jquery.dataTables.min.js"></script>
<script src="../../dataTable/js/jquery.js"></script>