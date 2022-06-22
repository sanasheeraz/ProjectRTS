<?php 
include('Database/config.php');
$b = new Database();
$id= $_POST['proid'];
$q="SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id where p.pro_id='$id'";
$result=$b->conn->query($q);
$row = mysqli_fetch_assoc($result);

$iq="SELECT * FROM `product_images` where pro_id=".$row['pro_id'];

$iq_thumbnail="SELECT * FROM `product_images` where pro_id=".$row['pro_id']." limit 1";
$iresult_thumbnail=$b->conn->query($iq_thumbnail);
$row_thumbnail=mysqli_fetch_assoc($iresult_thumbnail);

$iresult=$b->conn->query($iq);
$iiresult=$b->conn->query($iq);
?>
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <!-- product details inner end -->
                 <div class="product-details-inner">
                     <div class="row">
                         <div class="col-lg-5">
                             <div class="product-large-slider slick-arrow-style_2 mb-20">
                                 <div class="pro-large-img">
                                     <img  src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row_thumbnail['pro_image']); ?>" alt="" />
                                 </div>
                                
                             </div>
                             
                         </div>
                         <div class="col-lg-7">
                             <div class="product-details-des mt-md-34 mt-sm-34">
                                 <h3><a href="product-details.html"><?php echo $row["pro_name"]?></a></h3>
                                
                                 
                                 <div class="pricebox">
                                     <span class="regular-price">$<?php echo $row["pro_price"]?></span>
                                 </div>
                                 <p><?php echo $row["pro_details"]?></p>
                                 <div class="quantity-cart-box d-flex align-items-center mt-20">
                                     
                                     <div class="action_link">
                                         <a class="buy-btn" href="addCart.php?id=<?php echo $row['pro_id'];?>">add to cart<i class="fa fa-shopping-cart"></i> </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- product details inner end -->
             </div>
     