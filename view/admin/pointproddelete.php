<?php
 include '../../required/session.php' ; 
 include '../../model/database.php';

$dbConnect = new DatabaseConnection;
$product_id = $_REQUEST['id'];
$point = $_REQUEST['point'];
$stmt = $dbConnect->connect()->prepare("DELETE FROM product_store WHERE product_id = ?");
$stmt->execute([$product_id]);

header("location: points.php?point=$point");