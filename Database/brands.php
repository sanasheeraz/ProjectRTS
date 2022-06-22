<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $b_name=$_POST['b_name'];
    
    $imageName=$_FILES['b_image']['tmp_name'];
    $b_image=addslashes(file_get_contents($imageName));

    $a = new Database();
    $a->insert('brands',['brand_name'=>$b_name,'brand_logo'=>$b_image]);
    if ($a == true) {
        //echo $msg="Inserted";
        header('location:../Admin/brand.php');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }

}
if(isset($_GET['Delete']))
{
    $id=$_GET['id'];
    $a = new Database();
    $a->update('brands',['brand_status'=>'InActive'],'brand_id',$id);
    if ($a == true) {
        header('location:../Admin/brand.php');
    }else{
        echo $msg="Not Deleted".mysqli_error($conn);
    }

}
?>