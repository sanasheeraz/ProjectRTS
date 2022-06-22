<?php

include('config.php');
$Aid = $_POST['Aid'];
$name = $_POST['name'];
$prefix = $_POST['prefix'];
$store = $_POST['store'];
$b = new Database();

$query1 = "update category set cat_name='$name', cat_prefix='$prefix', cat_store='$store' where cat_id='$Aid'";
  $result1 = mysqli_query($b->conn, $query1);
  if ($result1) {
    echo "<script>alert('Successfully')</script>";

    //        header("Location:brand.php");
  } else {
    echo mysqli_error($b->conn);
  }
?>