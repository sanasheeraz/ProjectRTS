<?php

include('config.php');

if(isset($_POST['btnRegister']))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $a = new Database();
    $query1 = "select * from customer where cust_email ='".$email."'";
    $result1 = mysqli_query($a->conn, $query1);
    $num = mysqli_num_rows( $result1);
    if($num  > 0 )
    {
      header('location:../login-register.php?email_duplicate=YES');
  
    }
    else
    {
    $a->insert('customer',['cust_username'=>$username,'cust_email'=>$email,'cust_password'=>$password]);
    if ($a == true) {
        header('location:../login-register.php?register_sucess=ture');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }
}
    
}
?>