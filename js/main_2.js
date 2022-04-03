$(document).ready(function() {
    cat();
    brand();
    product();
    cart_checkout();
   // total_amount();

    
    function cat() {
        $.ajax({
            url   :  "../required/seq_action.php",
            method:  "POST",
            data  :   {category:1},
            success : function(data){
                 $("#get_category").html(data);
            }
        })
    }
  //  alert("nafanya kazi");

  function brand() {
    $.ajax({
        url   :  "../required/seq_action.php",
        method:  "POST",
        data  :   {brand:1},
        success : function(data){
             $("#get_brand").html(data);
        }
    })
}


function product() {
    $.ajax({
        url   :  "../required/seq_action.php",
        method:  "POST",
        data  :   {getProduct:1},
        success : function(data){
             $("#get_product").html(data);
        }
    })
}


$("body").delegate(".category", "click", function(event){
    event.preventDefault();
    var cid = $(this) .attr('cid');
    $.ajax({
      url     :  "../required/seq_action.php",
      method  :  "POST",
      data    :   {get_selected_Category:1,cat_id:cid},
      success :   function(data){
         $("#get_product").html(data);
      }
    })
})

$("body").delegate(".selectedBrand", "click", function(event){
    event.preventDefault();
    var bid = $(this) .attr('bid');
    $.ajax({
      url     :  "../required/seq_action.php",
      method  :  "POST",
      data    :   {selectedBrand:1,brand_id:bid},
      success :   function(data){
         $("#get_product").html(data);
      }
    })
})

$("#search_btn").click(function(){
    var keyword  = $("#search").val();
    if(keyword  != ""){
        $.ajax({
            url     :  "../required/seq_action.php",
            method  :  "POST",
            data    :   {search:1,keyword:keyword},
            success :   function(data){
               $("#get_product").html(data);
            }
          })
    }
})
  
$("#signup_button").click(function(event){
    event.preventDefault();
    $.ajax({
        url     :  "../required/register.php",
        method  :  "POST",
        data    :  $("form").serialize(),
        success :   function(data){
          $("#signup_msg").html(data);
        }
      })
})
/*
$("#upload_button").click(function(event){
    event.preventDefault();
    $.ajax({
        url     :  "../required/upload.php",
        method  :  "POST",
       // enctype :  "multipart/form-data",
        data    :  $("form").serialize(),
        success :   function(data){
          $("#upload_msg").html(data);
        }
      })
})*/

$("#login").click(function(event){
    event.preventDefault();
    var email = $("#email").val();
    var pass = $("#password").val();
    $.ajax({
        url     :  "../required/login.php",
        method  :  "POST",
        data    :  {userLogin:1,userEmail:email,userPassword:pass},
        success :   function(data){
          if(data == "abdul"){
             window.location.href = "view/";
          }
        }
      })
})
cart_count();
$("body").delegate("#product","click", function(event){
    event.preventDefault();
    var p_id = $(this).attr('pid');
    $.ajax({
        url     :  "../required/seq_action.php",
        method  :  "POST",
        data    :  {addToProduct:1,proId:p_id},
        success :   function(data){
          $("#product_msg").html(data);
          cart_count();
        }
      })
})
cart_container();  
  function cart_container(){
    $.ajax({
        url     :  "../required/seq_action.php",
        method  :  "POST",
        data    :  {get_cart_product:1},
        success :   function(data){
          $("#cart_product").html(data);
        }
      })
      
  }; 
  function cart_count(){
    $.ajax({
        url     :  "../required/seq_action.php",
        method  :  "POST",
        data    :  {cart_count:1},
        success :   function(data){
          $(".badge").html(data);
        }
      })
  }
$("#cart_container").click(function(event){
    event.preventDefault();
    $.ajax({
        url     :  "../required/seq_action.php",
        method  :  "POST",
        data    :  {get_cart_product:1},
        success :   function(data){
          $("#cart_product").html(data);
        }
      })
})
total_amount();
function total_amount(){
    $.ajax({
        url     :  "../required/seq_action.php",
        method  :  "POST",
        data    :  {total_amount:1},
        success :   function(data){
          $("#total_amount").html(data);
        }
      })
}
function cart_checkout(){
    $.ajax({
        url     :  "../required/seq_action.php",
        method  :  "POST",
        data    :  {cart_checkout:1},
        success :   function(data){
          $("#cart_checkout").html(data);
        }
      })
}
$("body").delegate(".qty","keyup",function(){
    var pid = $(this).attr("pid");
    var qty = $("#qty-"+pid).val();
    var price = $("#price-"+pid).val();
    var total = qty * price;
    $("#total-"+pid).val(total);
})
$("body").delegate(".remove","click",function(event){
    event.preventDefault();
    var pid = $(this).attr("remove_id");
    $.ajax({
        url :   "../required/seq_action.php",
        method : "POST",
        data  :  {removedFromCart:1,removeId:pid},
        success : function(data){
            $("#cart_msg").html(data);
            total_amount();
           window.location.href = "cart.php";
        }
    })
})
$("body").delegate(".update","click",function(event){
    event.preventDefault();
    var pid = $(this).attr("update_id");
    var qty = $("#qty-"+pid).val();
    var price = $("#price-"+pid).val();
    var total = qty * price;
    $.ajax({
        url :   "../required/seq_action.php",
        method : "POST",
        data  :  {updateCart:1,updateId:pid,pro_price:price,pro_total:total,pro_qty:qty},
        success : function(data){
           $("#cart_msg").html(data);
           total_amount();
           //window.location.href = "cart.php";
           //alert(data);
        }
    })
})
page();
 function page(){
    $.ajax({
        url :   "../required/seq_action.php",
        method : "POST",
        data  :  {page:1},
        success : function(data){
          
            $("#pageNo").html(data);
        }
    })
 }

 $("body").delegate("#page","click",function(event){
    event.preventDefault();
    var pn = $(this).attr("page");
    
    $.ajax({
        url :   "../required/seq_action.php",
        method : "POST",
        data  :  {getProduct:1,setPage:1,pageNumber:pn},
        success : function(data){
          $("#get_product").html(data);
        }
    })
})

/*$(document).on('click', '#upload_button', function(){
    var name = document.getElementById("file").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
      alert("Invalid Image File");
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("file").files[0]);
    var f = document.getElementById("file").files[0];
    var fsize = f.size||f.fileSize;
    if(fsize > 2000000){
      alert("Image File Size is very big");
    }
    else{
    form_data.append("file", document.getElementById('file').files[0]);
    $.ajax({
      url:"../required/upload.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(){
        //showPhoto();
        alert("tayari"); 
      }
    });
    }
  });

$(document).on('click', '#upload_button',function(e) {
    e.preventDefault();
    var formData = new FormData(this);    

    $.post($(this).attr("action"), formData, function(data) {
        alert(data);
    });

*/

    
    
    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });



    });


