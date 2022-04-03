<div class="text-center title" style="color: white;background-color: green; width: 100%;height: 100px">
    <div class="row">
      <div class="col-md-2">
      <?php 
        if (!isset($_SESSION['username'])) {
          ?>
             <img src="images/kushoto.jpg" alt="" style="height: 100px; width: 100%" srcset="">
          <?php
        } else {
          ?>
            <img src="../../images/kushoto.jpg" alt="" style="height: 100px; width: 100%" srcset="">
        <?php
        }
        
      ?>
      </div>
      <div class="col-md-8"><h1>SHOP MANAGEMENT</h1></div>
      <div class="col-md-2">
      <?php 
        if (!isset($_SESSION['username'])) {
          ?>
             <img src="images/kulia.jpg" alt="" style="height: 100px; width: 100%" srcset="">
          <?php
        } else {
          ?>
            <img src="../../images/kulia.jpg" alt="" style="height: 100px; width: 100%" srcset="">
        <?php
        }
        
      ?>
           
      </div>
    </div>
</div>