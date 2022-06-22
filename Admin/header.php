<?php
if(session_id()==null)
{
  session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link rel="shortcut icon" href="../assets/img/logo/logo.jpeg" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <style>
    .error{
      color:red;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<script>
$(document).ready(function(){
 //alert("Active");
 function load_unseen_notification(view = '',sender='')
 {
  $.ajax({
   url:"notifications.php",
   method:"POST",
   data:{view:view,sender:sender},
   dataType:"json",
   success:function(data)
   {
     var total=0;
    //  alert(JSON.stringify(data));
    //$('.dropdown-menu').html(data.notification);
    if(data.dropshipper_count > 0)
    {
     $('.dropshipper').html(data.dropshipper_count);
     total+=data.dropshipper_count;
    }
    if(data.wholeseller_count > 0)
    {
     $('.wholeseller').html(data.wholeseller_count);
     total+=data.wholeseller_count;
    }
    if(data.dropshipper_order_count > 0)
    {
     $('.dropshipper-order').html(data.dropshipper_order_count);
     total+=data.dropshipper_order_count;
    }
    if(data.wholeseller_order_count > 0)
    {
     $('.wholeseller-order').html(data.wholeseller_order_count);
     total+=data.wholeseller_order_count;
    }
    $('.total-span').html(total);
    $('.total').html(total+" Notifications");
   },
  //  error:function(err)
  //  {
     
  //    alert("Failed"+JSON.stringify(err));
  //  }
  });
 }
 
 load_unseen_notification();
 
//  $('#comment_form').on('submit', function(event){
//   event.preventDefault();
//   if($('#subject').val() != '' && $('#comment').val() != '')
//   {
//    var form_data = $(this).serialize();
//    $.ajax({
//     url:"insert.php",
//     method:"POST",
//     data:form_data,
//     success:function(data)
//     {
//      $('#comment_form')[0].reset();
//      load_unseen_notification();
//     }
//    });
//   }
//   else
//   {
//    alert("Both Fields are Required");
//   }
//  });
 
 $(document).on('click', '.wo', function(){
  $('.total-span').html('');
  load_unseen_notification('yes','wo');
 });
 $(document).on('click', '.do', function(){
  $('.total-span').html('');
  load_unseen_notification('yes','do');
 });
 $(document).on('click', '.wr', function(){
  $('.total-span').html('');
  load_unseen_notification('yes','wr');
 });
 $(document).on('click', '.dr', function(){
  $('.total-span').html('');
  load_unseen_notification('yes','dr');
 });
 
 setInterval(function(){ 
  load_unseen_notification(); 
 }, 5000);
 
});
</script>
<div class="wrapper">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" >
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge total-span"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header total"></span>
          <div class="dropdown-divider"></div>
          <a href="w_orders.php" class="dropdown-item wo">
            <i class="fas fa-envelope mr-2"></i> New Woleseller's Orders
            <span class="float-right text-muted text-sm orders wholeseller-order">0 </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="d_orders.php" class="dropdown-item do">
            <i class="fas fa-envelope mr-2"></i> New Dropshipper's Orders
            <span class="float-right text-muted text-sm orders dropshipper-order">0 </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="wholeseller.php?data=Pending" class="dropdown-item wr">
            <i class="fas fa-users mr-2"></i> Wholeseller's requests
            <span class="float-right text-muted text-sm wholeseller">0 </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="dropshipper.php?data=Pending" class="dropdown-item dr">
            <i class="fas fa-file mr-2"></i> Dropshipper's Request
            <span class="float-right text-muted text-sm dropshipper">0 </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../assets/img/logo/logo.jpeg" alt="RTS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RTS Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar4.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="orders.php" class="nav-link">
              <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
              <p>
                Orders
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-truck" aria-hidden="true"></i>
              <p>
                DropShippers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dropshipper.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All DropShippers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dropshipper.php?data=Pending" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requests</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="d_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-users" aria-hidden="true"></i>
              <p>
                WholeSellers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="wholeseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All WholeSellers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="wholeseller.php?data=Pending" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requests</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="w_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-user" aria-hidden="true"></i>
              <p>
                Retailers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="retailer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Retailers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="r_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="products.php" class="nav-link">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="category.php" class="nav-link">
              <i class="fa fa-bars" aria-hidden="true"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="stores.php" class="nav-link">
              <i class="fa fa-home" aria-hidden="true"></i>
              <p>
                Stores
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="brand.php" class="nav-link">
              <i class="fa fa-tags" aria-hidden="true"></i>
              <p>
                Brands
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="supplier.php" class="nav-link">
              <i class="fa fa-address-card" aria-hidden="true"></i>
              <p>
                Suppliers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="shipping.php" class="nav-link">
            <i class="fa fa-shipping-fast" aria-hidden="true"></i>
              <p>
                Shipping 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="slider.php" class="nav-link">
            <i class="fa fa-sliders-h" aria-hidden="true"></i>

              <p>
                Slider 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-calculator" aria-hidden="true"></i>
              <p>
                Calculator
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              <p>
                LogOut
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
