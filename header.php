<?php
session_start();
if(!isset($_SESSION['role'])){
$_SESSION["role"]="customer";
}
//initialize cart if not set or is unset
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }
include('Database/config.php');
$b = new Database();

if(!isset($_SESSION['total_price']))
{
    $_SESSION['total_price']=0;
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <!-- Site title -->
    <title>RTS</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/logo/logo.jpeg" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- helper class css -->
    <link href="assets/css/helper.min.css" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="assets/css/plugins.css" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/skin-default.css" rel="stylesheet" id="galio-skin">

    
</head>

<body>

    <!-- color switcher start -->
    <!-- <div class="color-switcher">
        <div class="color-switcher-inner">
            <div class="switcher-icon">
                <i class="fa fa-cog fa-spin"></i>
            </div>

            <div class="switcher-panel-item">
                <h3>Color Schemes</h3>
                <ul class="nav flex-wrap colors">
                    <li class="default active" data-color="default" data-toggle="tooltip" data-placement="top" title="Red"></li>
                    <li class="green" data-color="green" data-toggle="tooltip" data-placement="top" title="Green"></li>
                    <li class="soft-green" data-color="soft-green" data-toggle="tooltip" data-placement="top" title="Soft-Green"></li>
                    <li class="sky-blue" data-color="sky-blue" data-toggle="tooltip" data-placement="top" title="Sky-Blue"></li>
                    <li class="orange" data-color="orange" data-toggle="tooltip" data-placement="top" title="Orange"></li>
                    <li class="violet" data-color="violet" data-toggle="tooltip" data-placement="top" title="Violet"></li>
                </ul>
            </div>

            <div class="switcher-panel-item">
                <h3>Layout Style</h3>
                <ul class="nav layout-changer">
                    <li><button class="btn-layout-changer active" data-layout="wide">Wide</button></li>
                    <li><button class="btn-layout-changer" data-layout="boxed">Boxed</button></li>
                </ul>
            </div>

            <div class="switcher-panel-item bg">
                <h3>Background Pattern</h3>
                <ul class="nav flex-wrap bgbody-style bg-pattern">
                    <li><img src="assets/img/bg-panel/bg-pettern/1.png" alt="Pettern"></li>
                    <li><img src="assets/img/bg-panel/bg-pettern/2.png" alt="Pettern"></li>
                    <li><img src="assets/img/bg-panel/bg-pettern/3.png" alt="Pettern"></li>
                    <li><img src="assets/img/bg-panel/bg-pettern/4.png" alt="Pettern"></li>
                    <li><img src="assets/img/bg-panel/bg-pettern/5.png" alt="Pettern"></li>
                    <li><img src="assets/img/bg-panel/bg-pettern/6.png" alt="Pettern"></li>
                </ul>
            </div>

            <div class="switcher-panel-item bg">
                <h3>Background Image</h3>
                <ul class="nav flex-wrap bgbody-style bg-img">
                    <li><img src="assets/img/bg-panel/bg-img/01.jpg" alt="Images"></li>
                    <li><img src="assets/img/bg-panel/bg-img/02.jpg" alt="Images"></li>
                    <li><img src="assets/img/bg-panel/bg-img/03.jpg" alt="Images"></li>
                    <li><img src="assets/img/bg-panel/bg-img/04.jpg" alt="Images"></li>
                    <li><img src="assets/img/bg-panel/bg-img/05.jpg" alt="Images"></li>
                    <li><img src="assets/img/bg-panel/bg-img/06.jpg" alt="Images"></li>
                </ul>
            </div>
        </div>
    </div> -->
    <!-- color switcher end -->

    <div class="wrapper box-layout">

        <!-- header area start -->
        <header>

            <!-- header top start -->
            <div class="header-top-area bg-gray text-center text-md-left">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-5">
                            <div class="header-call-action">
                                <a href="#">
                                    <i class="fa fa-envelope"></i>
                                    info@website.com
                                </a>
                                <a href="#">
                                    <i class="fa fa-phone"></i>
                                    0123456789
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-7">
                            <div class="header-top-right float-md-right float-none">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="myCart.php">My Cart</a>
                                        </li>
                                      
                                        <?php
                                        if(isset($_SESSION['dropshipper'])||isset($_SESSION['wholeseller'])||isset($_SESSION['customer']))
                                        {
                                        ?>
                                        <li>
                                            <a href="wishlist.php">My Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="checkoutdetail.php">Checkout</a>
                                        </li>
                                         <li>
                                            <a href="logout.php">Logout</a>
                                        </li>
                                        <?php
                                        }else{
                                        ?>
                                        <li>
                                            <div class="dropdown header-top-dropdown">
                                                <a class="dropdown-toggle" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    my account
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="myaccount">
                                                    <!-- <a class="dropdown-item" href="my-account.html">my account</a> -->
                                                    <a class="dropdown-item" href="login-register.php"> Login/Register</a>
                                                    <a class="dropdown-item" href="WholesellerRegister.php">Wholeseller Register</a>
                                                    <a class="dropdown-item" href="DropshipperRegister.php">Dropshipper Register</a>
                                                </div>
                                            </div>
                                        </li>
                                       <?php
                                        }
                                       ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header top end -->

            <!-- header middle start -->
            <div class="header-middle-area header-middle-style-2 pt-20 pb-20">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="brand-logo">
                                <a href="index-2.html">
                                    <img src="assets/img/logo/logo.jpeg" width="100" height="100" alt="brand logo">
                                </a>
                            </div>
                        </div> <!-- end logo area -->
                        <div class="col-lg-9">
                            <div class="header-middle-right">
                                <div class="header-middle-shipping mb-20">
                                    <div class="single-block-shipping">
                                        <div class="shipping-icon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h5>Working time</h5>
                                            <span>Mon- Sun: 8.00 - 18.00</span>
                                        </div>
                                    </div> <!-- end single shipping -->
                                    <div class="single-block-shipping">
                                        <div class="shipping-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h5>free shipping</h5>
                                            <span>On order over $199</span>
                                        </div>
                                    </div> <!-- end single shipping -->
                                    <div class="single-block-shipping">
                                        <div class="shipping-icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h5>money back 100%</h5>
                                            <span>Within 30 Days after delivery</span>
                                        </div>
                                    </div> <!-- end single shipping -->
                                </div>
                                <div class="header-middle-block">
                                    <div class="header-middle-searchbox">
                                        <input type="text" placeholder="Search..." id="search">
                                        <button class="search-btn" onclick="search()"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header middle end -->

            <!-- main menu area start -->
            <div class="main-header-wrapper bdr-bottom1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-header-inner header-2">
                                <div class="category-toggle-wrap">
                                    <div class="category-toggle">
                                        category
                                        <div class="cat-icon">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <nav class="category-menu category-style-2">
                                        <ul>
                                            <?php
                                            $cq="SELECT * FROM `category`";
                                            $cresult=$b->conn->query($cq);
                                            
                                            while($crow=mysqli_fetch_assoc($cresult))
                                            {
                                            ?>
                                            <li><a href="shop-grid-left-sidebar.html"><i class="fa fa-desktop"></i> <?php echo $crow['cat_name'];?></a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="main-menu">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home </a>
                                            </li>
                                            <li class="static"><a href="products.php">Products </a>
                                                <!-- <ul class="megamenu dropdown">
                                                    <li class="mega-title"><a href="#">column 01</a>
                                                        <ul>
                                                            <li><a href="shop-grid-left-sidebar.html">shop grid left sidebar</a></li>
                                                            <li><a href="shop-grid-right-sidebar.html">shop grid right sidebar</a></li>
                                                            <li><a href="shop-grid-full-3-col.html">shop grid full 3 column</a></li>
                                                            <li><a href="shop-grid-full-4-col.html">shop grid full 4 column</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="#">column 02</a>
                                                        <ul>
                                                            <li><a href="product-details.html">product details</a></li>
                                                            <li><a href="product-details-affiliate.html">product details
                                                                    affiliate</a></li>
                                                            <li><a href="product-details-variable.html">product details
                                                                    variable</a></li>
                                                            <li><a href="product-details-group.html">product details group</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="#">column 03</a>
                                                        <ul>
                                                            <li><a href="cart.html">cart</a></li>
                                                            <li><a href="checkout.html">checkout</a></li>
                                                            <li><a href="compare.html">compare</a></li>
                                                            <li><a href="wishlist.html">wishlist</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="#">column 04</a>
                                                        <ul>
                                                            <li><a href="my-account.html">my-account</a></li>
                                                            <li><a href="login-register.html">login-register</a></li>
                                                            <li><a href="about-us.html">about us</a></li>
                                                            <li><a href="contact-us.html">contact us</a></li>
                                                        </ul>
                                                    </li>
                                                </ul> -->
                                            </li>
                                            <li><a href="brands.php">Brands</a></li>
                                            <li><a href="faqs.php">FAQs</a></li>
                                            <li><a href="about.php">About us</a></li>
                                            <li><a href="contact.php">Contact us</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="mini-cart2">
                                    <div class="header-mini-cart">
                                        <div class="mini-cart-btn">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span class="cart-notification"><?php echo count($_SESSION['cart']);?></span>
                                        </div>
                                        <div class="cart-total-price">
                                            <span>total:</span>
                                            <?php echo $_SESSION['total_price'];?>
                                        </div>
                                        <ul class="cart-list">
                                        <?php if (!empty($_SESSION['cart'])) {
                                $index = 0;
                                if (!isset($_SESSION['qty_array'])) {
                                    $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                }
                                $sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
                                $result=$b->conn->query($sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $iq="SELECT * FROM `product_images` where pro_id=".$row['pro_id']." LIMIT 1";
                                    $iresult=$b->conn->query($iq);
                                    $irow=mysqli_fetch_assoc($iresult);
                                    ?>
                                        <li>
                                                <div class="cart-img">
                                                    <a href="product_details.php?id=<?php echo $row['pro_id'];?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" alt=""></a>
                                                </div>
                                                <div class="cart-info">
                                                    <h4><a href="product_details.php?id=<?php echo $row['pro_id'];?>"><?php echo $row['pro_name'];?></a></h4>
                                                    <span>$<?php echo $row['pro_price'];?></span>
                                                </div>
                                                <div class="del-icon">
                                                <a href="deletecart.php?id=<?php echo $row['pro_id'];?>&index=<?php echo $index; ?>"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                            <?php
                                }}
                                            ?>
                                            <li class="mini-cart-price">
                                                <span class="subtotal">subtotal : </span>
                                                <span class="subtotal-price">$<?php echo $_SESSION['total_price'];?></span>
                                            </li>
                                            <li class="checkout-btn">
                                                <a href="checkoutdetail.php">checkout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-block d-lg-none"><div class="mobile-menu"></div></div>
                    </div>
                </div>
            </div>
            <!-- main menu area end -->

        </header>
        <!-- header area end -->
