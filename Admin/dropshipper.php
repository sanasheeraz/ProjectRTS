<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
$q = "SELECT * FROM `dropshipper`";
if (isset($_GET['data'])) {
    if ($_GET['data'] == "Pending")
        $q = "SELECT * FROM `dropshipper` where `status`='Pending'";

    if ($_GET['data'] == "Approved")
        $q = "SELECT * FROM `dropshipper` where `status`='Approved'";
}

$result = $b->conn->query($q);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btnSet', function() {
            var id = $(this).val();
            var per = $(this).closest('tr[id=' + id + ']').find("td[id='discountp']").text();
            $('#discount').val(per);
            $('#ids').val(id);
            $('#exampleModal').modal('toggle');
        });

        //onclick of update button
        $(document).on('click', '#save', function() {
            //getting value of input box
            // var discount = $(this).closest(".modal-body").find("#discount").val();
            var discount = $("#discount").val();
            //getting hidden id 
            var ids = $("#ids").val();
            //ajax call to update
            $.ajax({
                url: 'AjaxCall.php',
                type: 'POST',
                data: {
                    'discount_update': 1,
                    'd_discount_per': discount,
                    'd_id': ids
                },
                success: function(response) {
                    console.log(response)
                    if (response) {
                        alert("Discount Percentage Updated");
                        // location.reload();
                    } else {
                        alert("There is Some issue in updating the percentage");
                    }
                },
                error: function() {
                    alert("There is Some issue in updating the percentage");
                }
            });
            $('#exampleModal').modal('toggle');
        });
    });
</script>

<!-- Modal  -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Discount Percentage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="ids" class="form-control">
                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount Percentage :</label>
                        <input type="text" class="form-control" id="discount">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save">Set</button>
            </div>
        </div>
    </div>
</div>
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
                        <li class="breadcrumb-item active">View Dropshipper</li>
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
                    <h3 class="card-title">Dropshipper</h3>
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
                                <th>Discount %</th>
                                <th>Actions</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr id="<?php echo $row['d_id']; ?>">
                                    <td><?php echo $row['d_firstname']; ?></td>
                                    <td><?php echo $row['d_lastname']; ?></td>
                                    <td><?php echo $row['d_email']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['d_contact']; ?></td>
                                    <td id="discountp"><?php echo $row['d_discount_per']; ?></td>
                                    <td>

                                        <?php
                                        if ($row['status'] == "Pending") { ?>
                                            <a href="editDropShipper.php?id=<?php echo $row['d_id']; ?>" class="btn btn-success">Approved</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="editDropShipper.php?dec_id=<?php echo $row['d_id']; ?>" class="btn btn-danger">Decline</a>

                                        <?php
                                        }
                                        ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="btnSet" value="<?php echo $row['d_id']; ?>" data-whatever="@mdo">Set %</button>
                                    </td>
                                    <td> <a href="editDropShipper.php?del_id=<?php echo $row['d_id']; ?>" class="btn btn-danger">Delete</a>
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
                                <th>Discount %</th>
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
<!-- /.content-wrapper -->

<?php

include('footer.php');
?>