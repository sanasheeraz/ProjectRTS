<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
$q = "SELECT * FROM `wholeseller`";
if (isset($_GET['data'])) {
    if ($_GET['data'] == "Pending")
        $q = "SELECT * FROM `wholeseller` where `status`='Pending'";

    if ($_GET['data'] == "Approved")
        $q = "SELECT * FROM `wholeseller` where `status`='Approved'";
}
$result = $b->conn->query($q);
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
                        <li class="breadcrumb-item active">View Wholeseller</li>
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
                    <h3 class="card-title">Wholeseller</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="storeData" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Contact No.</th>
                                <th>Set Percentage</th>
                                <th>Actions</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['w_firstname']; ?></td>
                                    <td><?php echo $row['w_lastname']; ?></td>
                                    <td><?php echo $row['w_email']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['w_contact']; ?></td>
                                    <td><input type="button" value="Set %" onclick="setper(<?php echo $row['w_id']; ?>,<?php echo ($row['w_discount1'] == '' ? 0 : $row['w_discount1']); ?>,<?php echo ($row['w_discount2'] == '' ? 0 : $row['w_discount2']); ?>,<?php echo ($row['w_discount3'] == '' ? 0 : $row['w_discount3']); ?>)"></td>

                                    <td>
                                        <?php
                                        if ($row['status'] == "Pending") { ?>
                                            <a href="editWholeSeller.php?id=<?php echo $row['w_id']; ?>" class="btn btn-success">Approved</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="editWholeSeller.php?dec_id=<?php echo $row['w_id']; ?>" class="btn btn-danger">Decline</a>

                                        <?php
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <a href="editWholeSeller.php?del_id=<?php echo $row['w_id']; ?>" class="btn btn-danger">Delete</a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Contact No.</th>
                                <th>Set Percentage</th>

                                <th>Actions</th>
                                <th>Delete</th>

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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Percentage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="frm1">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="w_id" name="w_ids">
                        <label for="exampleInputEmail1">Percentage One</label>
                        <input type="number" class="form-control" id="percen1" name="percen1" aria-describedby="emailHelp" placeholder="Enter Percentage">
                        <small id="emailHelp" class="form-text text-muted">Enter First Discount Percentage for 10 products</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Percentage Two</label>
                        <input type="number" class="form-control" id="percen2" name="percen2" aria-describedby="emailHelp" placeholder="Enter Percentage">
                        <small id="percen2" class="form-text text-muted">Enter Second Discount Percentage for 20 products</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Percentage Three</label>
                        <input type="number" class="form-control" id="percen3" name="percen3" aria-describedby="emailHelp" placeholder="Enter Percentage">
                        <small id="emailHelp" class="form-text text-muted">Enter Third Discount Percentage for 30 products</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_per" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script>
    function setper(w_id,p1,p2,p3) {
        $('#exampleModal').modal('show');
        console.log(w_id);
        console.log(p1);
        console.log(p2);
        console.log(p3);
        document.getElementById('percen1').value = p1;
        document.getElementById('percen2').value = p2;
        document.getElementById('percen3').value = p3;
        document.getElementById('w_id').value = w_id;

    }
</script>
<?php 
if(isset($_POST['btn_per']))
{
    $w_id=$_POST['w_ids'];
    $percen3=$_POST['percen3'];
    $percen2=$_POST['percen2'];
    $percen1=$_POST['percen1'];
    $query_up="UPDATE `wholeseller` SET w_discount1='$percen1',w_discount2='$percen2',w_discount3='$percen3' where w_id='$w_id'";
    $exe = $b->conn->query($query_up);
    echo "<script>window.location.href='wholeseller.php'</script>";
}
?>
<?php

include('footer.php');
?>