<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    // $query="INSERT INTO `admin`( `admin_name`, `admin_email`, `admin_password`, `admin_role`) VALUES ('$name','$email','$password','$role')";

    // $result=mysqli_query($conn,$query);

        $a = new Database();
        $a->insert('admin',['admin_name'=>$name,'admin_email'=>$email,'admin_password'=>$password,'admin_role'=>$role]);
        if ($a == true) {
            echo $msg="Inserted";
            // header('location:index.php');
        }else{
            echo $msg="Not Inserted".mysqli_error($conn);
        }


    // if($result)
    // {
    //     echo $msg="Inserted";
    // }else{
    //     echo $msg="Not Inserted".mysqli_error($conn);
    // }
}
?>