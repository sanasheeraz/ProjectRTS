<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
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
                        <li class="breadcrumb-item active">Add Category</li>
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
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Category</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <!-- /.card-header -->
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <form method="post" action="../Database/categories.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <!-- form start -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="c_name" placeholder="Enter Category name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category Prefix</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="c_prefix" placeholder="Enter Category Prefix" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category Store</label>
                                    <?php
                                    $b->select("store", "*");
                                    $result = $b->sql;
                                    ?>
                                    <select class="form-control select2bs4" style="width: 100%;" name="c_store">
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>    
                                        <option value=<?php echo $row['store_id']; ?>><?php echo $row['store_name']; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category Image</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1" name="c_image">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;" name="btnSave" value="Submit" />

                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                </div>
                <?php

                $b->select("category", "*");
                $result = $b->sql;
                ?>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="storeData" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Category Prefix</th>
                                <th>Category Store</th>
                                <th>Category Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['cat_name']; ?></td>
                                    <td><?php echo $row['cat_prefix']; ?></td>
                                    <td><?php echo $row['cat_store']; ?></td>
                                    <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['cat_image']); ?>" width="80px" height="80px"/> </td>
                                    <?php
        echo "<td><a href='editcat.php?id=".$row['cat_id']."'><i class='fas fa-edit'></i></a></th>";?>
                                    <a href="../Database/categories.php?id=<?php echo $row['cat_id'];?>&Delete='true'"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Category Name</th>
                                <th>Category Prefix</th>
                                <th>Category Store</th>
                                <th>Category Image</th>
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