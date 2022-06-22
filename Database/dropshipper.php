<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $a = new Database();
    $d_fname=$_POST['fname'];
    $d_lname=$_POST['lname'];
    $d_email=$_POST['email'];
    $d_password=$_POST['password'];
    $query1 = "select * from dropshipper where d_email ='".$d_email."'";
  $result1 = mysqli_query($a->conn, $query1);
  $num = mysqli_num_rows( $result1);
  if($num  > 0 )
  {
    header('location:../DropshipperRegister.php?email_duplicate=YES');

  }
else{
    $a->insert('dropshipper',['d_firstname'=>$d_fname,'d_lastname'=>$d_lname,'d_email'=>$d_email,'d_password'=>$d_password,'status'=>'Pending']);
    if ($a == true) {
        //echo $msg="Inserted";
        header('location:../DropshipperRegister.php?register_sucess=true');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }

}
}
?>