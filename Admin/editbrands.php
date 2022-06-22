<?php

include '../Database/config.php';
$b = new Database(); 

if(isset($_POST['btnSubmit']))
{  
    $Aid = $_POST['id'];
$name=$_POST['name'];

    $query1="update brands set brand_name='$name' where brand_id='$Aid'";
    $result1=mysqli_query($b->conn,$query1);
    if($result1)
    {
      echo "<script>alert('Successfully')</script>";

//        header("Location:brand.php");
    }else{
        echo mysqli_error($b->conn);
    }
}
?>
