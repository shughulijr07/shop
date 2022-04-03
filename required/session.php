<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("location:../../");//if the username is incorrect or the session is destroyed then return to login page/index.php
 }
?>