<?php
session_start();
include 'Database/config.php';
$db=new Database();
$total_amount = $_SESSION['total_price'];
$Quantity = $_SESSION['qty_array'];
$date = date('Y-m-d');
if (isset($_SESSION['customer'])) {
    $Id = $_SESSION['customer'];
    $q = "INSERT INTO `retailer_order`(`ret_order_date`, `ret_id`, `total_amount`) VALUES ('$date','$Id','$total_amount')";


}

if (isset($_SESSION['wholeseller'])) {
    $Id = $_SESSION['wholeseller'];
    $q = "INSERT INTO `wholeseller_order`(`wholeseller_order_date`, `wholeseller_id`, `total_amount`) VALUES ('$date','$Id','$total_amount')";
}
if (isset($_SESSION['dropshipper'])) {
    $Id = $_SESSION['dropshipper'];
    $q = "INSERT INTO `dropshipper_order`(`dropshipper_order_date`, `dropshipper_id`, `total_amount`) VALUES ('$date','$Id','$total_amount')";
}

$index = 0;
$result = mysqli_query($db->conn, $q);

if ($result) {
    $O_Id = mysqli_insert_id($db->conn);
    $sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
    $result = mysqli_query($db->conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $pid = $row['pro_id'];
        $pname = $row['pro_name'];
        $price = $row['pro_price'];
        $quan = $_SESSION['qty_array'][$index];
        if (isset($_SESSION['customer'])) {
            $q1 = "INSERT INTO `r_invoice`(`p_id`, `p_name`, `p_price`, `p_quantity`, `r_order_id`) VALUES ('$pid','$pname','$price','$quan','$O_Id')";
        }
        if (isset($_SESSION['wholeseller'])) {
            $q1 = "INSERT INTO `w_invoice`(`p_id`, `p_name`, `p_price`, `p_quantity`, `w_order_id`) VALUES ('$pid','$pname','$price','$quan','$O_Id')";
        }
        if (isset($_SESSION['dropshipper'])) {
            $q1 = "INSERT INTO `d_invoice`(`p_id`, `p_name`, `p_price`, `p_quantity`, `d_order_id`) VALUES ('$pid','$pname','$price','$quan','$O_Id')";
        }

        $result1 = mysqli_query($db->conn, $q1);
        if ($result1) {
            $index++;
        } else {
            echo "Try Again";
            echo mysqli_error($db->conn);
        }
    }
    if (isset($_SESSION['customer'])) {
    $fullname=$_POST['first_name'] . $_POST['last_name'];
    $q2 = "INSERT INTO `delivery_details_retailer`(`order_id`, `p_name`, `p_country`, `p_state`, `p_postal`, `p_address`, `p_address_1`, `contact_number`, `special_note`,`payment_method`) VALUES ('$O_Id','$fullname','".$_POST['country']."','".$_POST['state']."','".$_POST['postal_code']."','".$_POST['address_1']."','".$_POST['adress_line_2']."','".$_POST['contact_number']."','".$_POST['note']."','".$_POST['payment_method']."')";
    $result2 = mysqli_query($db->conn, $q2);

      }  
      if (isset($_SESSION['wholeseller'])) {
        $fullname=$_POST['first_name'] . $_POST['last_name'];
        $q2 = "INSERT INTO `delivery_details_wholeseller`(`order_id`, `p_name`, `p_country`, `p_state`, `p_postal`, `p_address`, `p_address_1`, `contact_number`, `special_note`,`payment_method`) VALUES ('$O_Id','$fullname','".$_POST['country']."','".$_POST['state']."','".$_POST['postal_code']."','".$_POST['address_1']."','".$_POST['adress_line_2']."','".$_POST['contact_number']."','".$_POST['note']."','".$_POST['payment_method']."')";
        $result2 = mysqli_query($db->conn, $q2);
    
          }  
          if (isset($_SESSION['dropshipper'])) {
            $fullname=$_POST['first_name'] . $_POST['last_name'];
            $q2 = "INSERT INTO `delivery_details_dropshipper`(`order_id`, `p_name`, `p_country`, `p_state`, `p_postal`, `p_address`, `p_address_1`, `contact_number`, `special_note`,`payment_method`) VALUES ('$O_Id','$fullname','".$_POST['country']."','".$_POST['state']."','".$_POST['postal_code']."','".$_POST['address_1']."','".$_POST['adress_line_2']."','".$_POST['contact_number']."','".$_POST['note']."','".$_POST['payment_method']."')";
            $result2 = mysqli_query($db->conn, $q2);
        
              }  
     unset($_SESSION['cart']);
   unset($_SESSION['qty_array']);
   $_SESSION['total_price'] = 0;
   header('location:index.php');
} else {
    echo "Fail";
}
