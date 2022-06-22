<?php

include '../Database/config.php';
$b = new Database(); 
$Aid=$_POST['id']; 
//$ps="InActive";

$query="Select * from supplier where sup_id='$Aid'";
$result=mysqli_query($b->conn,$query);
$row=mysqli_fetch_array($result);
if(isset($_POST['btnSubmit']))
{  

$name=$_POST['name'];
$code=$_POST['code'];

    $query1="update supplier set sup_name='$name', sup_code='$code' where sup_id='$Aid'";
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
