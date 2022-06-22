<?php
session_start();
 include_once('../Database/config.php');
 $db=new Database();
if(isset($_POST['btnSave']))
{
    $conn=mysqli_connect('localhost:3307','root','','rts');
    $email=$_POST['email'];
    $password=$_POST['password'];
    echo $q="SELECT * FROM `admin` WHERE `admin_email`='$email' && `admin_password`='$password'";
     $result=$db->conn->query($q);
    $result=mysqli_query($conn,$q);
    $num = mysqli_num_rows($result);
    if($num > 0)
    {
        $row=mysqli_fetch_row($result);
        $_SESSION['admin']=$row[0];
        header('location:index.php');
    }else{
        header('location:login.php?login_failed=true');

        echo "Invalid Credential";
    }
}
?>
