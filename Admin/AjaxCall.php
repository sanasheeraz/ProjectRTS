<?php
include '../Database/config.php';
$b = new Database();

if(isset($_POST['discount_update']))
{
    $id=$_POST['d_id'];
    $discount=$_POST['d_discount_per'];

    // $query="UPDATE `dropshipper` SET `d_discount_per`='$discount' where `d_id`='$id'";
    // $result=$b->conn->query($query);

    $b->update('dropshipper',["d_discount_per"=>$discount],'d_id',$id);
    
    echo $b->res;
    exit();
}

?>