<?php
 include '../../required/session.php' ; 
 include '../../model/database.php';

$dbConnect = new DatabaseConnection;
$delete_id = $_REQUEST['delete_id'];
$shop = $_REQUEST['shop'];
$stmt = $dbConnect->connect()->prepare("DELETE FROM shop_point WHERE shop_id = ?");
$stmt->execute([$delete_id]);
$stmt2 = $dbConnect->connect()->prepare("DELETE FROM product_store WHERE shop = ?");
$stmt2->execute([$shop]);
$stmt3 = $dbConnect->connect()->prepare("DELETE FROM users WHERE shop_point = ?");
$stmt3->execute([$$shop]);

header("location: updateshop.php");