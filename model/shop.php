<?php

class Shop extends DatabaseConnection{
    
    public function Auth(){
        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
       
        $_SESSION["username"] = $username;
        if($stmt->rowCount()){
            while($row = $stmt->fetch()){           
                $role = $row['role'];
                $_SESSION["role"] = $role;
                $_SESSION["point"] = $row['shop_point'];
                echo $role;
        }
       
        }else{
                   
            echo '
                    <div class="text-center alert alert-danger alert-dismissible" style="margin-top: 10px" >
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h6>Wrong username or password !!</h6>
                    </div>
                  ';

        }
       
    
    }

    public function AddProduct(){
        $product     = $_POST['product'];
        $type         = $_POST['type'];
        $expiredate   = $_POST['expiredate'];
        $bp           = $_POST['bp'];
        $sp           = $_POST['sp'];
        $qty          = $_POST['qty'];
        $shop         = $_POST['shop'];
        $description  = $_POST['description'];
        $date_bought  = $_POST['date_bought'];
        $total_bp     = $bp * $qty;
        $total_sp     = $sp * $qty;
        
        $CHECKMED = $this->connect()->prepare("SELECT * FROM product_store WHERE product_name = ? AND product_type = ? AND shop = ?");
        $CHECKMED->execute([$product, $type,$shop]);

        if($CHECKMED->rowCount()){
            while($row = $CHECKMED->fetch()){           
                $quantity = $row['quantity'];
                $newQty = $quantity + $qty;
                $total_bp     = $bp * $newQty;
                $total_sp     = $sp * $newQty;
                $stmt = $this->connect()->prepare("INSERT INTO invoice (product,type,qty,point,description,date_invoiced,buying_price,selling_price) VALUES(?,?,?,?,?,?,?,?)");
                $stmt->execute([$product, $type,$qty,$shop, $description,$date_bought, $bp,$sp,]);
                $stmt = $this->connect()->prepare("UPDATE product_store SET product_name = ?,product_type = ?,buying_price = ?,description = ?,selling_price = ?,shop = ?,quantity = ?,date_bought = ? ,total_selling = ?,total_buying = ?,expiredate = ?  WHERE product_id = $product_id");
                $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$qty, $date_bought,$total_sp,$total_bp,$expiredate]);
                echo '
                        Product Added successfully!
                    ';
            }
       
        }else{

            $stmt = $this->connect()->prepare("INSERT INTO product_store (product_name,product_type,buying_price,description,selling_price,shop,quantity,date_bought,total_selling,total_buying,expiredate) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$qty, $date_bought,$total_sp,$total_bp,$expiredate]);
            
            $stmt = $this->connect()->prepare("INSERT INTO invoice (product,type,qty,point,description,date_invoiced,buying_price,selling_price) VALUES(?,?,?,?,?,?,?,?)");
            $stmt->execute([$product, $type,$qty,$shop, $description,$date_bought, $bp,$sp,]);
            
            echo '
                  Product Added successfully!
               ';
        }

        
        // $message="Product Added successfully!";
        // header("location: ../view/admin/addproduct.php?sms=$message");
    }
    public function UpdateProduct(){
        $product     = $_POST['product'];
        $type         = $_POST['type'];
        $expiredate   = $_POST['expiredate'];
        $bp           = $_POST['bp'];
        $sp           = $_POST['sp'];
        $qty          = $_POST['qty'];
        $shop         = $_POST['shop'];
        $description  = $_POST['description'];
        $date_bought  = $_POST['date_bought'];
        $product_id  = $_POST['product_id'];
        $total_bp     = $bp * $qty;
        $total_sp     = $sp * $qty;
        $stmt = $this->connect()->prepare("UPDATE product_store SET product_name = ?,product_type = ?,buying_price = ?,description = ?,selling_price = ?,shop = ?,quantity = ?,date_bought = ? ,total_selling = ?,total_buying = ?,expiredate = ? WHERE product_id = $product_id");
        $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$qty, $date_bought,$total_sp,$total_bp,$expiredate]);
        
        echo '
              Product Updated successfully!
           ';
        // $message="Product Added successfully!";
        // header("location: ../view/admin/addproduct.php?sms=$message");
    }

    public function productList(){

    date_default_timezone_set("Africa/Dar_es_Salaam");
    $date_of_today = date('Y-m-d'); 

    $stmt = $this->connect()->prepare("SELECT * FROM product_store WHERE date_bought = '$date_of_today'");
    $stmt->execute();
    $data = $stmt->fetchAll();
    foreach ($data as $PRODUCT) {
       echo "
                <tr>
                    <td>".$PRODUCT['product_name']."</td>
                    <td>".$PRODUCT['product_type']."</td>
                    <td>".$PRODUCT['selling_price']."</td>
                    <td>
                       <a title='Edit' href='productEdit.php?product=".$PRODUCT['product_id']."'   class='btn btn-warning '><i class='fas fa-edit'></i></a>
                       <a title='Delete' href='productDelete.php?product=".$PRODUCT['product_id']."'   class='btn btn-danger '><i class='fas fa-trash'></i></a>
                    </td>
                </tr>
       ";
    }
}
    public function optionData(){

    $stmt = $this->connect()->prepare("SELECT * FROM shop_point");
    $stmt->execute();
    $data = $stmt->fetchAll();
    foreach ($data as $shop) {
        $option = $shop['name'];
       echo "
              <option value='".$option."'>".$option."</option>
            ";
    }
}

  public function addshop(){
      $point = $_POST['point'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];

      $stmt = $this->connect()->prepare("INSERT INTO shop_point (name,phone,address) VALUES(?,?,?)");
      $stmt->execute([$point, $phone,$address]);
      echo"New Shop added successfully";
  }

  public function updateShop(){
      $update_id = $_POST['update_id'];
      $name     = $_POST['name'];
      $phone     = $_POST['phone'];
      $address   = $_POST['address'];

      $stmt = $this->connect()->prepare("UPDATE shop_point SET name = ?,phone = ?,address = ? WHERE shop_id = $update_id");
      $stmt->execute([$name,$phone,$address]);
      echo'  
        <div class="text-center alert alert-success alert-dismissible" style="margin-top: 2px" >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6>Shop Point Updated successfully !!</h6>
        </div>
      ';
  }

  public function autocomplete(){
    $product_name = $_GET['product'];
    $stmt = $this->connect()->prepare("SELECT product_name as name FROM product_store WHERE product_name LIKE '%$product_name%'");
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    return response()->json($data);
  }

  public function autoProduct(){
    $product_name = $_POST['query'];
    if($product_name != ""){
      
        
        $stmt = $this->connect()->prepare("SELECT product_name FROM product_store WHERE product_name LIKE '%$product_name%'");
        $stmt->execute();
        $data = $stmt->fetchAll();

        $output = '<ul class="dropdown-menu" style="display:block; position: relative">';

        foreach($data as $row)
        {
            $output .= '<li id="li_product"><a >'.$row['product_name'].'</a><li>';
           
        }
        $output .= '</ul>';
        echo $output;
    }

  }
