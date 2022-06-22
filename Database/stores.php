<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $s_name=$_POST['s_name'];
    $s_location=$_POST['s_location'];

    $a = new Database();
    $a->insert('store',['store_name'=>$s_name,'store_location'=>$s_location]);
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
    $a->update('store',['store_status'=>'InActive'],'store_id',$id);
    if ($a == true) {
        header('location:../Admin/stores.php');
    }else{
        echo $msg="Not Deleted".mysqli_error($conn);
    }

}

if(isset($_POST['Edit']))
{
    $id=$_POST['id'];
    $s_name=$_POST['s_name'];
    $s_location=$_POST['s_location'];
    $a = new Database();
    $a->update('store',['store_name'=>$s_name,'store_location'=>$s_location],'store_id',$id);
    if ($a == true) {
        echo $msg="Updated Successfully";
    }else{
        echo $msg="Not Updated".mysqli_error($conn);
    }

}
?>