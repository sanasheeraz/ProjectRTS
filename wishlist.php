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
                            <li class="breadcrumb-item active" aria-current="page">WISHLIST</li>
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
                              
                                <th class="pro-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           if (isset($_SESSION['customer'])) {
                            $query_get=mysqli_query($b->conn,"SELECT * FROM wishlist  where user_type='USER' AND id_person='".$_SESSION['customer']."'");

                           }
                           if (isset($_SESSION['wholeseller'])) {
                            $query_get=mysqli_query($b->conn,"SELECT * FROM wishlist  where user_type='WHOLESELLER'  AND id_person='".$_SESSION['wholeseller']."'");

                           }
                           if (isset($_SESSION['dropshipper'])) {
                            $query_get=mysqli_query($b->conn,"SELECT * FROM wishlist  where user_type='DROPSHIPPER'  AND id_person='".$_SESSION['dropshipper']."'");

                           }
                           while($row_wish=mysqli_fetch_assoc($query_get))
                           {
                               $count_wish= mysqli_num_rows($query_get);
                               if($count_wish > 0){
                                $sql = "SELECT * FROM product WHERE pro_id ='".$row_wish['product']."'";
                                $result=$b->conn->query($sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $iq="SELECT * FROM `product_images` where pro_id=".$row['pro_id']." LIMIT 1";
                                    $iresult=$b->conn->query($iq);
                                    $irow=mysqli_fetch_assoc($iresult);
                            ?>
                                    <tr>
                                        <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($irow['pro_image']); ?>" alt="Product" /></a></td>
                                        <td class="pro-title"><a href="product_details.php?id=<?php echo $row['pro_id']?>"><?php echo $row['pro_name'];?></a></td>
                                        <td class="pro-price"><span>Rs &nbsp;<?php echo number_format($row['pro_price'],2);?></span></td>
                                        
                                        <td class="pro-remove"><a href="remove_wishlist.php?id=<?php echo $row['pro_id'];?>"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                <?php

                                  
                                }
                            }
                            else {
                                ?>
                                <tr>
                                    <td colspan="2" class="text-center">No Item in WISHLIST</td>
                                </tr>
                            <?php
                            }
                        }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Cart Update Option -->
              
            </div>
        </div>
    </form>
      
    </div>
</div>
<!-- cart main wrapper end -->

<?php
include('footer.php');
?>