<?php

include('config.php');

if(isset($_POST['btnSave']))
{
    $pro_name=$_POST['pro_name'];
    $pro_code=$_POST['pro_code'];
    $ean_no=$_POST['ean_no'];
    $pro_details=$_POST['pro_details'];
    $pro_full_details=$_POST['pro_full_details'];
    $pro_cat_id=$_POST['pro_cat_id'];
    $sku=$_POST['sku'];
    $pro_tax=$_POST['pro_tax'];
    $pro_supplier=$_POST['pro_supplier'];
    $discount_per=$_POST['discount_per'];
    $pro_cost=$_POST['pro_cost'];
    $pro_price=$_POST['pro_price'];
    $brand_id=$_POST['brand_id'];
    $shipping=$_POST['shipping'];
    $new_arrival=$_POST['new_arrival'];
    $is_featured=$_POST['is_featured'];
    $is_hot=$_POST['is_hot'];
    $Tags=$_POST['Tags'];
//    $images[]=$_POST['fileUpload'];
    $a = new Database();
    $a->insert('product',['pro_code'=>$pro_code,'pro_name'=>$pro_name,'pro_details'=>$pro_details,
    'pro_full_details'=>$pro_full_details,'ean_no'=>$ean_no,'pro_cat_id'=>$pro_cat_id,'sku'=>$sku,'pro_tax'=>$pro_tax,
    'pro_supplier'=>$pro_supplier,'discount_per'=>$discount_per,'pro_cost'=>$pro_cost,
    'pro_price'=>$pro_price,'brand_id'=>$brand_id
    ,'shipping'=>$shipping
    ,'new_arrival'=>$new_arrival,'is_featured'=>$is_featured,'is_hot'=>$is_hot,'Tags'=>$Tags]);
    $allSet=true;
    if ($a == true) {
        echo $msg=" Pro Inserted";
        $pro_id=$a->conn->insert_id;
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');     
        // Define maxsize for files i.e 2MB
        $maxsize = 2 * 1024 * 1024;
        foreach ($_FILES['fileUpload']['tmp_name'] as $key => $value) {
            echo "image ".$key;
            $file_tmpname = $_FILES['fileUpload']['tmp_name'][$key];
            $file_name = $_FILES['fileUpload']['name'][$key];
            $file_size = $_FILES['fileUpload']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types)) { 
                // Verify file size - 2MB max
                if ($file_size > $maxsize)        
                  {  echo "Error: File size is larger than the allowed limit.";}
                $image=addslashes(file_get_contents($file_tmpname));
                
                $a->insert('product_images',['pro_id'=>$pro_id,'pro_image'=>$image]);
                if ($a != true) {
                    $allSet=false;
                }
            }
            else {
                // If file extension not valid
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    
            if($allSet==false)
            {
                echo "Error in image Adding";
            }
        
       header('location:../Admin/view_products.php');
    }else{
        echo $msg="Not Inserted".mysqli_error($conn);
    }
}
