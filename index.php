<?php
include('header.php');

$b = new Database();

$nq="SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id where new_arrival='Yes'";
$nresult=$b->conn->query($nq);
$fq="SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id where is_featured='Yes'";
$fresult=$b->conn->query($fq);
$b->select("home_slider", "*");
$slider_result = $b->sql;
?>

        <!-- hero slider start -->
        <div class="hero-slider-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-wrapper-area2 mt-30">
                            <div class="hero-slider-active hero__2 slick-dot-style hero-dot">
                            <?php
                            while($slider_row=mysqli_fetch_assoc($slider_result))
                            {
                            ?>    
                            <div class="single-slider d-flex align-items-center" style="background-image: url(data:image/jpg;charset=utf8;base64,<?php echo base64_encode($slider_row['sl_image']); ?>);">
                                    <div class="container">
                                        <div class="slider-main-content">
                                            <div class="slider-text text-center">
                                                <h2><?php echo $slider_row['sl_name'];?></h2>
                                                <h3><?php echo $slider_row['sl_discount'];?></h3>
                                                <p><?php echo $slider_row['sl_text'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <?php
                            }
                               ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero slider end -->

       <!-- <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-lg-3 col-md-3 col-sm-12" style="height:300px;background-color:#dec9ae; margin:10px;">
                <p style="font-size:2rem;color:white;padding:20px 12px;line-height:50px;text-align:center">View Our Latest Product</p>
                <div style="height:100%;">
                <a href="" class="btn btn-success" style="display:inherit">Click Here</a>
                </div>                
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12" style="height:300px;background-color:#bfe1c6; margin:10px;">
                <p style="font-size:2rem;color:white;padding:20px 12px;line-height:50px;text-align:center">View Our Brands</p>
                <a href="" class="btn btn-success">Click Here</a> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12" style="height:300px;background-color:#fcc5a6; margin:10px;">
                <p style="font-size:2rem;color:white;padding:20px 12px;line-height:50px;text-align:center">View Our Categories</p>
                <a href="" class="btn btn-success">Click Here</a> 
            </div>
        </div>
       </div> -->

        <!-- latest product start -->
        <div class="latest-product latest-pro-2 pt-14 pt-lg-0 pt-md-0 pt-sm-0">
            <div class="container">
                <div class="section-title mb-30">
                    <div class="title-icon">
                        <i class="fa fa-flash"></i>
                    </div>
                    <h3>latest product</h3>
                </div> <!-- section title end -->
                <!-- featured category start -->
                <div class="latest-product-active slick-padding slick-arrow-style">
                <?php while ($nrow = mysqli_fetch_assoc($nresult)) { 
                    $count=1;
                    $iq="SELECT * FROM `product_images` where pro_id=".$nrow['pro_id']." LIMIT 1";
                    $iresult=$b->conn->query($iq);
                                    ?>
                    <!-- product single item start -->
                    <div class="product-item fix">
                    <div class="product-thumb">
                                            <a href="product_details.php?id=<?php echo $nrow['pro_id']?>">
                                            <?php
                                                if(mysqli_num_rows($iresult)==0)
                                                {
                                            ?>
                                            <img src="assets/img/banner/banner_shop.jpg" class="img-pri" alt="" height="200px">
                                                <img src="assets/img/banner/banner_shop.jpg" class="img-sec" alt="" height="200px">
                                            <?php
                                            }else{
                                                while($irow=mysqli_fetch_assoc($iresult)){
                                                ?>
                                                  <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" class="img-pri" alt="" height="200px">
                                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" class="img-sec" alt="" height="200px">  
                                            <?php 
                                            }}
                                            ?>
                                            </a>
                                            <?php
                                            if($nrow['is_hot']=="Yes")
                                            {
                                            ?>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                            <?php } ?>
                            <div class="product-action-link">
                                <a href="#" data-toggle="modal" data-target="#quick_view"> <span data-toggle="tooltip" data-placement="left" title="Quick view"><i class="fa fa-search"></i></span> </a>
                                <a href="#" data-toggle="tooltip" data-placement="left" title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="left" title="Compare"><i class="fa fa-refresh"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="product-content">
                        <h4><a href="product_details.php?id=<?php echo $nrow['pro_id']?>"><?php echo $nrow['pro_name']; ?></a></h4>
                                            <div class="pricebox">
                                            <span class="regular-price"><?php echo $nrow['pro_price'];?></span>
                                               <div class="ratings">
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <div class="pro-review">
                                        <span>1 review(s)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product single item end -->
                    <?php } ?>
                </div>
                <!-- featured category end -->
            </div>
        </div>
        <!-- latest product end -->

         
           
<?php
include('footer.php');
?>