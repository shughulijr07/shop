<?php

   session_start();
   //$user_check = $_SESSION['name'];
   if(session_destroy()) {
     
      header("Location: ../");
   }
?>

