<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $sl_name=$_POST['sl_name'];
    $sl_discount=$_POST['sl_discount'];
    $sl_text=$_POST['sl_text'];
    
    $imageName=$_FILES['sl_image']['tmp_name'];
    $sl_image=addslashes(file_get_contents($imageName));

    $a = new Database();
    $a->insert('home_slider',['sl_name'=>$sl_name,'sl_discount'=>$sl_discount,'sl_text'=>$sl_text,'sl_image'=>$sl_image]);
    if ($a == true) {
        //echo $msg="Inserted";
        header('location:../Admin/slider.php');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }
}
if(isset($_GET['Delete']))
{
    $id=$_GET['id'];
    $a = new Database();
    $a->delete('home_slider','sl_id',$id);
    if ($a == true) {
        header('location:../Admin/slider.php');
    }else{
        echo $msg="Not Deleted".mysqli_error($conn);
    }
}
?>