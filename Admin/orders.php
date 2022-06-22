<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
$q="SELECT `dropshipper_order_id` as Order_id , `dropshipper_order_date` as Order_Date, CONCAT(`dropshipper`.`d_firstname`,' ',`dropshipper`.`d_lastname`) as Customer , `total_amount` as Total_Amount FROM `dropshipper_order` join `dropshipper` on `dropshipper_order`.`dropshipper_id`=`dropshipper`.`d_id` UNION SELECT `wholeseller_order_id`, `wholeseller_order_date`, CONCAT(`wholeseller`.`w_firstname`,' ',`wholeseller`.`w_lastname`), `total_amount` FROM `wholeseller_order` join `wholeseller` on `wholeseller_order`.`wholeseller_id`=`wholeseller`.`w_id` UNION SELECT `ret_order_id`, `ret_order_date`, `customer`.`cust_username`, `total_amount` FROM `retailer_order` join `customer` on `retailer_order`.`ret_id`=`customer`.`cust_id`";
$result=$b->conn->query($q);
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
                        <li class="breadcrumb-item active">View Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Orders</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="orderData" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Select</th>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                <td></td>

                                    <td><?php echo $row['Order_id'];  ?></td>
                                    <td><?php echo $row['Customer'];?></td>
                                    <td><?php echo $row['Order_Date']; ?></td>
                                    <td><?php echo $row['Total_Amount']; ?></td>
                                    <td><a href="#" class="btn btn-success">Status</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                        <th>Select</th>
                                <th>Order Id</th>
                                <th>Dropshipper Name</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>


        <!--/.col (left) -->
</div>
</form>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
<!-- general form elements disabled -->

<!-- /.card -->
</div>
<!--/.col (right) -->
</div>

<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include('footer.php');
?>