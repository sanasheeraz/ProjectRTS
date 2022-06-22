 <!-- brand area start -->
 <div class="brand-area pt-28 pb-30">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="section-title mb-30">
                     <div class="title-icon">
                         <i class="fa fa-crop"></i>
                     </div>
                     <h3>Popular Brand</h3>
                 </div> <!-- section title end -->
             </div>
         </div>
         <div class="row">
             <div class="col-12">
                 <div class="brand-active slick-padding slick-arrow-style">
                     <?php
                        $b->select("brands", "*","`brand_status`='Active'");
                        $result = $b->sql;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                         <div class="brand-item text-center">
                             <a href="#"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['brand_logo']); ?>" alt="" height="40px" /></a>
                         </div>
                     <?php } ?>


                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- brand area end -->
 <!-- footer area start -->
 <footer>
     <!-- footer top start -->
     <!-- <div class="footer-top bg-black pt-14 pb-14">
                <div class="container">
                    <div class="footer-top-wrapper">
                        <div class="newsletter__wrap">
                            <div class="newsletter__title">
                                <div class="newsletter__icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="newsletter__content">
                                    <h3>sign up for newsletter</h3>
                                    <p>Duis autem vel eum iriureDuis autem vel eum</p>
                                </div>
                            </div>
                            <div class="newsletter__box">
                                <form id="mc-form">
                                    <input type="email" id="mc-email" autocomplete="off" placeholder="Email">
                                    <button id="mc-submit">subscribe!</button>
                                </form>
                            </div>
                           
                            <div class="mailchimp-alerts">
                                <div class="mailchimp-submitting"></div>
                                <div class="mailchimp-success"></div>
                                <div class="mailchimp-error"></div>
                            </div>
                            
                        </div>
                        <div class="social-icons">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div> -->
     <!-- footer top end -->
<hr>
     <!-- footer main start -->
     <div class="footer-widget-area pt-40 pb-38 pb-sm-4 pt-sm-30 ">
         <div class="container">
             <div class="row">
                 <div class="col-md-4 col-sm-4">
                     <div class="footer-widget mb-sm-26">
                         <div class="widget-title mb-10 mb-sm-6">
                             <h4>contact us</h4>
                         </div>
                         <div class="widget-body">
                             <ul class="location">
                                 <li><i class="fa fa-envelope"></i>support@galio.com</li>
                                 <li><i class="fa fa-phone"></i>(800) 0123 456 789</li>
                                 <li><i class="fa fa-map-marker"></i>Address: Unit B3/2/D Trump House <br> 15 Edison Street <br> Glasgow,Glasgow G52 4JW GB</li>
                             </ul>
                             <a class="map-btn" href="contact-us.html">open in google map</a>
                         </div>
                     </div> <!-- single widget end -->
                 </div> <!-- single widget column end -->
                 <div class="col-md-4 col-sm-4">
                     <div class="footer-widget mb-sm-26">
                         <div class="widget-title mb-10 mb-sm-6">
                             <h4>my account</h4>
                         </div>
                         <div class="widget-body">
                             <ul>
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
                                        <li><a href="login-register.php">LogIn / Register</a></li>
                                        <li><a href="WholesellerRegister.php">Wholeseller login</a></li>
                                        <li><a href="DropshipperRegister.php">DropShipper login</a></li>
                                 <?php
                                        }
                                       ?>
                             </ul>
                         </div>
                     </div> <!-- single widget end -->
                 </div> <!-- single widget column end -->
                 <div class="col-md-4 col-sm-4">
                     <div class="footer-widget mb-sm-26">
                         <div class="widget-title mb-10 mb-sm-6">
                             <h4>RTS</h4>
                         </div>
                         <div class="widget-body">
                             <ul>
                                 <li><a href="index.php">Home</a></li>
                                 <li><a href="brands.php">Brands</a></li>
                                <li><a href="faqs.php">FAQs</a></li>
                                <li><a href="about.php">About us</a></li>
                                <li><a href="contact.php">Contact us</a></li>
                             </ul>
                         </div>
                     </div> <!-- single widget end -->
                 </div> <!-- single widget column end -->
                 
             </div>
         </div>
     </div>
     <!-- footer main end -->

     <!-- footer bootom start -->
     <div class="footer-bottom-area bg-gray pt-20 pb-20">
         <div class="container">
             <div class="footer-bottom-wrap">
                 <div class="copyright-text">
                     <p><a target="_blank" href="index.php">RTS</a></p>
                 </div>
                 <div class="payment-method-img">
                     <img src="assets/img/payment.png" alt="">
                 </div>
             </div>
         </div>
     </div>
     <!-- footer bootom end -->

 </footer>
 <!-- footer area end -->

 </div>


 <!-- Quick view modal start -->
 <div class="modal" id="quick_view">
 <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content" id="modal_c">
         </div>
 </div>
 <!-- Quick view modal end -->

 <!-- Scroll to top start -->
 <div class="scroll-top not-visible">
     <i class="fa fa-angle-up"></i>
 </div>
 <!-- Scroll to Top End -->
<script>

function modal_quick(pro_id){
    console.log("test");
    var pro_id= pro_id;
    $.ajax({
        url: "quick_view.php",
        type: "post",
        data: {'proid' : pro_id },
        success: function (response) {
            document.getElementById('modal_c').innerHTML=response;
            $('#quick_view').modal('show');

           // You will get response from your PHP page (what you echo or print)
        },
        error: function(err) {
           console.log(err);
        }
    });
}
function search()
{
   var val= document.getElementById('search').value;
   location.href = `products.php?search=${val}`;
   console.log(val)
}
</script>



 <!--All jQuery, Third Party Plugins & Activation (main.js) Files-->
 <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
 <!-- Jquery Min Js -->
 <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
 <!-- Popper Min Js -->
 <script src="assets/js/vendor/popper.min.js"></script>
 <!-- Bootstrap Min Js -->
 <script src="assets/js/vendor/bootstrap.min.js"></script>
 <!-- Plugins Js-->
 <script src="assets/js/plugins.js"></script>
 <!-- Ajax Mail Js -->
 <script src="assets/js/ajax-mail.js"></script>
 <!-- Active Js -->
 <script src="assets/js/main.js"></script>
 <!-- Switcher JS [Please Remove this when Choose your Final Projct] -->
 <script src="assets/js/switcher.js"></script>

 </body>


 </html>