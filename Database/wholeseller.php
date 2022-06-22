<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $w_fname=$_POST['fname'];
    $w_lname=$_POST['lname'];
    $w_email=$_POST['email'];
    $w_password=$_POST['password'];

    $a = new Database();
    $query1 = "select * from wholeseller where w_email ='".$w_email."'";
    $result1 = mysqli_query($a->conn, $query1);
    $num = mysqli_num_rows( $result1);
    if($num  > 0 )
    {
      header('location:../login-register.php?email_duplicate=YES');
  
    }
    $a->insert('wholeseller',['w_firstname'=>$w_fname,'w_lastname'=>$w_lname,'w_email'=>$w_email,'w_password'=>$w_password,'status'=>'Pending']);
    if ($a == true) {
        echo $msg="Inserted";
        // header('location:index.php');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }

}
?>