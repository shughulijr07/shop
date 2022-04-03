$(document).ready(function() {
  product();
  option();
  invoiced();
  shopPointProduct();

$("#login_btn").click(function(event){
    event.preventDefault();
    var username  = $("input[name=username]").val();
    var password  = $("input[name=password]").val();
    $.ajax({
        url     :  "required/controller.php",
        method  :  "POST",
        data    :  {login:1,username:username,password:password},
        success :   function(data){
            //alert(data);
          if(data == "shopkeeper"){
             window.location.href = "../view/shopkeeper/";
          }else if(data == "admin") {
            window.location.href = "view/admin/";
          //  $(".login_msg").html(data);
          }else{
           
               $("#login_sms").html(data );
          }
        }
      })
})
$(".item_level_update").click(function(event){
    event.preventDefault();
   // alert("get you");
    var product_update_id  = $(this).attr('product_update_id');
    var product_name =$("#product_name"+product_update_id).text();
    var product_type =$("#product_type"+product_update_id).text();
    var buying_price =$("#buying_price"+product_update_id).text();
    var selling_price =$("#selling_price"+product_update_id).text();
    var quantity =$("#quantity"+product_update_id).text();

    if (product_update_id !=""  && product_name !="" && product_type !=""  && buying_price !="" && selling_price !="" && quantity !="") {
        $.ajax({
          url     :  "../../required/controller.php",
          method  :  "POST",
          data    :  {item_level_update:1,product_update_id:product_update_id,product_name:product_name,product_type:product_type,
                      buying_price:buying_price,selling_price:selling_price,quantity:quantity
                     },
          success :   function(data){
              //alert(data);
              $("#successUpdate_product").html(data);
          }
        })
    } else {
        alert("All field are required !!");
    }
    
})
$(".updateShop").click(function(event){
    event.preventDefault();
   // alert("get you");
    var update_id  = $(this).attr('update_id');
    var name =$("#name"+update_id).text();
    var phone =$("#phone"+update_id).text();
    var address =$("#address"+update_id).text();

    if (name !="" && phone !="" && address !="") {
        $.ajax({
          url     :  "../../required/controller.php",
          method  :  "POST",
          data    :  {updateShop:1,update_id:update_id,name:name,phone:phone,address:address},
          success :   function(data){
              //alert(data);
              $("#successUpdate").html(data);
          }
        })
    } else {
        alert("All field are required !!");
    }
    
})

$("#Addproduct_btn").click(function(event){
    event.preventDefault();
   // alert("ok");
    var product    = $("input[name=product]").val();
    var type        = $("select[name=type]").val();
    var expiredate  = $("input[name=expiredate]").val();
    var sp          = $("input[name=sp]").val();
    var bp          = $("input[name=bp]").val();
    var qty         = $("input[name=qty]").val();
    var shop    = $("select[name=shop]").val();
    var description = $("textarea[name=description]").val();
    var date_bought = $("input[name=date_bought]").val();

  if (expiredate !="" && product != "" && type !="" && sp !="" && bp !="" && sp !="" && qty !="" && shop !="" && description !="" && date_bought !="") {
     if (bp < sp) {
      $.ajax({
        url     :  "../../required/controller.php",
        method  :  "POST",
        data    :  {addproduct:1,sp:sp,product:product,type:type,bp:bp,qty:qty,shop:shop,description:description,date_bought:date_bought,expiredate:expiredate},
        success :   function(data){
               alert(data);
               window.location.href = "addproduct.php";
        }
      })
     } else {
      alert("As the matter of profit Selling price must be greater than Buying price");
     }
    } else {
      alert("All field must be filled !!");
    }
  
})


$("#Updateproduct_btn").click(function(event){
    event.preventDefault();
   // alert("ok");
    var product    = $("input[name=product]").val();
    var expiredate    = $("input[name=expiredate]").val();
    var product_id    = $("input[name=product_id]").val();
    var type        = $("select[name=type]").val();
    var sp          = $("input[name=sp]").val();
    var bp          = $("input[name=bp]").val();
    var qty         = $("input[name=qty]").val();
    var shop    = $("select[name=shop]").val();
    var description = $("input[name=description]").val();
    var date_bought = $("input[name=date_bought]").val();

  if (expiredate !="" && product != "" && type !="" && sp !="" && bp !="" && sp !="" && qty !="" && shop !="" && description !="" && date_bought !="") {
      $.ajax({
        url     :  "../../required/controller.php",
        method  :  "POST",
        data    :  {updateProduct:1,product_id:product_id,sp:sp,product:product,type:type,bp:bp,qty:qty,shop:shop,description:description,date_bought:date_bought,expiredate:expiredate},
        success :   function(data){
               alert(data);
               window.location.href = "addproduct.php";
        }
      })
    } else {
      alert("Fill all Empty Space");
    }
    
   

})
$(".addshop").click(function(event){
    event.preventDefault();
  
    var point    = $("input[name=newpoint]").val();
    var phone    = $("input[name=phone]").val();
    var address  = $("input[name=address]").val();
   

  if (point != "" && phone !="" && address !="") {
      $.ajax({
        url     :  "../../required/controller.php",
        method  :  "POST",
        data    :  {addshop:1,point:point,phone:phone,address:address},
        success :   function(data){
               alert(data);
               window.location.href = "updateshop.php";
        }
      })
    } else {
      alert("Fill All Empty Space");
    }
  
})
$(".addUser").click(function(event){
    event.preventDefault();
  
    var username    = $("input[name=usern]").val();
    var role    = $("select[name=role]").val();
    var shop  = $("select[name=shop]").val();
    var password  = $("input[name=pass]").val();
    var confirmpass  = $("input[name=confirmpass]").val();

  if (username != "" && role !="" && shop !="" && password !="" && confirmpass !="") {
      $.ajax({
        url     :  "../../required/controller.php",
        method  :  "POST",
        data    :  {addUser:1,username:username,role:role,shop:shop,password:password,confirmpass:confirmpass},
        success :   function(data){
          $("#userError").html(data);
        }
      })
    } else {
      alert("Fill all Empty Space");
    }
  
})
  
function product(){
  $.ajax({
    url     :  "../../required/controller.php",
    method  :  "POST",
    data    :  {product_list:1},
    success :   function(data){
     
           $("#summary").html(data);
    
    }
  })
}
function shopPointProduct(){
  $.ajax({
    url     :  "../../required/controller.php",
    method  :  "POST",
    data    :  {shopPointProduct:1},
    success :   function(data){
     
           $("#sellProduct_list").html(data);
    
    }
  })
}
function invoiced(){
  $.ajax({
    url     :  "../../required/controller.php",
    method  :  "POST",
    data    :  {invoiced:1},
    success :   function(data){
     
           $("#invoiced").html(data);
    
    }
  })
}
function option(){
  $.ajax({
    url     :  "../../required/controller.php",
    method  :  "POST",
    data    :  {optionData:1},
    success :   function(data){
     
           $("#optionData").html(data);
    
    }
  })
}
  
        $('#autoProduct').keyup(function(){
          var query = $(this).val();
        
          if(query != ''){
             
            $.ajax({
              url: "../../required/controller.php",
              method: "POST",
              data: {autocomplete:1,query:query},
              success:function(data){
                $('#product_auto').fadeIn();
                $('#product_auto').html(data);
               
              }
            })
          }
      })
      $(document).on('click', '#li_product',function(){
           $('#autoProduct').val($(this).text());
           $('#product_auto').fadeOut();
      })

      $("body").delegate(".sellProduct","click", function(event){
        event.preventDefault();

        $.ajax({
            url:      "../../required/controller.php",
            method  :  "POST",
            data    :  {sellProduct:1},
            success :   function(data){
              $("#cart_msg").html(data);
              invoiced();
              shopPointProduct();
            }
          })
    })
      $("body").delegate(".changePass","click", function(event){
        event.preventDefault();
        var user_id    = $("input[name=user_id]").val();
        var oldPassword    = $("input[name=oldPassword]").val();
        var c_oldPassword    = $("input[name=c_oldPassword]").val();
        var newpassword  = $("input[name=newpassword]").val();
        var cnewpassword  = $("input[name=cnewpassword]").val();
        if (oldPassword != "" && c_oldPassword != "" && newpassword != "" && cnewpassword !="") {
          $.ajax({
            url:      "../../required/controller.php",
            method  :  "POST",
            data    :  {changePass:1,user_id:user_id,oldPassword:oldPassword,c_oldPassword:c_oldPassword,newpassword:newpassword,cnewpassword:cnewpassword},
            success :   function(data){
              $("#change_pass_msg").html(data);
            }
          })
        } else {
          alert("Fill all empty input !!");
        }
       
    })
      $("body").delegate(".selectProduct","click", function(event){
        event.preventDefault();
        var mid = $(this).attr('mid');
        var price = $(this).attr('price');
        var product = $(this).attr('product');
        var ava_qty = $(this).attr('ava_qty');
        var type = $(this).attr('type');
        
        $.ajax({
            url:      "../../required/controller.php",
            method  :  "POST",
            data    :  {selectProduct:1,mid:mid,product:product,price:price,ava_qty:ava_qty,type:type},
            success :   function(data){
              $("#invoice_message").html(data);
              invoiced();
            }
          })
    })

 
  $("body").delegate(".qty_cart_qty","keyup",function(event){
    event.preventDefault();
   // alert('ok');
      var mid = $(this).attr("mid_cart");
      
      var qty_select = $("#qty_select-"+mid).val();
      var price = $("#price-"+mid).val();
      var total = qty_select * price;
     // alert(qty_select);
    
         $("#total-"+mid).val(total);
      
  })
  $("body").delegate(".removedFromCart","click",function(event){
      event.preventDefault();
      var remove_from_cart_id = $(this).attr("remove_from_cart_id");
      if (confirm("Are you sure you want to remove this")) {
      $.ajax({
          url :   "../../required/controller.php",
          method : "POST",
          data  :  {removedFromCart:1,remove_from_cart_id:remove_from_cart_id},
          success : function(data){
              $("#cart_msg").html(data);
              invoiced();
          }
      })
    }
  })
  $("body").delegate(".update_cart","click",function(event){
      event.preventDefault();
      var update_cart_id = $(this).attr("update_cart_id");
      var qty = $("#qty_select-"+update_cart_id).val();
      var total = $("#total-"+update_cart_id).val();
      var ava_qty = $("#ava_qty-"+update_cart_id).val();
      
        $.ajax({
          url :   "../../required/controller.php",
          method : "POST",
          data  :  {update_cart:1,update_cart_id:update_cart_id,qty:qty,total:total,ava_qty:ava_qty},
          success : function(data){
             $("#cart_msg").html(data);
             invoiced();
          }
      })
      
      
  })
  $(".user_reset").click(function(event){
    event.preventDefault();
    var user_username =  $(this) .attr('user_username');
    var user_reset_id =  $(this) .attr('user_reset_id');
    
    if (confirm("Are you sure You want to Reset this Password ?")) {
      $.ajax({
        url :   "../../required/controller.php",
        method  :  "POST",
        data    :   {user_reset:1,user_username:user_username,user_reset_id,user_reset_id},
     
        success :   function(data){
          alert(data);
          window.location.href = "users.php";       
      }
      })
   
    }
  })
  $(".delete_request").click(function(event){
    event.preventDefault();
    var request_id =  $(this) .attr('request_id');

    if (confirm("Are you sure You want to Delete ?")) {
      $.ajax({
        url :   "../../required/controller.php",
        method  :  "POST",
        data    :   {delete_request:1,request_id:request_id},
     
        success :   function(data){
          alert(data);
          window.location.href = "requests.php";       
      }
      })
   
    }
  })
  $(".user_update").click(function(event){
    event.preventDefault();
    var user_update_id =  $(this) .attr('user_update_id');
    var user_username =$("#user_username"+user_update_id).text();
    var user_role =$("#user_role"+user_update_id).text();
    var user_shop =$("#user_shop"+user_update_id).text();
    
      $.ajax({
        url :   "../../required/controller.php",
        method  :  "POST",
        data    :   {user_update:1,user_update_id:user_update_id,user_username,user_username,user_role:user_role,user_shop:user_shop},
     
        success :   function(data){
          alert(data);
          window.location.href = "users.php";       
      }
      })
   
    
  })
  $(".user_delete").click(function(event){
    event.preventDefault();
    var user_delete_id =  $(this) .attr('user_delete_id');
    if (confirm("Are you sure You want to Delete this User ?")) {
      $.ajax({
        url :   "../../required/controller.php",
        method  :  "POST",
        data    :   {user_delete:1,user_delete_id:user_delete_id},
     
        success :   function(data){
          alert(data);
          window.location.href = "users.php";      
      }
      })
   
    }
  })
  $(".product_delete").click(function(event){
    event.preventDefault();
    var product_delete_id =  $(this) .attr('product_delete_id');
    if (confirm("Are you sure You want to Delete this Item ?")) {
      $.ajax({
        url :   "../../required/controller.php",
        method  :  "POST",
        data    :   {product_delete:1,product_delete_id:product_delete_id},
     
        success :   function(data){
          alert(data);
          window.location.href = "stocklevel.php";      
      }
      })
   
    }
  })
});
