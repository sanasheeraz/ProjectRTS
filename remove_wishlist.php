<?php
session_start();
include 'Database/config.php';
$db=new Database();
$id=$_GET['id'];
if (isset($_SESSION['customer'])) {

    $q= "DELETE FROM `wishlist` WHERE product = '$id' AND user_type='USER' AND id_person ='".$_SESSION['customer']."' ";
    $result2 = mysqli_query($db->conn, $q);
    
}
if (isset($_SESSION['wholeseller'])) {
    $q= "    DELETE FROM `wishlist` WHERE product = '$id' AND user_type='WHOLESELLER' AND id_person ='".$_SESSION['customer']."' ";
    $result2 = mysqli_query($db->conn, $q);
    
}
if (isset($_SESSION['dropshipper'])) {
    $q= "    DELETE FROM `wishlist` WHERE product = '$id' AND user_type='DROPSHIPPER' AND id_person ='".$_SESSION['customer']."' ";
    $result2 = mysqli_query($db->conn, $q);
    
}
header('location:wishlist.php');

