<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $s_name=$_POST['s_name'];
    $s_code=$_POST['s_code'];
    
    $imageName=$_FILES['s_image']['tmp_name'];
    $s_image=addslashes(file_get_contents($imageName));

    $a = new Database();
    $a->insert('supplier',['sup_name'=>$s_name,'sup_code'=>$s_code,'sup_image'=>$s_image]);
    if ($a == true) {
        //echo $msg="Inserted";
        header('location:../Admin/supplier.php');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }

}
if(isset($_POST['btnEdit']))
{
    // $s_name=$_POST['s_name'];
    // $s_code=$_POST['s_code'];
    
    // $imageName=$_FILES['s_image']['tmp_name'];
    // $s_image=addslashes(file_get_contents($imageName));

    // $a = new Database();
    // $a->insert('supplier',['sup_name'=>$s_name,'sup_code'=>$s_code,'sup_image'=>$s_image]);
    // if ($a == true) {
    //     //echo $msg="Inserted";
    //     header('location:../Admin/supplier.php');
    // }else{
    //     echo $msg="Not Inserted".mysqli_error($conn);
    // }

}
if(isset($_GET['Delete']))
{
    $id=$_GET['id'];
    $a = new Database();
    $a->update('supplier',['sup_status'=>'InActive'],'sup_id',$id);
    if ($a == true) {
        header('location:../Admin/supplier.php');
    }else{
        echo $msg="Not Deleted".mysqli_error($conn);
    }

}
?>