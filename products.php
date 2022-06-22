<?php
include('header.php');
echo $_SESSION["role"];
$b = new Database();
if (isset($_GET['sortby'])) {
    $sortby = $_GET['sortby'];
    if ($sortby = 'name_asc') {
        $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id ORDER BY pro_name ASC";
    }
    if ($sortby = 'name_dsc') {
        $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id ORDER BY pro_name DESC";
    }
    if ($sortby = 'price_low') {
        $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id ORDER BY pro_price ASC";
    }
    if ($sortby = 'model-asc') {
        $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id ORDER BY b.brand_name ASC";
    }
    if ($sortby = 'model-dec') {
        $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id ORDER BY b.brand_name DESC";
    }
} elseif (isset($_GET['search'])) {
    $search = $_GET['search'];
    $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id where `pro_name` LIKE '%$search%'";
}
elseif (isset($_GET['cat_id'])) {
    $search = $_GET['cat_id'];
    $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id where `pro_cat_id` = '$search'";
}
elseif (isset($_GET['brand_id'])) {
    $search = $_GET['brand_id'];
    $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id where p.brand_id = '$search'";
}  else {
    $q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `brands` b ON p.brand_id=b.brand_id";
}
$result = $b->conn->query($q);


$cq = "SELECT * FROM `category`";
$cresult = $b->conn->query($cq);

$bq = "SELECT * FROM `brands`";
$bresult = $b->conn->query($bq);

$tq = "SELECT DISTINCT(Tags) FROM `product`";
$tresult = $b->conn->query($tq);