public function addUser(){
    $username = $_POST['username'];
    $role = $_POST['role'];
    $shop = $_POST['shop'];
    $password = $_POST['password'];
    $confirmpass = $_POST['confirmpass'];

    if ($password == $confirmpass) {
        $Adduser = $this->connect()->prepare("INSERT INTO users (password,shop_point,role,username) VALUES(?,?,?,?)");
        $Adduser->execute([$password, $shop,$role,$username]);

       echo '<div style="width: 100%" class="alert alert-success alert-dismissible" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                     New User Added.
                </div>';
    }else {
        echo '<div style="width: 100%" class="alert alert-danger alert-dismissible" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                     Password Does not Match.
                </div>';
    }
    
}

public function shopPointProduct(){
    session_start();
    $point = $_SESSION['point'];
    $stmt = $this->connect()->prepare("SELECT * FROM product_store WHERE shop = '$point' AND quantity > 0");
    $stmt->execute();
    $data = $stmt->fetchAll();
    foreach ($data as $product) {
        
        echo '<tr>
                <td>'.$product['product_name'].'</td>
                <td>'.$product['product_type'].'</td>
                <td>'.$product['selling_price'].'</td>
                <td>'.$product['quantity'].'</td>
                <td><button type='.$product['product_type'].' ava_qty = '.$product['quantity'].'  product='.$product['product_name'].' price='.$product['selling_price'].' pid='.$product['product_id'].' style="float:right;" class="btn btn-info btn-xs selectProduct">Add</button></td>
               </tr> 
            ';
    }
   
}
public function invoiced(){
    session_start();
    $shop = $_SESSION['point'];
    $stmt = $this->connect()->prepare("SELECT * FROM cart WHERE shop = '$shop'");
    $stmt->execute();

   
    if ($stmt->rowCount()) {
        $total_price = $this->connect()->prepare("SELECT SUM(total) as selling FROM cart");
        $total_price->execute();
        $data4 = $total_price->fetchAll();
        
        foreach ($data4 as $price) {
        
           $total = $price['selling'];
          # code...
        }

        $data = $stmt->fetchAll();
        foreach ($data as $product) {
            $pid = $product['pid'];
            $medic = $product['product'];
            $price = $product['price'];
            $type = $product['type'];
            $shop = $product['shop'];
            $qty = $product['qty'];
            $ava_qty = $product['ava_qty'];
            $total_price = $product['total'];
        echo "
            <div class='row' style='margin-right: 5px'>
                 <input type='text' class='form-control ava_qty' id='ava_qty-$pid' value='$ava_qty' hidden>
                 <input type='text' class='form-control ava_qty' id='shop-$pid' value='$shop' hidden>
                 <input type='text' class='form-control ava_qty' id='type-$pid' value='$type' hidden>
                <div class='col-md-3'><input type='text' class='form-control product' id='product-$pid' value='$medic' disabled></div>
                <div class='col-md-2'><input min='1' type='number' class='form-control  qty_cart_qty' pid_cart='$pid' id='qty_select-$pid' value='$qty'></div>
                <div class='col-md-2'><input type='text' class='form-control price'  id='price-$pid' value='$price' disabled></div>
                <div class='col-md-3'><input type='text' class='form-control total' id='total-$pid' value='$total_price' disabled></div>
                <div class='col-md-2'>
                    <div class='btn-group'>
                            <a href='' update_cart_id='$pid' title='update' class='btn btn-primary update_cart'><i class='fa  fa-refresh'></i></a>
                            <a href='#' remove_from_cart_id='$pid' title='Remove' class='btn btn-danger removedFromCart'><i class='fa fa-trash'></i></a>
                    </div>
                </div>   
            </div>
             ";
        }
        $todayDate = date("Y-m-d");
        echo '
                <br>
                <div class="row" style="">
                    <input name="todayDate" value ='.$todayDate.' type="text" hidden>
                <div class="col-md-8">Total Price: '.$total.'</div>
                <div class="col-md-4"> <button  style="float:left;width: 90%" class="btn btn-success btn-xs sellProduct">Sell</button></div>
                    
                </div>   
        ';
    }
    
}
public function selectProduct(){
    session_start();
    $pid = $_POST['pid'];
    $price = $_POST['price'];
    $product = $_POST['product'];
    $ava_qty = $_POST['ava_qty'];
    $shop = $_SESSION['point'];
    $type = $_POST['type'];

    $stmt = $this->connect()->prepare("SELECT * FROM cart WHERE pid = $pid");
    $stmt->execute();
   
    if ($stmt->rowCount()) {
        echo '
        <div style="width: 100%" class="alert alert-danger alert-dismissible" >
               <button type="button" class="close" data-dismiss="alert">&times;</button>
                This Product already added !!.
        </div>
          ';
    }else{
        $todayDate = date("Y-m-d");
        $insert_cart = $this->connect()->prepare("INSERT INTO cart (pid,product,price,qty,ava_qty,total,shop,type,insured_date) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert_cart->execute([$pid, $product,$price,1,$ava_qty,$price,$shop,$type,$todayDate]);
    
        echo '
                 <div style="width: 100%" class="alert alert-info alert-dismissible" >
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                         Product Added into invoice !!.
                    </div>
        ';
    }

   
}

public function update_cart(){
    $pid = $_POST['update_cart_id'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $ava_qty = $_POST['ava_qty'];
    if ($qty>$ava_qty) {
        echo'  
        <div class="text-center alert alert-danger alert-dismissible" style="margin-top: 2px;width: 100%" >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6>You have Entered large   Quantity  !!</h6>
        </div>
   ';
    } else {
       
    $stmt = $this->connect()->prepare("UPDATE cart SET qty = ?,total=? WHERE pid = $pid");
    $stmt->execute([$qty,$total]);
   echo'  
     <div class="text-center alert alert-info alert-dismissible" style="margin-top: 2px;width: 100%" >
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <h6>Quantity updated !!</h6>
     </div>
   ';
    }
    
}
public function changePass(){
    $user_id = $_POST['user_id'];
    $oldPassword = $_POST['oldPassword'];
    $c_oldPassword = $_POST['c_oldPassword'];
    $newpassword = $_POST['newpassword'];
    $cnewpassword = $_POST['cnewpassword'];
    
    if ($oldPassword != $c_oldPassword) {
        echo'  
        <div class="text-center alert alert-danger alert-dismissible" style="margin-top: 2px;width: 100%" >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6>Wrong old password !!</h6>
        </div>
      ';
    }elseif ($newpassword != $cnewpassword) {
        echo'  
        <div class="text-center alert alert-danger alert-dismissible" style="margin-top: 2px;width: 100%" >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6>New password does not match !!</h6>
        </div>
      ';
    }else {
            $stmt = $this->connect()->prepare("UPDATE users SET password = ? WHERE user_id = ?");
           $stmt->execute([$newpassword,$user_id]);
           echo'  
                <div class="text-center alert alert-info alert-dismissible" style="margin-top: 2px;width: 100%" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Password changed !!</h4>
                </div>
            ';
    }
  
}
public function removedFromCart(){
     $pid = $_POST['remove_from_cart_id'];

    $stmt = $this->connect()->prepare("DELETE FROM cart WHERE pid = ?");
    $stmt->execute([$pid]);

    echo'  
    <div class="text-center alert alert-info alert-dismissible" style="margin-top: 2px;width: 95%" >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h6>Product Removed !!</h6>
    </div>
  ';
}

public function sellProduct(){
    session_start();
    $shop = $_SESSION['point'];
    $stmt = $this->connect()->prepare("SELECT * FROM cart WHERE shop = '$shop'");
    $stmt->execute();

    $last_insue_no= $this->connect()->prepare("SELECT *  FROM issue ORDER BY issue_id DESC LIMIT 1");
    $last_insue_no->execute();
    if ($last_insue_no->rowCount()) {
        while($row = $last_insue_no->fetch()){
            $num = $row['insue_no'];
            $insue_no = $num + 1;
        }
         
    } else {
        $insue_no = 100;
    }
    
    $data = $stmt->fetchAll();
    
    if ($stmt->rowCount()) {
        foreach ($data as $cart) {
           $pid = $cart['pid'];
           $product = $cart['product'];
           $type = $cart['type'];
           $date_issued = $cart['insured_date'];
           $price = $cart['price'];
           $totalSelling = $cart['total'];
           $qty = $cart['qty'];
           $shop = $cart['shop'];
           
            $insert_issue = $this->connect()->prepare("INSERT INTO issue (product,type,date_issued,qty,price,shop,totalSelling,insue_no,pid) VALUES(?,?,?,?,?,?,?,?,?)");
            $insert_issue->execute([$product, $type,$date_issued,$qty,$price,$shop,$totalSelling,$insue_no,$pid]);

            $last_details= $this->connect()->prepare("SELECT *  FROM product_store WHERE product_id = $pid");
            $last_details->execute();
            if ($last_details->rowCount()) {
                while($row2 = $last_details->fetch()){
                    $sprice = $row2['selling_price'];
                    $bprice = $row2['buying_price'];
                    $old_qty = $row2['quantity'];
                }
                
            }
            $newQty = $old_qty - $qty;
            $newTbp = $bprice * $newQty;
            $newTsp = $sprice * $newQty;
            $stmt = $this->connect()->prepare("UPDATE product_store SET quantity = ?,total_buying = ?,total_selling = ? WHERE product_id = $pid");
            $stmt->execute([$newQty,$newTbp,$newTsp]);

            $delete_stmt = $this->connect()->prepare("DELETE FROM cart WHERE pid = ?");
            $delete_stmt->execute([$pid]);
        }

        echo '<a style="float: right; margin-bottom: 10px" href="invoicedoc.php?doc_id='.$insue_no.'" class="btn btn-sm btn-primary"><i class="fa fa-print"><i>Get Sell Report</a>';
    }
}

public function item_level_update(){
    $product_update_id = $_POST['product_update_id'];
   
    $product_type = $_POST['product_type'];
    $product_name = $_POST['product_name'];
   
    $buying_price = $_POST['buying_price'];
    $selling_price = $_POST['selling_price'];
    $quantity = $_POST['quantity'];
    $newTbp = $buying_price * $quantity;
    $newTsp = $selling_price * $quantity;

    $stmt = $this->connect()->prepare("UPDATE product_store SET product_name = ?,product_type = ?,buying_price = ?,selling_price = ?,quantity = ?,total_buying = ?,total_selling = ? WHERE product_id = $product_update_id");
    $stmt->execute([$product_name,$product_type,$buying_price,$selling_price,$quantity,$newTbp,$newTsp]);

    echo'  
        <div class="text-center alert alert-success alert-dismissible" style="margin-top: 2px;width: 95%" >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6>Product Updated !!</h6>
        </div>
  ';
}
public function AllUsers(){

    $stmt = $this->connect()->prepare("SELECT * FROM users ");
    $stmt->execute();

    $data = $stmt->fetchAll();
    foreach ($data as $info) {
       echo "
                <tr>
                    <td id='user_username".$info['user_id']."' contenteditable>".$info['username']."</td>
                    <td id='user_role".$info['user_id']."' contenteditable>".$info['role']."</td>
                    <td id='user_shop".$info['user_id']."' contenteditable>".$info['shop_point']."</td>
                    <td>
                        <div class='btn-group'>
                         <button title='update'   user_update_id=".$info['user_id']." class='btn btn-primary  user_update'><i class='fa fa-check'></i></button>
                         <button title='Reset'   user_reset_id=".$info['user_id']." user_username=".$info['username']." class='btn btn-warning  user_reset'><i class='fa fa-refresh'></i></button>
                         <button title='Delete'  user_delete_id=".$info['user_id']." class='btn btn-danger  user_delete'><i class='fa fa-trash'></i></button>
                        </div>
                    </td>
                         
                 </tr>   
                ";

    }
}
public function user_update(){
$user_update_id = $_POST['user_update_id'];
$user_username = $_POST['user_username'];
$user_shop = $_POST['user_shop'];
$user_role = $_POST['user_role'];

$update = $this->connect()->prepare("UPDATE users SET username = '$user_username',shop_point = '$user_shop',role = '$user_role' WHERE user_id = $user_update_id");
$update->execute(); 
echo '
        User updated !!.
    ';
}
public function user_reset(){
$user_reset_id = $_POST['user_reset_id'];
$user_username = $_POST['user_username'];

$update = $this->connect()->prepare("UPDATE users SET password = '$user_username' WHERE user_id = $user_reset_id");
$update->execute(); 
echo '
           Password Reseted !!.
    ';
}
public function user_delete(){
$user_delete_id = $_POST['user_delete_id'];

$DELETE = $this->connect()->prepare("DELETE FROM users  WHERE user_id = $user_delete_id");
$DELETE->execute(); 
echo '
         User Deleted !!.
    ';
}
public function product_delete(){
$product_delete_id = $_POST['product_delete_id'];

$DELETE = $this->connect()->prepare("DELETE FROM product_store  WHERE product_id = $product_delete_id");
$DELETE->execute(); 
echo '
         Product Deleted !!.
    ';
}

public function pointmedEdit(){
    $product     = $_POST['product'];
    $type         = $_POST['type'];
    $bp           = $_POST['bp'];
    $sp           = $_POST['sp'];
    $qty          = $_POST['qty'];
    $shop     = $_POST['shop'];
    $description  = $_POST['description'];
    $date_bought  = $_POST['date_bought'];
    $product_id  = $_POST['product_id'];
    $total_bp     = $bp * $qty;
    $total_sp     = $sp * $qty;
    $stmt = $this->connect()->prepare("UPDATE product_store SET product_name = ?,product_type = ?,buying_price = ?,description = ?,selling_price = ?,shop = ?,quantity = ?,date_bought = ? ,total_selling = ?,total_buying = ?  WHERE product_id = $product_id");
    $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$qty, $date_bought,$total_sp,$total_bp]);
    
   
    header("location: ../view/admin/points.php?point=$shop");
}
public function place_orde(){
    $product=$_POST['product'];
    $point=$_POST['point'];
    $type=$_POST['type'];
    for($i=0;$i<count($product);$i++)
    {
    if($product[$i]!="" && $point[$i]!="" && $type[$i]!="")
    {
        $insert_order = $this->connect()->prepare("INSERT INTO ordering (product,type,shop,status) VALUES(?,?,?,?)");
        $insert_order->execute([$product[$i],$type[$i],$point,'new']);	 
    }
    }

    
      header("location: ../view/shopkeeper/");
}
public function delete_request(){
$request_id = $_POST['request_id'];

$DELETE = $this->connect()->prepare("DELETE FROM ordering  WHERE order_id = $request_id");
$DELETE->execute(); 
echo '
         Request Deleted !!.
    ';
}
public function sellReport(){
        $from    = $_POST['start'];
        $to      = $_POST['end'];
        $point   = $_POST['point'];
        header("location: ../required/sellreport.php?start=$from&end=$to&point=$point");
}

