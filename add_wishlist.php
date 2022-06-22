<?php
session_start();
include 'Database/config.php';
$db=new Database();
$id=$_GET['id'];
if (isset($_SESSION['customer'])) {
    $query_get=mysqli_query($db->conn,"SELECT * FROM wishlist  where user_type='USER' AND product='$id'");
    $count=mysqli_num_rows($query_get);
    if($count < 1)
    {
    $q= "INSERT INTO `wishlist`( `product`, `user_type`, `id_person`) VALUES ('$id','USER','".$_SESSION['customer']."')";
    $result2 = mysqli_query($db->conn, $q);
    }
}
if (isset($_SESSION['wholeseller'])) {
    $query_get=mysqli_query($db->conn,"SELECT * FROM wishlist  where user_type='WHOLESELLER' AND product='$id'");
    $count=mysqli_num_rows($query_get);
    if($count < 1)
    {
    $q= "INSERT INTO `wishlist`( `product`, `user_type`, `id_person`) VALUES ('$id','WHOLESELLER','".$_SESSION['wholeseller']."')";
    $result2 = mysqli_query($db->conn, $q);
    }
}
if (isset($_SESSION['dropshipper'])) {
    $query_get=mysqli_query($db->conn,"SELECT * FROM wishlist  where user_type='DROPSHIPPER' AND product='$id'");
    $count=mysqli_num_rows($query_get);
    if($count < 1)
    {
    $q= "INSERT INTO `wishlist`( `product`, `user_type`, `id_person`) VALUES ('$id','DROPSHIPPER','".$_SESSION['dropshipper']."')";
    $result2 = mysqli_query($db->conn, $q);
    }
}
header('location:products.php');

