<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    include '../Database/config.php';
    $b = new Database();
    $q="Update `dropshipper` set status='Approved' where d_id='$id'";
    $result=$b->conn->query($q);
    if($result)
    {
        header('location:dropshipper.php');
    }
}
if(isset($_GET['dec_id']))
{
    $id=$_GET['dec_id'];
    include '../Database/config.php';
    $b = new Database();
    $q="Update `dropshipper` set status='Pending' where d_id='$id'";
    $result=$b->conn->query($q);
    if($result)
    {
        header('location:dropshipper.php');
    }
}
if(isset($_GET['del_id']))
{
    $id=$_GET['del_id'];
    include '../Database/config.php';
    $b = new Database();
    $q="Delete from `dropshipper` where d_id='$id'";
    $result=$b->conn->query($q);
    if($result)
    {
        header('location:dropshipper.php');
    }
}
?>