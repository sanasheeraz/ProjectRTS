<?php
$id=$_GET['id'];

include '../Database/config.php';
$a = new Database();

$a->delete('category','cat_id',$id);
if ($a == true) {
    header('location:../Admin/category.php');
 }
else 
{
    echo "Failed"; 

}

?>