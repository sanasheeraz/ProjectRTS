<?php
session_start();
if(!isset($_SESSION["admin"]))
{
  header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$db=new Database();

$drow=mysqli_fetch_assoc($db->conn->query("SELECT COUNT(*) as Total FROM `dropshipper_order` "));
$rrow=mysqli_fetch_assoc($db->conn->query("SELECT COUNT(*) as Total FROM `retailer_order`"));
$wrow=mysqli_fetch_assoc($db->conn->query("SELECT COUNT(*) as Total FROM `wholeseller_order`"));

$Total_Orders=$drow['Total']+$wrow['Total']+$rrow['Total'];

$dtrow=mysqli_fetch_assoc($db->conn->query("SELECT COUNT(*) as Total FROM `dropshipper`"));
$rtrow=mysqli_fetch_assoc($db->conn->query("SELECT COUNT(*) as Total FROM `customer`"));
$wtrow=mysqli_fetch_assoc($db->conn->query("SELECT COUNT(*) as Total FROM `wholeseller`"));

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $Total_Orders;?></h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $dtrow['Total'];?></h3>

                <p>Dropshippers</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="dropshipper.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $rtrow['Total'];?></h3>

                <p>Retailer</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="retailer.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $wtrow['Total'];?></h3>

                <p>WholeSeller</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="wholeseller.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php
include('footer.php');
?>