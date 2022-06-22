<?php
session_start();
if(isset($_POST['btnLogin']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    include('config.php');
    $b = new Database();
    $q="select * from customer where cust_email='$email' && cust_password='$password'";
    $result=$b->conn->query($q);
    $num = mysqli_num_rows($result);
    if($num > 0)
    {
   
        $row=mysqli_fetch_row($result);
        $_SESSION['customer']=$row[0];
        $_SESSION['customer_name']=$row[1];
        header('location:../index.php');
    }else{
        header('location:../login-register.php?login_falied=true');

        echo "Invalid Credential";
    }

}
if(isset($_POST['btnWLogin']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    include('config.php');
    $b = new Database();
    $q="select * from wholeseller where w_email='$email' && w_password='$password' && status='Approved'";
    $result=$b->conn->query($q);
    $num = mysqli_num_rows($result);
    if($num > 0)
    {
        $row=mysqli_fetch_row($result);
        $_SESSION['wholeseller']=$row[0];
        $_SESSION['wholeseller_name']=$row[1]." ".$row[2];
        $_SESSION['role']="wholeseller";
        header('location:../index.php');
    }else{
        header('location:../WholesellerRegister.php?login_falied=true');

        echo "Invalid Credential";
    }
}
if(isset($_POST['btnDLogin']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    include('config.php');
    $b = new Database();
    $q="select * from dropshipper where d_email='$email' && d_password='$password' && status='Approved'";
    $result=$b->conn->query($q);
    $num = mysqli_num_rows($result);
    if($num > 0)
    {
        $row=mysqli_fetch_row($result);
        $_SESSION['dropshipper']=$row[0];
        $_SESSION['role']="dropshipper";
        $_SESSION['dropshipper_name']=$row[1]." ".$row[2];
        print_r($_SESSION['dropshipper']);
        header('location:../index.php');
    }else{
        header('location:../DropshipperRegister.php?login_falied=true');

    }
}
?>
