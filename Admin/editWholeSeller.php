<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    include '../Database/config.php';
    $b = new Database();
    $q="Update `wholeseller` set status='Approved' where w_id='$id'";
    $result=$b->conn->query($q);
    if($result)
    {
        header('location:wholeseller.php');
    }
}
if(isset($_GET['dec_id']))
{
    $id=$_GET['dec_id'];
    include '../Database/config.php';
    $b = new Database();
    $q="Update `wholeseller` set status='Pending' where w_id='$id'";
    $result=$b->conn->query($q);
    if($result)
    {
        header('location:wholeseller.php');
    }
}
if(isset($_GET['del_id']))
{
    $id=$_GET['del_id'];
    include '../Database/config.php';
    $b = new Database();
    $q="Delete from `wholeseller` where w_id='$id'";
    $result=$b->conn->query($q);
    if($result)
    {
        header('location:wholeseller.php');
    }
}
?>