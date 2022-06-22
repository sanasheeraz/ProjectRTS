<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include '../Database/config.php';
$b = new Database();
$Aid=$_GET['id']; 
    $ps="NO";
    $st="YES";


    $query1="update product set pro_active_status='$ps' where pro_id='$Aid'";
   
    $result1= $b->conn->query($query1);
    if($result1)
    {
        header("Location:view_products.php");
    }else{
        echo mysqli_error($conn);
    }


?>

