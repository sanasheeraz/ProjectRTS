<?php
include('header.php');
$b = new Database();
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
                            <li class="breadcrumb-item"><a href="shop-grid-left-sidebar.html">shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">cart</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- cart main wrapper start -->
<div class="cart-main-wrapper">
    <div class="container">
        <form method="post" action="savecart.php">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->

                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Thumbnail</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <?php
                                    if (isset($_SESSION['dropshipper'])) {
                                        $d_id = $_SESSION['dropshipper'];
                                        $qu = "SELECT * FROM `dropshipper` WHERE `d_id`=$d_id";
                                        $res = $b->conn->query($qu);
                                        $r = mysqli_fetch_assoc($res);
                                    ?>
                                        <th class="pro-subtotal">Total After <?php echo $r['d_discount_per'] . "% Discount" ?></th>
                                    <?php } else {
                                    ?>
                                        <th class="pro-subtotal">Total</th>

                                    <?php }
                                    ?>
                                    <?php
                                    ?>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                if (!empty($_SESSION['cart'])) {
                                    if (isset($_SESSION['dropshipper'])) {

                                        $index = 0;
                                        if (!isset($_SESSION['qty_array'])) {
                                            $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                        }
                                        $sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
                                        $result = $b->conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $iq = "SELECT * FROM `product_images` where pro_id=" . $row['pro_id'] . " LIMIT 1";
                                            $iresult = $b->conn->query($iq);
                                            $irow = mysqli_fetch_assoc($iresult);
                                            $pr = $row['pro_price'] - $row['pro_price'] * ($r['d_discount_per'] / 100);

                                ?>
                                            <tr>
                                                <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" alt="Product" /></a></td>
                                                <td class="pro-title"><a href="product_details.php?id=<?php echo $row['pro_id'] ?>"><?php echo $row['pro_name']; ?></a></td>
                                                <td class="pro-price"><span>Rs &nbsp;<?php echo number_format($row['pro_price'], 2); ?></span></td>
                                                <td class="pro-quantity">
                                                    <input type="hidden" id="login_as" value="dropshipper">

                                                    <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                                    <div class="pro-qty"><input type="text" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></div>
                                                </td>
                                                <td class="pro-subtotal"><span>Rs &nbsp; <?php echo number_format($_SESSION['qty_array'][$index] * $pr, 2); ?></span></td>
                                                <td class="pro-remove"><a href="deletecart.php?id=<?php echo $row['pro_id']; ?>&index=<?php echo $index; ?>"><i class="fa fa-trash-o"></i></a></td>
                                                <?php $total += $_SESSION['qty_array'][$index] * $pr; ?>
                                            </tr>
                                        <?php

                                            $index++;
                                            $_SESSION['total_price'] = $total;
                                        }
                                    }
                                    //wholeseller
                                    if (isset($_SESSION['wholeseller'])) {
                                        $w_id = $_SESSION['wholeseller'];
                                        $qu = "SELECT * FROM `wholeseller` WHERE `w_id`=$w_id";
                                        $res = $b->conn->query($qu);
                                        $r = mysqli_fetch_assoc($res);
                                        $twenty_dis = $r['w_discount2'];
                                        $ten_dis = $r['w_discount1'];
                                        $thrty = $r['w_discount3'];

                                        $index = 0;
                                        if (!isset($_SESSION['qty_array'])) {
                                            $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                        }
                                        $sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
                                        $result = $b->conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $iq = "SELECT * FROM `product_images` where pro_id=" . $row['pro_id'] . " LIMIT 1";
                                            $iresult = $b->conn->query($iq);
                                            $irow = mysqli_fetch_assoc($iresult);
                                            //   $pr = $row['pro_price'] - $row['pro_price'] * ($r['d_discount_per'] / 100);

                                        ?>
                                            <tr>
                                                <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" alt="Product" /></a></td>
                                                <td class="pro-title"><a href="product_details.php?id=<?php echo $row['pro_id'] ?>"><?php echo $row['pro_name']; ?></a></td>
                                                <td class="pro-price"><span>Rs &nbsp;<?php echo number_format($row['pro_price'], 2); ?></span></td>
                                                <td class="pro-quantity">
                                                    <input type="hidden" id="login_as" value="wholeseller">
                                                    <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                                    <div class="pro-qty"><input type="text" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></div>
                                                </td>
                                                <?php
                                                $number = $_SESSION['qty_array'][$index];
                                                $f1 = 0; //final one
                                                $f2 = 0; //final two
                                                if (floor($number / 30) > 0) {
                                                    $complete = $number / 30;
                                                    $whole = floor($number / 30);
                                                    $fraction = $complete - $whole;

                                                    // echo $whole;
                                                    // echo $fraction;
                                                    $num = 30 * $whole;
                                                    $product_qprice1 = $num * $row['pro_price'];
                                                   

                                                    // echo (($product_qprice1 * $thrty)/100)."prp";
                                                    $f1 = $product_qprice1 - (($product_qprice1 * $thrty) / 100);
                                                    if (($whole * 30) + ($number - $num) == $number) {

                                                        $sec = (($fraction * 30));

                                                        if ($sec == 20) {
                                                            $product_qprice2 = $sec * $row['pro_price'];
                                                            $dis2 = ($product_qprice2 * $twenty_dis) / 100;
                                                            $f2 = $product_qprice2 - $dis2;
                                                        } else {
                                                            $product_qprice2 = $sec * $row['pro_price'];
                                                            $dis2 = ($product_qprice2 * $ten_dis) / 100;
                                                            $f2 = $product_qprice2 - $dis2;
                                                        }
                                                    }
                                                } elseif (floor($number / 20) > 0) {
                                                    $product_qprice2 = 20 * $row['pro_price'];
                                                    $dis2 = ($product_qprice2 * $twenty_dis) / 100;
                                                    $f2 = $product_qprice2 - $dis2;
                                                } else {
                                                    $product_qprice2 = 10 * $row['pro_price'];
                                                    $dis2 = ($product_qprice2 * $ten_dis) / 100;
                                                    $f2 = $product_qprice2 - $dis2;
                                                }
                                                $fnal_price=$f1+$f2;
                                                ?>
                                                <td class="pro-subtotal"><span>$ &nbsp; <?php echo $fnal_price ?></span></td>
                                                <td class="pro-remove"><a href="deletecart.php?id=<?php echo $row['pro_id']; ?>&index=<?php echo $index; ?>"><i class="fa fa-trash-o"></i></a></td>
                                                <?php $total += $fnal_price; ?>
                                            </tr>
                                        <?php

                                            $index++;
                                            $_SESSION['total_price'] = $total;
                                        }
                                    } else {
                                        $index = 0;
                                        if (!isset($_SESSION['qty_array'])) {
                                            $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                        }
                                        $sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
                                        $result = $b->conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $iq = "SELECT * FROM `product_images` where pro_id=" . $row['pro_id'] . " LIMIT 1";
                                            $iresult = $b->conn->query($iq);
                                            $irow = mysqli_fetch_assoc($iresult);
                                            //   $pr = $row['pro_price'] - $row['pro_price'] * ($r['d_discount_per'] / 100);

                                        ?>
                                            <tr>
                                                <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" alt="Product" /></a></td>
                                                <td class="pro-title"><a href="product_details.php?id=<?php echo $row['pro_id'] ?>"><?php echo $row['pro_name']; ?></a></td>
                                                <td class="pro-price"><span>Rs &nbsp;<?php echo number_format($row['pro_price'], 2); ?></span></td>
                                                <td class="pro-quantity">
                                                    <input type="hidden" id="login_as" value="retailer">

                                                    <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                                    <div class="pro-qty"><input type="text" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></div>
                                                </td>
                                                <td class="pro-subtotal"><span>$ &nbsp; <?php echo number_format($_SESSION['qty_array'][$index] * $row['pro_price'], 2); ?></span></td>
                                                <td class="pro-remove"><a href="deletecart.php?id=<?php echo $row['pro_id']; ?>&index=<?php echo $index; ?>"><i class="fa fa-trash-o"></i></a></td>
                                                <?php $total += $_SESSION['qty_array'][$index] * $row['pro_price']; ?>
                                            </tr>
                                    <?php

                                            $index++;
                                            $_SESSION['total_price'] = $total;
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No Item in Cart</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">
                        <!-- <div class="apply-coupon-wrapper">
                        <form action="#" method="post" class=" d-block d-md-flex">
                            <input type="text" placeholder="Enter Your Coupon Code" required />
                            <button class="sqr-btn">Apply Coupon</button>
                        </form>
                    </div> -->
                        <div class="cart-update mt-sm-16">
                            <button type="submit" class="sqr-btn" name="save">Update Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-5 ml-auto">
                <!-- Cart Calculation Area -->
                <div class="cart-calculator-wrapper">
                    <div class="cart-calculate-items">
                        <h3>Cart Totals</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Sub Total</td>
                                    <td>$<?php echo $total; ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>$70</td>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <td class="total-amount">$<?php echo $total + 70; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="checkout.php" class="sqr-btn d-block">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart main wrapper end -->

<?php
include('footer.php');
?>