?>
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- page wrapper start -->
<div class="page-main-wrapper">
    <div class="container">
        <div class="row">
            <!-- sidebar start -->
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="shop-sidebar-wrap mt-md-28 mt-sm-28">
                    <!-- sidebar categorie start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-category">
                            <ul>
                                <li class="title"><i class="fa fa-bars"></i> categories</li>
                                <?php
                                while ($crow = mysqli_fetch_assoc($cresult)) {
                                    $pquery = "SELECT COUNT(`pro_id`) as total FROM `product` WHERE `pro_cat_id`=" . $crow['cat_id'];
                                    $presult = $b->conn->query($pquery);
                                    $prow = mysqli_fetch_assoc($presult);
                                ?>
                                    <li><a href="products.php?cat_id=<?php echo $crow['cat_id']; ?>"><?php echo $crow['cat_name']; ?></a><span><?php echo $prow['total']; ?></span></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- sidebar categorie start -->

                    <!-- manufacturer start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>Brands</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <ul>
                                <?php
                                while ($brow = mysqli_fetch_assoc($bresult)) {
                                    $bpquery = "SELECT COUNT(`pro_id`) as total FROM `product` WHERE `brand_id`=" . $brow['brand_id'];
                                    $bpresult = $b->conn->query($bpquery);
                                    $bprow = mysqli_fetch_assoc($bpresult);
                                ?>
                                    <li><i class="fa fa-angle-right"></i><a href="products.php?brand_id=<?php echo $brow['brand_id']; ?>"><?php echo $brow['brand_name']; ?></a><span>(<?php echo $bprow['total']; ?>)</span></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- manufacturer end -->

                    <!-- pricing filter start -->
                    <!-- <div class="sidebar-widget mb-30">
                                <div class="sidebar-title mb-10">
                                    <h3>filter by price</h3>
                                </div>
                                <div class="sidebar-widget-body">
                                    <div class="price-range-wrap">
                                        <div class="price-range" data-min="50" data-max="400"></div>
                                        <div class="range-slider">
                                            <form action="#" class="d-flex justify-content-between">
                                                <button class="filter-btn">filter</button>
                                                <div class="price-input d-flex align-items-center">
                                                    <label for="amount">Price: </label>
                                                    <input type="text" id="amount">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                    <!-- pricing filter end -->

                    <!-- product size start -->
                    <!-- <div class="sidebar-widget mb-30">
                                <div class="sidebar-title mb-10">
                                    <h3>size</h3>
                                </div>
                                <div class="sidebar-widget-body">
                                    <ul>
                                        <li><i class="fa fa-angle-right"></i><a href="#">s</a><span>(10)</span></li>
                                        <li><i class="fa fa-angle-right"></i><a href="#">m</a><span>(12)</span></li>
                                        <li><i class="fa fa-angle-right"></i><a href="#">l</a><span>(20)</span></li>
                                        <li><i class="fa fa-angle-right"></i><a href="#">XL</a><span>(12)</span></li>
                                    </ul>
                                </div>
                            </div> -->
                    <!-- product size end -->

                    <!-- product tag start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>tags</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <div class="product-tag">
                                <?php
                                while ($trow = mysqli_fetch_assoc($tresult)) {
                                ?>
                                    <a href="#"><?php echo $trow['Tags']; ?></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- product tag end -->

                    <!-- sidebar banner start -->
                    <div class="sidebar-widget mb-30">
                        <div class="img-container fix img-full">
                            <a href="#"><img src="assets/img/banner/banner_shop.jpg" alt=""></a>
                        </div>
                    </div>
                    <!-- sidebar banner end -->
                </div>
            </div>
            <!-- sidebar end -->

            <!-- product main wrap start -->
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="shop-banner img-full">
                    <img src="assets/img/banner/banner_static1.jpg" alt="">
                </div>
                <!-- product view wrapper area start -->
                <div class="shop-product-wrapper pt-34">
                    <!-- shop product top wrap start -->
                    <div class="shop-top-bar">
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="top-bar-left">
                                    <div class="product-view-mode mr-70 mr-sm-0">
                                        <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                        <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                                    </div>
                                    <div class="product-amount">
                                        <p>Showing 1–16 of 21 results</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <div class="top-bar-right">
                                    <div class="product-short">
                                        <p>Sort By : </p>
                                        <select class="nice-select" name="sortby" onchange="sortby()" id="sort">
                                            <option value="trending">Relevance</option>
                                            <option value="name_asc">Name (A - Z)</option>
                                            <option value="name_dsc">Name (Z - A)</option>
                                            <option value="price_low">Price (Low &gt; High)</option>
                                            <option value="rating">Rating (Lowest)</option>
                                            <option value="model-asc">Model (A - Z)</option>
                                            <option value="model-dec">Model (Z - A)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop product top wrap start -->

                    <!-- product item start -->
                    <div class="shop-product-wrap grid row">
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            $count = 1;
                            $iq = "SELECT * FROM `product_images` where pro_id=" . $row['pro_id'] . " LIMIT 1";
                            $iresult = $b->conn->query($iq);
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <!-- product single grid item start -->
                                <div class="product-item fix mb-30">
                                    <div class="product-thumb">
                                        <a href="product_details.php?id=<?php echo $row['pro_id'] ?>">
                                            <?php
                                            if (mysqli_num_rows($iresult) == 0) {
                                            ?>
                                                <img src="assets/img/banner/banner_shop.jpg" class="img-pri" alt="" height="200px">
                                                <img src="assets/img/banner/banner_shop.jpg" class="img-sec" alt="" height="200px">
                                                <?php
                                            } else {
                                                while ($irow = mysqli_fetch_assoc($iresult)) {
                                                ?>
                                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" class="img-pri" alt="" height="200px">
                                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" class="img-sec" alt="" height="200px">
                                            <?php
                                                }
                                            }
                                            ?>
                                        </a>
                                        <?php
                                        if ($row['is_hot'] == "Yes") {
                                        ?>
                                            <div class="product-label">
                                                <span>hot</span>
                                            </div>
                                        <?php } ?>
                                        <div class="product-action-link">
                                            <a href="#" onclick="modal_quick(<?php echo $row['pro_id'] ?>)"> <span data-toggle="tooltip" data-placement="left" title="Quick view"><i class="fa fa-search"></i></span> </a>
                                            <a href="add_wishlist.php?id=<?php echo $row['pro_id']; ?>" data-toggle="tooltip" data-placement="left" title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="left" title="Compare"><i class="fa fa-refresh"></i></a>
                                            <?php
                                            if ($row['is_hot'] == "Yes")
                                            ?>
                                            <a href="addCart.php?id=<?php echo $row['pro_id']; ?>" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4><a href="product_details.php?id=<?php echo $row['pro_id'] ?>"><?php echo $row['pro_name']; ?></a></h4>
                                        <div class="pricebox">
                                            <span class="regular-price"><?php
                                                                        if ($_SESSION['role'] == "dropshipper") {
                                                                            $id = $_SESSION['dropshipper'];


                                                                            $qu = "SELECT * FROM `dropshipper` WHERE `d_id`=".$_SESSION['dropshipper'];
                                                                            $res = $b->conn->query($qu);
                                                                            $r = mysqli_fetch_assoc($res);
                                                                            echo "<del>" . $row['pro_price'] . "</del> &nbsp;&nbsp;&nbsp;";
                                                                            echo $row['pro_price'] - $row['pro_price'] * ($r['d_discount_per'] / 100);
                                                                        } else if ($_SESSION['role'] == "wholeseller") {
                                                                            $id = $_SESSION['wholeseller'];

                                                                            $qu = "SELECT * FROM `wholeseller` WHERE `w_id`='$id'";
                                                                            $res = $b->conn->query($qu);
                                                                            $r = mysqli_fetch_assoc($res);

                                                                            if ($r['w_discount1'] != null) {
                                                                               
                                                                                echo "Item : " . "10" . " Price : " . ($row['pro_price'] - $row['pro_price'] * ($r['w_discount1'] / 100)) . "<br>";
                                                                            }
                                                                            if ($r['w_discount2'] != null) {
                                                                                echo "Item : " . "20" . " Price : " . ($row['pro_price'] - $row['pro_price'] * ($r['w_discount2'] / 100)) . "<br>";

                                                                            }

                                                                            if ($r['w_discount3'] != null) {
                                                                                echo "Item : " . "30" . " Price : " . ($row['pro_price'] - $row['pro_price'] * ($r['w_discount3'] / 100)) . "<br>";

                                                                            }
                                                                        } else {
                                                                            echo $row['pro_price'];
                                                                        }
                                                                        ?>
                                            </span>
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
                            </div>
                            <!-- product single column end -->
                        <?php } ?>
                    </div>
                    <!-- product item end -->
                </div>
                <!-- product view wrapper area end -->

                <!-- start pagination area -->
                <div class="paginatoin-area text-center pt-28">
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination-box">
                                <li><a class="Previous" href="#">Previous</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a class="Next" href="#"> Next </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end pagination area -->

            </div>
            <!-- product main wrap end -->
        </div>
    </div>
</div>
<script>
    function sortby() {
        location.href = `products.php?sortby=${document.getElementById('sort').value}`
    }
</script>
<!-- page wrapper end -->
<?php
include('footer.php');
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php
if (isset($_GET['email_duplicate'])) {
    echo "<script>Swal.fire(
        'Email Error!',
        'Email Already Registered!',
        'error'
      )</script>";
}
if (isset($_GET['addedtocart'])) {
    echo "<script>Swal.fire({
        title: 'Product Added',
        html: 'Operation Success',
        timer: 2000,
        timerProgressBar: false,
        didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
          }, 100)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log('I was closed by the timer')
        }
      })</script>";
}
if (isset($_GET['already'])) {
    echo "<script>Swal.fire({
        title: 'Product Already In Cart',
        html: 'Operation Failed',
        timer: 2000,
        timerProgressBar: false,
        didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
          }, 100)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log('I was closed by the timer')
        }
      })</script>";
}
?>