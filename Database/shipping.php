<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $ship_name=$_POST['ship_name'];
    $ship_price=$_POST['ship_price'];

    $a = new Database();
    $a->insert('shipping',['ship_name'=>$ship_name,'ship_price'=>$ship_price]);
    if ($a == true) {
        echo $msg="Inserted Successfully";
        // header('location:../Admin/stores.php');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }

}

if(isset($_GET['Delete']))
{
    $id=$_GET['id'];
    $a = new Database();
    $a->update('shipping',['ship_status'=>'InActive'],'ship_id',$id);
    if ($a == true) {
        header('location:../Admin/shipping.php');
    }else{
        echo $msg="Not Deleted".mysqli_error($conn);
    }

}

if(isset($_POST['Edit']))
{
    $id=$_POST['id'];
    $ship_name=$_POST['ship_name'];
    $ship_price=$_POST['ship_price'];
    $a = new Database();
    $a->update('shipping',['ship_name'=>$ship_name,'ship_price'=>$ship_price],'ship_id',$id);
    if ($a == true) {
        echo $msg="Updated Successfully";
    }else{
        echo $msg="Not Updated".mysqli_error($conn);
    }

}
?>