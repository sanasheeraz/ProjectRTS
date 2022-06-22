<?php
include('header.php');
$id = $_GET['id'];
$q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id where p.pro_id='$id'";
$result = $b->conn->query($q);
$row = mysqli_fetch_assoc($result);

$iq = "SELECT * FROM `product_images` where pro_id=" . $row['pro_id'];
$iq_thumbnail = "SELECT * FROM `product_images` where pro_id=" . $row['pro_id'] . " limit 1";
$iresult_thumbnail = $b->conn->query($iq_thumbnail);
$row_thumbnail = mysqli_fetch_assoc($iresult_thumbnail);

$iresult = $b->conn->query($iq);
$iiresult = $b->conn->query($iq);
?>


<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="shop-grid-left-sidebar.html">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page">product detail</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- product details wrapper start -->
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="product-large-slider mb-20 slick-arrow-style_2" style="height:550px">


                                <?php while ($irowe = mysqli_fetch_assoc($iiresult)) { ?>
                                    <div class="pro-large-img img-zoom">
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irowe['pro_image']); ?>" alt="" />
                                    </div>
                                <?php } ?>



                                <!--                                   

                                            <div class="pro-large-img img-zoom">
                                                <img src="assets/img/product/product-details-img1.jpg" alt="" />
                                            </div>
                                            <div class="pro-large-img img-zoom">
                                                <img src="assets/img/product/product-details-img2.jpg" alt=""/>
                                            </div>
                                            <div class="pro-large-img img-zoom">
                                                <img src="assets/img/product/product-details-img3.jpg" alt=""/>
                                            </div>
                                            <div class="pro-large-img img-zoom">
                                                <img src="assets/img/product/product-details-img4.jpg" alt=""/>
                                            </div>
                                            <div class="pro-large-img img-zoom">
                                                <img src="assets/img/product/product-details-img2.jpg" alt=""/>
                                            </div> -->
                            </div>
                            <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                <?php while ($irow = mysqli_fetch_assoc($iresult)) { ?>
                                    <div class="pro-nav-thumb"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" alt="" /></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-des mt-md-34 mt-sm-34">
                                <h3><br><a href="product-details.html"><?php echo $row["pro_name"] ?></a></h3>
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
                                <div class="customer-rev">
                                    <a href="#">(1 customer review)</a>
                                </div>
                                <div class="availability mt-10">
                                    <h5>Availability:</h5>
                                    <span>1 in stock</span>
                                </div>
                                <div class="pricebox">

                                    <?php
                                    if ($_SESSION['role'] == "wholeseller") {
                                        $id = $_SESSION['wholeseller'];

                                        $qu = "SELECT * FROM `wholeseller` WHERE `w_id`='$id'";
                                        $res = $b->conn->query($qu);
                                        $r = mysqli_fetch_assoc($res);

                                        if ($r['w_discount1'] != null) {

                                            echo " <span class='regular-price'>Item : " . "10" . " Price : " . ($row['pro_price'] - $row['pro_price'] * ($r['w_discount1'] / 100)) . "</span><br>";
                                        }
                                        if ($r['w_discount2'] != null) {
                                            echo "<span class='regular-price'>Item : " . "20" . " Price : " . ($row['pro_price'] - $row['pro_price'] * ($r['w_discount2'] / 100)) . "</span><br>";
                                        }

                                        if ($r['w_discount3'] != null) {
                                            echo "<span class='regular-price'>Item : " . "30" . " Price : " . ($row['pro_price'] - $row['pro_price'] * ($r['w_discount3'] / 100)) . "</span><br>";
                                        }
                                    }
                                    else  if ($_SESSION['role'] == "dropshipper") {
                                        $id = $_SESSION['dropshipper'];


                                        $qu = "SELECT * FROM `dropshipper` WHERE `d_id`=".$_SESSION['dropshipper'];
                                        $res = $b->conn->query($qu);
                                        $r = mysqli_fetch_assoc($res);
                                        echo "<span class='regular-price'>$<del>" . $row['pro_price'] . "</del> &nbsp;&nbsp;&nbsp;";
                                        echo $row['pro_price'] - $row['pro_price'] * ($r['d_discount_per'] / 100)."</span>";
                                    }
                                    else
                                    {
                                    ?>
                                    <span class="regular-price">$<?php echo $row['pro_price']; ?></span>
                                    <?php }?>
                                </div>
                                <p><?php echo $row['pro_details']; ?></p>
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <div class="action_link">
                                        <a class="buy-btn" href="addCart.php?id=<?php echo $row['pro_id']; ?>">add to cart<i class="fa fa-shopping-cart"></i> </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                <!-- product details reviews start -->
                <div class="product-details-reviews mt-34">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-review-info">
                                <ul class="nav review-tab">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab_two">information</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab_three">reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            <p><?php echo $row['pro_details']; ?></p>
                                            <div class="review-description">
                                                <div class="tab-thumb">
                                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row_thumbnail['pro_image']); ?>" alt="">
                                                </div>
                                                <div class="tab-des mt-sm-24">
                                                    <h3>Product Information :</h3>
                                                    <p><?php echo $row['pro_full_details']; ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_two">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>SKU</td>
                                                    <td><?php echo $row['sku']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>DESCRIPTION</td>
                                                    <td><?php echo $row['pro_full_details']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_three">
                                        <?php
                                        $query_get_review = $b->conn->query('SELECT * from rating where product_id = ' . $_GET['id'] . '');
                                        $count_review = mysqli_num_rows($query_get_review);
                                        ?>
                                        <h5><?php echo $count_review ?> review for Simple product 12</h5>
                                        <?php while ($review = mysqli_fetch_assoc($query_get_review)) { ?>
                                            <div class="total-reviews">
                                                <div class="rev-avatar">
                                                    <img src="assets/img/about/avatar.jpg" alt="">
                                                </div>
                                                <div class="review-box">
                                                    <div class="ratings">
                                                        <?php
                                                        for ($i = 0; $i < $review['rating']; $i++) {
                                                        ?>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                        <?php } ?>

                                                    </div>
                                                    <div class="post-author">
                                                        <p><span><?php echo $review['posted_by'] ?> -</span> <?php echo $review['date'] ?></p>
                                                    </div>
                                                    <p><?php echo $review['comment'] ?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <form action="add_review.php" class="review-form" method="POST">
                                            <div class="form-group row">
                                                <input type="hidden" name="pro_id" value="<?php echo $_GET['id'] ?>">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span> Your Name</label>
                                                    <input type="text" class="form-control" required name="name_of">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span> Your Email</label>
                                                    <input type="email" class="form-control" required name="email_of">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span> Your Review</label>
                                                    <textarea class="form-control" required name="review"></textarea>
                                                    <div class="help-block pt-10"><span class="text-danger">Note:</span> HTML is not translated!</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span> Rating</label>
                                                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                    <input type="radio" value="1" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="2" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="3" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="4" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="5" name="rating" checked>
                                                    &nbsp;Good
                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <input type="submit" class="sqr-btn" type="submit" name="btnSave" value="Continue">
                                            </div>
                                        </form> <!-- end of review-form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details reviews end -->

            </div>


        </div>
    </div>
</div>
<!-- product details wrapper end -->


<?php
include('footer.php');
?>