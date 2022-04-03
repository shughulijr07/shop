<?php
 include '../../session.php' ; 
 include '../../model/database.php';

$dbConnect = new DatabaseConnection;
$product_id = $_REQUEST['expired'];
$stmt = $dbConnect->connect()->prepare("DELETE FROM product_store WHERE product_id = ?");
$stmt->execute([$product_id]);

header("location: expired.php");