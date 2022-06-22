<?php
session_start();
unset($_SESSION['cart']);

$_SESSION['message']="Cart Cleard Successfully !";
header("location:mycart.php");
?>