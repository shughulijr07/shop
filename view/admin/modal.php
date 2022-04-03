<!-- The Modal -->
<div class="modal fade " id="saleReportAdmin">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center text-white">Informatics Shop | Generate Sell Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="">
           <form class="" method="POST" action="../../required/controller.php">
              <div class="row">
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                 <label for="end">Shop Point</label>
                    <select name="point" class="form-control" id="sel1">
                           <?php
                                 foreach ($data1 as $shop) {
                                    $option = $shop['name'];
                                   echo "
                                          <option value='".$option."'>".$option."</option>
                                        ";
                                }
                           ?>
                    </select>
                    <label for="start">From Date</label>
                      <input name="start" type="date" class="form-control" >

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

<!-- The Modal of adding new shop Point -->

<div class="modal" id="addShop">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-success text-white">
        <h4 class="modal-title">Adding new Shop</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form >
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Shop Point</label></div>
                    <div class="col-sm-8"><input name="newpoint" type="text" class="form-control"></div>
                 </div>
              </div>
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Telephone #</label></div>
                    <div class="col-sm-8"><input name="phone" type="number" class="form-control"></div>
                 </div>
              </div>
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Address</label></div>
                    <div class="col-sm-8"><input name="address" type="text" class="form-control"></div>
                 </div>
              </div>
              <div class="row">
                 <div class="col-md-6"></div>
                 <div class="col-md-6"><button style="width: 100%;"  class="btn btn-primary addshop">Save</button></div>
              </div>
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button  type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- end of shop point -->
<?php
  $username = $_SESSION['username'];
  $changepass = $dBcONNECT->connect()->prepare("SELECT * FROM users where username = '$username'");
  $changepass->execute();
  $change = $changepass->fetchAll();
  foreach ($change as $value) {
     $user_id  = $value['user_id'];
     $old_pass = $value['password'];
  }
?>
<!-- The Modal of adding new shopkeeper -->
<div class="modal" id="changePassword">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-danger text-white">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form >
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Enter Old Password</label></div>
                    <div class="col-sm-8"><input name="oldPassword" type="password" class="form-control"></div>
                    <div class="col-sm-8"><input hidden value="<?php echo $old_pass ?>" name="c_oldPassword" type="password" class="form-control"></div>
                    <div class="col-sm-8"><input hidden name="user_id" value="<?php echo $user_id ?>" type="number" class="form-control"></div>
                 </div>
              </div>
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Enter new Password</label></div>
                    <div class="col-sm-8"><input name="newpassword" type="password" class="form-control"></div>
                 </div>
              </div>
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Confirm</label></div>
                    <div class="col-sm-8"><input name="cnewpassword" type="password" class="form-control"></div>
                 </div>
              </div>
              <div class="row" id="change_pass_msg"></div>
              <div class="row">
                 <div class="col-md-6" >
                 </div>
                 <div class="col-md-6"><button style="width: 100%;" id="changePass" class="btn btn-warning changePass">Change Password</button></div>
              </div>
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button  type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- end of shopkeeper -->

<!-- The Modal of adding new User-->
<div class="modal" id="addUser">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-success text-white">
        <h4 class="modal-title">Adding new User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form >
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Username</label></div>
                    <div class="col-sm-8"><input name="usern" type="text" class="form-control"></div>
                 </div>
              </div>
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Role</label></div>
                    <div class="col-sm-8">
                        <select name="role" class="form-control" id="sel1">
                            <option value="shopkeeper">ShopKeeper</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                 </div>
              </div>
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Shop Point</label></div>
                    <div class="col-sm-8">
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
                    <div class="col-sm-4"><label for="name">Password</label></div>
                    <div class="col-sm-8"><input name="pass" type="password" class="form-control"></div>
                 </div>
              </div>
              <div class="form-group">
                 <div class="row">
                    <div class="col-sm-4"><label for="name">Confirm Password</label></div>
                    <div class="col-sm-8"><input name="confirmpass" type="password" class="form-control"></div>
                 </div>
              </div>
              <div class="row text-center" id="userError" ></div>
              <div class="row">
                 <div class="col-md-6" >   
                 </div>
                 <div class="col-md-6"><button style="width: 100%;" id="" class="btn btn-primary addUser">Save</button></div>
              </div>
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button  type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- end of shop point -->