<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
$q="SELECT * FROM `w_invoice` where w_order_id=".$_GET['id'];
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
                        <li class="breadcrumb-item active">View Dropshipper Orders</li>
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
                    <h3 class="card-title">Dropshipper Orders Detail</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <?php 
                                    $query_p_code = mysqli_query($b->conn,"select * from product where pro_id=".$row['p_id']);
                                    $query_gen = mysqli_fetch_row($query_p_code);
                                    ?>
                                    <td><?php echo $query_gen[1];  ?></td>
                                    <td><?php echo $row['p_name'];?></td>
                                    <td><?php echo $row['p_quantity']; ?></td>
                                    <td><?php echo $row['p_price']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                        <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
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