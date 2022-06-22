<?php
include('header.php');
$b = new Database();
$total = 0;
if (!empty($_SESSION['cart'])) {
  $total=  $_SESSION['total_price'] ;
}
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
                            <li class="breadcrumb-item"><a href="shop-grid-left-sidebar.html">Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page">checkout</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
<!-- Credit CARD DETAILS -->
<div class="login-register-wrapper">
    <div class="container">
        <div class="member-area-from-wrap">
            <form action="checkout.php" method="post">
                <div class="row">


                    <!-- SHIPPING DETAILS -->
                    <div class="col-lg-6">
                        <div class="login-reg-form-wrap  pr-lg-50">
                            <h2>SHIPPING DETAILS</h2>
                            <div class="row">
                                <div class="col single-input-item">
                                    <label for="">FIRST NAME</label>
                                    <input type="text" placeholder="FIRST NAME" name="first_name" required>
                                </div>
                                <div class="col single-input-item">
                                    <label for="">LAST NAME</label>
                                    <input type="text" placeholder="LAST NAME" name="last_name" required>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <label>COUNTRY : </label>
                                <input type="text" placeholder="COUNTRY" name="country" required>
                            </div>
                            <div class="row">

                                <div class="col single-input-item">
                                    <label>STATE / PROVIENCE : </label>
                                    <input type="text" placeholder="STATE" name="state" required>
                                </div>
                                <div class="col single-input-item">
                                    <label for="">POSTAL CODE : </label>
                                    <input type="text" placeholder="POSTAL CODE" name="postal_code" required>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label>ADDRESS LINE 1 : </label>
                                <input type="text" placeholder="ADDRESS LINE 1 :" name="address_1" required>
                            </div>
                            <div class="single-input-item">
                                <label>ADDRESS LINE 2 :<small>(OPTIONAL)</small> </label>
                                <input type="text" placeholder="ADDRESS LINE 2 :" name="adress_line_2">
                            </div>
                            <div class="single-input-item">
                                <label>CONTACT NUMBER : </label>
                                <input type="text" placeholder="ENTER YOUR CONTACT NUMBER " name="contact_number" required />
                            </div>
                            <div class="single-input-item">
                                <label>SPECIAL NOTE : <small>(OPTIONAL)</small></label>
                                <textarea rows="5" id="note" name="note"></textarea>
                            </div>


                        </div>
                    </div>
                    <!-- Login Content End -->

                    <!-- Register Content Start -->
                    <div class="col-lg-6">

                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h3>Cart Totals</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td><input type="radio" name="payment_method" required></td>
                                            <td>PAY WITH CREDIT / DEBIT CARD</td>
                                        </tr>
                                        <tr style="cursor: pointer; ">
                                            <td><input type="radio" id="radio_2" required name="payment_method"></td>
                                            <td><label for="radio_2"> WITH PAYPAL</label></td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="payment_method" required></td>
                                            <td>CASH ON DELIVERY</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">$<?php echo $total + 70; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <input type="submit" value="PROCEED TO PAY" class="sqr-btn d-block" style="width: 100%;">
                        </div>

                    </div>


                    <!-- Register Content End -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- CARD DETAILS END -->
<!-- TOTAL  -->

<!-- TOTAL END -->
<?php
include('footer.php');
?>