<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database();
$id = $_GET['id'];
$q = "SELECT * FROM `product` p join `supplier` s on p.pro_supplier=s.sup_id join `category` c ON p.pro_cat_id=c.cat_id join `store` on `store`.`store_id`=c.`cat_store` join `brands` b ON p.brand_id=b.brand_id where pro_id='$id'";
$result = $b->conn->query($q);
$row = mysqli_fetch_assoc($result);
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

                    <form method="post" id="edit_form" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="exampleInputEmail1" name="pro_id" placeholder="Enter Product Code" value="<?php echo $row['pro_id']; ?>" required>

                        <div class="card-body">
                            <!-- form start -->
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">Product Code</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="pro_code" placeholder="Enter Product Code" value="<?php echo $row['pro_code']; ?>" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>EAN Number</label>
                                    <input type="text" class="form-control" name="ean_no" placeholder="Enter EAN" value="<?php echo $row['ean_no']; ?>" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Product Name</label>
                                    <input type="text" class="form-control" name="pro_name" placeholder="Enter Product Name" value="<?php echo $row['pro_name']; ?>" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Category Prefix</label>
                                    <?php

                                    $b->select("category", "*");
                                    $result = $b->sql;
                                    ?>
                                    <select class="form-control select2bs4" style="width: 100%;" id="pro_cat_id">
                                        <?php while ($row_cat = mysqli_fetch_assoc($result)) {
                                            if ($row_cat['cat_id'] == $row['pro_cat_id']) { ?>
                                                <option value=<?php echo $row_cat['cat_id']; ?> selected><?php echo $row_cat['cat_prefix']; ?></option>
                                        <?php } else {
                                                echo "<option value= " . $row_cat['cat_id'] . ">" . $row_cat['cat_prefix'] . "</option>";
                                            }
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">SKU</label>
                                    <input type="text" class="form-control" name="sku" placeholder="Enter SKU" value="<?php echo $row['sku'] ?>" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Product TAX</label>
                                    <input type="text" class="form-control" name="pro_tax" placeholder="Enter Product Tax" value="<?php echo $row['pro_tax'] ?>" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Supplier Name</label>
                                    <?php
                                    $b->select("supplier", "*");
                                    $result = $b->sql;
                                    ?>
                                    <select class="form-control select2bs4" style="width: 100%;" id="pro_supplier">
                                        <?php while ($row_supplier = mysqli_fetch_assoc($result)) {
                                            if ($row_supplier['sup_id'] == $row['pro_supplier']) {
                                        ?>
                                                <option value=<?php echo $row_supplier['sup_id']; ?> selected><?php echo $row_supplier['sup_name']; ?></option>
                                            <?php } else {
                                            ?>
                                                <option value=<?php echo $row_supplier['sup_id']; ?>><?php echo $row_supplier['sup_name']; ?></option>

                                        <?php
                                            }
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Discount Type</label>
                                    <input type="text" class="form-control" name="pro_discount" placeholder="Enter Discount Type" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Maximum Discount</label>
                                    <input type="text" class="form-control" value=<?php echo $row['discount_per'] ?> name="discount_per" placeholder="Enter Maximum Discount" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Product Cost</label>
                                    <input type="text" class="form-control" value=<?php echo $row['pro_cost'] ?> name="pro_cost" placeholder="Enter Product Cost" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Product Price</label>
                                    <input type="text" class="form-control" value="<?php echo $row['pro_price'] ?>" name="pro_price" placeholder="Enter Product Price" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Brand Name</label>
                                    <?php
                                    $b->select("brands", "*");
                                    $result = $b->sql;
                                    ?>
                                    <select class="form-control select2bs4" style="width: 100%;" id="brand_id">
                                        <?php while ($row_brand = mysqli_fetch_assoc($result)) {
                                            if ($row_brand['brand_id'] == $row['brand_id']) {
                                        ?>
                                                <option value=<?php echo $row_brand['brand_id']; ?> selected><?php echo $row_brand['brand_name']; ?></option>
                                        <?php }
                                        else 
                                        {
                                            ?>
                                    <option value=<?php echo $row_brand['brand_id']; ?> ><?php echo $row_brand['brand_name']; ?></option>

                                            <?php
                                        }
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Shipping Charges</label>
                                    <input type="text" class="form-control" name="shipping" placeholder="Enter Category Prefix" required value="<?php echo $row['shipping']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">New Arrivals</label>
                                    <input type="text" class="form-control" name="new_arrival" placeholder="New Arrivals" required value="<?php echo $row['new_arrival']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Barcode Symbology</label>
                                    <input type="text" class="form-control" name="barcode" placeholder="Enter Category Prefix" required >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Is Featured</label>
                                    <input type="text" class="form-control" name="is_featured" placeholder="Is Featured" required value="<?php echo $row['is_featured']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Is Hot</label>
                                    <input type="text" class="form-control" name="is_hot" placeholder="Enter Category Prefix" required value="<?php echo $row['is_hot']?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Tags</label>
                                    <select class="select2bs4" multiple="multiple" id="Tags" data-placeholder="Select a State" style="width: 100%;">
                                        
                                        <option value="Alabama" <?php echo ($row['Tags'] == 'Alabama' ? "selected" : "");?>>Alabama</option>
                                        <option value="Alaska "<?php echo ($row['Tags'] == 'Alaska' ? "selected" : "");?>>Alaska</option>
                                        <option value="California" <?php echo ($row['Tags'] == 'California' ? "selected" : "");?>>California</option>
                                        <option value="Delaware" <?php echo ($row['Tags'] == 'Delaware' ? "selected" : "");?>>Delaware</option>
                                        <option value="Tennessee" <?php echo ($row['Tags'] == 'Tennessee' ? "selected" : "");?>>Tennessee</option>
                                        <option value="Texas" <?php echo ($row['Tags'] == 'Texas' ? "selected" : "");?>>Texas</option>
                                        <option value="Washington" <?php echo ($row['Tags'] == 'Washington' ? "selected" : "");?>>Washington</option>
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
                                            <textarea id="summernote" >
                                                <?php echo $row['pro_details']?>
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
                                            <textarea id="summernote1" >
                                            <?php echo $row['pro_full_details']?>
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
                            <input type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;" name="btnSave_edit" value="Submit" />
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
<!-- action="../Database/edit_product.php" -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).on('submit','#edit_form',function(e){
        e.preventDefault();
        console.log("data update");
        
        var pro_id= $("input[name='pro_id']").val();               

        var pro_code= $("input[name='pro_code']").val();               
        var ean_no= $("input[name='ean_no']").val();     
        var pro_name= $("input[name='pro_name']").val();               
        var pro_cat_id= document.getElementById('pro_cat_id').value;               
        var sku= $("input[name='sku']").val(); 
        var pro_tax= $("input[name='pro_tax']").val();  
        var pro_supplier= document.getElementById('pro_supplier').value;               
        var pro_discount= $("input[name='pro_discount']").val();               
        var discount_per= $("input[name='discount_per']").val();               
        var pro_cost= $("input[name='pro_cost']").val();               
        var pro_price= $("input[name='pro_price']").val();               
        var brand_id= document.getElementById('brand_id').value;               
        
        var shipping= $("input[name='shipping']").val();               
        var new_arrival= $("input[name='new_arrival']").val();               
        var barcode= $("input[name='barcode']").val();               
        var is_featured= $("input[name='is_featured']").val();               
        var is_hot= $("input[name='is_hot']").val();               
        var Tags=document.getElementById('pro_supplier').value;    
        var pro_details= document.getElementById('summernote').value;   
        var pro_full_details=document.getElementById('summernote1').value;   
console.log(pro_id,pro_code,ean_no,pro_name,pro_cat_id)
        $.ajax({
        method:"POST",
        url: "../Database/edit_product.php",
        data:{
            pro_id:pro_id,
            pro_code : pro_code,
            ean_no:ean_no,
            pro_name:pro_name,
            pro_cat_id:pro_cat_id,
            sku:sku,
            pro_tax:pro_tax,
            pro_supplier:pro_supplier,
            pro_discount:pro_discount,
            discount_per:discount_per,
            pro_cost:pro_cost,
            pro_price:pro_price,
            brand_id:brand_id,
            shipping:shipping,
            new_arrival:new_arrival,
            barcode:barcode,
            is_featured:is_featured,
            is_hot:is_hot,
            Tags:Tags,
            pro_details:pro_details,
            pro_full_details:pro_full_details,
        },
        success: function(data){
      console.log("data_updated");
            console.log(data);
            Swal.fire(
  'Success!',
  'Product Edit Success!',
  'success'
)
    }});
        

        
    })
</script>
<?php

include('footer.php');
?>