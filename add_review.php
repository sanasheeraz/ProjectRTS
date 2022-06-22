<?php 
session_start();
include('Database/config.php');
$b = new Database();
if(isset($_POST['btnSave']))
{
    if (isset($_SESSION['customer'])) {
        $postedby="USER";
        $Id = $_SESSION['customer'];
    }
    if (isset($_SESSION['wholeseller'])) {
        $postedby="WHOLESELLER";
        $Id = $_SESSION['wholeseller'];
    }
    if (isset($_SESSION['dropshipper'])) {
        $postedby="DROPSHIPPER";
        $Id = $_SESSION['dropshipper'];
    }

    $name_of=$_POST['btnSave'];
    $email_of =$_POST['email_of'];
    $comment = $_POST['review'];
    $rating =$_POST['rating'];
    $pro_id=$_POST['pro_id'];
    $b->insert('rating',['name_of'=>$name_of,'email'=>$email_of,'comment'=>$comment,'rating'=>$rating,'posted_by'=>$postedby,'id_post'=>$Id,'product_id'=>$pro_id]);
    echo "<script>alert('RATING POSTED')</script>";
  //  echo "<script>window.location = 'product_details.php'";
  header('location:product_details.php?id='.$pro_id);

}

?>