public function transferProduct(){
    $product     = $_POST['product'];
    $type         = $_POST['type'];
    $bp           = $_POST['bp'];
    $sp           = $_POST['sp'];
    $qty          = $_POST['qty'];
    $shop     = $_POST['shop'];
    $description  = $_POST['description'];
    $date_bought  = $_POST['date_bought'];
    $product_id  = $_POST['product_id'];
    $total_bp     = $bp * $qty;
    $total_sp     = $sp * $qty;
    $expiredate   = $_POST['expiredate'];
        $CHECKMED = $this->connect()->prepare("SELECT * FROM product_store WHERE product_name = ? AND product_type = ? AND shop = ?");
        $CHECKMED->execute([$product, $type,$shop]);
       
        $CHECKMEDPRE = $this->connect()->prepare("SELECT * FROM product_store WHERE product_id = ?");
        $CHECKMEDPRE->execute([$product_id]);
        foreach ($CHECKMEDPRE as $value) {
            $pre_qty = $value['quantity'];
   }
        if($CHECKMED->rowCount()){
            while($row = $CHECKMED->fetch()){           
                $quantity = $row['quantity'];
                $med_id = $row['product_id'];
                $newQty = $quantity + $qty;
                $total_bp     = $bp * $newQty;
                $total_sp     = $sp * $newQty;
            }
                // $stmt = $this->connect()->prepare("INSERT INTO invoice (product,type,qty,point,description,date_invoiced,buying_price,selling_price) VALUES(?,?,?,?,?,?,?,?)");
                // $stmt->execute([$product, $type,$qty,$shop, $description,$date_bought, $bp,$sp,]);
                if ($pre_qty == $qty) {
                    $stmt = $this->connect()->prepare("UPDATE product_store SET product_name = ?,product_type = ?,buying_price = ?,description = ?,selling_price = ?,shop = ?,quantity = ?,date_bought = ? ,total_selling = ?,total_buying = ?,expiredate = ?  WHERE product_id = $product_id");
                    $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$qty, $date_bought,$total_sp,$total_bp,$expiredate]);
                    $DELETE = $this->connect()->prepare("DELETE FROM product_store  WHERE product_id = $product_id");
                    $DELETE->execute(); 
                } else if($pre_qty > $qty) {
                    $stmt = $this->connect()->prepare("UPDATE product_store SET product_name = ?,product_type = ?,buying_price = ?,description = ?,selling_price = ?,shop = ?,quantity = ?,date_bought = ? ,total_selling = ?,total_buying = ?,expiredate = ?  WHERE product_id = $med_id");
                    $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$newQty, $date_bought,$total_sp,$total_bp,$expiredate]);
                    $getQty = $pre_qty - $qty;
                    $stmt = $this->connect()->prepare("UPDATE product_store SET quantity = ? WHERE product_id = $product_id");
                    $stmt->execute([$getQty]);
                    
                }
               
            header("location: ../view/admin/transfer.php?point=$shop");
        }else{
            if ($pre_qty == $qty) {
            $stmt = $this->connect()->prepare("UPDATE product_store SET product_name = ?,product_type = ?,buying_price = ?,description = ?,selling_price = ?,shop = ?,quantity = ?,date_bought = ? ,total_selling = ?,total_buying = ?  WHERE product_id = $product_id");
            $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$qty, $date_bought,$total_sp,$total_bp]);
            }else {
                $stmt = $this->connect()->prepare("INSERT INTO product_store (product_name,product_type,buying_price,description,selling_price,shop,quantity,date_bought,total_selling,total_buying,expiredate) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->execute([$product, $type,$bp, $description,$sp, $shop,$qty, $date_bought,$total_sp,$total_bp,$expiredate]);
                $getQty = $pre_qty - $qty;
                $stmt = $this->connect()->prepare("UPDATE product_store SET quantity = ? WHERE product_id = $product_id");
                $stmt->execute([$getQty]);
            }

            // $stmt = $this->connect()->prepare("INSERT INTO invoice (product,type,qty,point,description,date_invoiced,buying_price,selling_price) VALUES(?,?,?,?,?,?,?,?)");
            // $stmt->execute([$product, $type,$qty,$shop, $description,$date_bought, $bp,$sp,]);
            header("location: ../view/admin/transfer.php?point=$shop");
        }
   
    
}
}//end of Action class