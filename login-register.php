<?php
include('header.php');
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
                                    <li class="breadcrumb-item active" aria-current="page">login-register</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="row">
                        <!-- Login Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap  pr-lg-50">
                                <h2>Log In</h2>
                                <form action="Database/customer_login.php" method="post">
                                    <div class="single-input-item">
                                        <input type="email" placeholder="Email or Username" name="email" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Enter your Password"  name="password" required />
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                    <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                                </div>
                                            </div>
                                            <a href="#" class="forget-pwd">Forget Password?</a>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="submit" value="Login" class="sqr-btn" name="btnLogin"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Content End -->

                        <!-- Register Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap mt-md-34 mt-sm-34">
                                <h2>Register Form</h2>
                                <form action="Database/customer_register.php" method="post">
                                    <div class="single-input-item">
                                        <input type="text" placeholder="Full Name" name="username" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="email" placeholder="Enter your Email" name="email" required />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <input type="password" placeholder="Enter your Password" name="password" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <input type="password" placeholder="Repeat your Password" required />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="single-input-item">
                                    <input type="submit" value="Register" class="sqr-btn" name="btnRegister"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Register Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
<?php
include('footer.php');
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php 
if(isset($_GET['email_duplicate']))
{
    echo "<script>Swal.fire(
        'Email Error!',
        'Email Already Registered!',
        'error'
      )</script>";
}
if(isset($_GET['register_sucess']))
{
    echo "<script>Swal.fire(
        'Registration Success!',
        'You Are Registered Successfully',
        'success'
      )</script>";
}
if(isset($_GET['login_falied']))
{
    echo "<script>Swal.fire(
        'Login Error!',
        'Wrong Credentials',
        'error'
      )</script>";
}
?>