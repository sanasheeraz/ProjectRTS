<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $c_name=$_POST['c_name'];
    $c_prefix=$_POST['c_prefix'];
    $c_store=$_POST['c_store'];
    
    $imageName=$_FILES['c_image']['tmp_name'];
    $c_image=addslashes(file_get_contents($imageName));

    $a = new Database();
    $a->insert('category',['cat_name'=>$c_name,'cat_prefix'=>$c_prefix,'cat_image'=>$c_image,'cat_store'=>$c_store]);
    if ($a == true) {
        //echo $msg="Inserted";
        header('location:../Admin/category.php');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }

}
if(isset($_GET['Delete']))
{
    $id=$_GET['id'];
    $a = new Database();
    $a->delete('category','cat_id',$id);
    if ($a == true) {
        header('location:../Admin/category.php');
     }
    else 
    {
    
    }
}    
?>