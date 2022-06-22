<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
$product_code_auto = rand(1,1000);
$pro_d = "D".$product_code_auto;
$q="select * from product where pro_code='$pro_d'";
$results=$b->conn->query($q);
$num = mysqli_num_rows($results);
print_r($num);
if($num > 0)
{
    $product_code_auto_one =  rand(1,30);
    $product_code_auto = $product_code_auto + $product_code_auto_one;
    echo  $product_code_auto;
    $pro_d = "D".$product_code_auto;
    echo  $pro_d;

}
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
                        <li class="breadcrumb-item active">Add Product</li>
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
                <a href="view_products.php"><button type="button" class="btn btn-success">
                        View Products
                    </button></a>
                <div class="card-header">
                    <h3 class="card-title"> Product</h3>
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

                    <form method="post" action="../Database/product.php" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- form start -->
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">Product Code</label>
                                    <input type="text" class="form-control" value="<?php echo $pro_d?>" id="pro_code" name="pro_code" placeholder="Enter Product Code" required readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label >EAN Number</label>
                                    <input type="text" class="form-control" name="ean_no" placeholder="Enter EAN" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Product Name</label>
                                    <input type="text" class="form-control"  name="pro_name" placeholder="Enter Product Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Category Prefix</label>
                                    <?php
                                    $b->select("category", "*");
                                    $result = $b->sql;
                                    ?>
                                    <select class="form-control select2bs4" style="width: 100%;" name="pro_cat_id" id="pro_cat_id" onchange="sku_d()">
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=<?php echo $row['cat_id']; ?>><?php echo $row['cat_prefix']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">SKU</label>
                                    <input type="text" class="form-control" id="sku" readonly name="sku" placeholder="Enter SKU" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Product TAX</label>
                                    <input type="text" class="form-control"  name="pro_tax" placeholder="Enter Product Tax" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Supplier Name</label>
                                    <?php
                                    $b->select("supplier", "*");
                                    $result = $b->sql;
                                    ?>
                                    <select class="form-control select2bs4" style="width: 100%;" name="pro_supplier">
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=<?php echo $row['sup_id']; ?>><?php echo $row['sup_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Discount Type</label>
                                    <input type="text" class="form-control"  name="pro_discount" value="Percentage" readonly>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Maximum Discount</label>
                                    <input type="text" class="form-control"  name="discount_per" placeholder="Enter Maximum Discount %" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Product Cost</label>
                                    <input type="text" class="form-control"  name="pro_cost" placeholder="Enter Product Cost" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Product Price</label>
                                    <input type="text" class="form-control"  name="pro_price" placeholder="Enter Product Price" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Brand Name</label>
                                    <?php
                                    $b->select("brands", "*");
                                    $result = $b->sql;
                                    ?>
                                    <select class="form-control select2bs4" style="width: 100%;" name="brand_id">
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=<?php echo $row['brand_id']; ?>><?php echo $row['brand_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Shipping Charges</label>
                                    <input type="text" class="form-control" name="shipping" placeholder="Enter Shipping Charges" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">New Arrivals</label>
                                    <select  class="form-control" name="new_arrival">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Barcode Symbology</label>
                                    <input type="text" class="form-control" name="barcode" placeholder="Enter Barcode Symbology" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Is Featured</label>
                                    <select  class="form-control" name="is_featured">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Is Hot</label>
                                    <select  class="form-control" name="is_hot">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Tags</label>
                                    <select class="select2bs4" multiple="multiple" name="Tags" data-placeholder="Select a State" style="width: 100%;">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Product Details
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <textarea id="summernote" name="pro_details">
                                                Place <em>some</em> <u>text</u> <strong>here</strong>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Product Full Details
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <textarea id="summernote1" name="pro_full_details">
                                                Place <em>some</em> <u>text</u> <strong>here</strong>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                <label>Product Images</label>
                                 <div id="coba" name='fileUpload[]'>
                                 </div>    
                               
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;" name="btnSave" value="Submit" />
                        </div>
                    </form>
                </div>

                <!-- /.card -->
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
<script>

 function sku_d()
 {
    var cat_id = $('#pro_cat_id').find(":selected").text();

     var pro_code = document.getElementById('pro_code').value;
    var sku = cat_id + pro_code;
    console.log(sku);
    document.getElementById('sku').value = sku;
 }
</script>
<?php

include('footer.php');
?>
