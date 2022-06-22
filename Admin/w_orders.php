<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
$q="SELECT * FROM `wholeseller_order` join `wholeseller` on `wholeseller_order`.`wholeseller_id`=`wholeseller`.`w_id`";
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
                        <li class="breadcrumb-item active">View wholeseller Orders</li>
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
                    <h3 class="card-title">wholeseller Orders</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>wholeseller Name</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['wholeseller_order_id']; ?></td>
                                    <td><?php echo $row['w_firstname']." ".$row['w_lastname']; ?></td>
                                    <td><?php echo $row['wholeseller_order_date']; ?></td>
                                    <td><?php echo $row['total_amount']; ?></td>
                                    <td><a href="order_detail_w.php?id=<?php echo $row['wholeseller_order_id'];  ?>" class="btn btn-success">Detail</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                                <th>Order Id</th>
                                <th>wholeseller Name</th>
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