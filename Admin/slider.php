<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
include '../Database/config.php';
$b = new Database(); 
?>
<script>

$(document).ready(function(){
        // $('#btnUpdate').click(function(){
        //     var sid=$('#b_id').val();
        //     var name=$('#b_name').val();
        //     var b_image=$('#b_image').val();
        //     if(name=="")
        //     {
        //         $('#nameerr').html("Please fill the field");
        //     }else{
        //         $('#nameerr').html("");
        //     }
         
        //     if(name!="")
        //     {
        //         $.ajax({
        //             url:'editbrands.php',
        //             type:'post',
        //             data:{btnSubmit:1,id:sid,name:name},
        //             success: function(response){
        //                 alert(response);
        //                 clearAll();
        //                 window.location.reload();
        //             },
        //             error: function(){
        //                 alert("Updation Failed");
        //             }
        //         });
        //     }
        // });
        // $(document).on('click','#btnEdit',function(){
        //     var row=$(this).closest("tr").find("td");
        //     $('#sl_id').val(row[0].innerText);
        //     $('#sl_name').val(row[1].innerText);
        //     $('#sl_discount').val(row[3].innerText);
        //     $('#sl_text').val(row[2].innerText);
        //     var img=$(this).closest("tr").find("td").find("#img1");
        //     console.log(img.innerText);
        //     //$('#sl_img').val(row[4].find("img").attr("src"));
            
          
        //     $('#btnSave').hide();
        //     $('#btnUpdate').show();
        // });
        // function clearAll()
        // {
        //     $('#s_name').val('');
        //     $('#s_location').val('');
        //     $('#nameerr').html('');
        //     $('#locerr').html('');
        // }
    });
</script>
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
                        <li class="breadcrumb-item active">Add Brand</li>
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
                    <h3 class="card-title">Slider</h3>

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
                        <form method="post" action="../Database/slider.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <!-- form start -->
                                <input type="hidden" class="form-control" id="sl_id" name="sl_id" required>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" id="sl_name" name="sl_name" placeholder="New Camera Products" required>
                                    <p id="nameerr" class="error"></p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount Description</label>
                                    <input type="text" class="form-control" id="sl_discount" name="sl_discount" placeholder="Get upto 50% discount" required>
                                    <p id="nameerr" class="error"></p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control" id="sl_text" name="sl_text" placeholder="Details about the product" required>
                                    <p id="nameerr" class="error"></p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slider Image</label>
                                    <input type="file" class="form-control" id="sl_image" name="sl_image" required>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;" name="btnSave" id="btnSave" value="Submit" />
                            <input type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;display:none" name="btnUpdate" id="btnUpdate" value="Update" />

                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Slider</h3>
                </div>
                <?php
                $result=mysqli_query($b->conn,"select * from home_slider");
                ?>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="storeData" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Discount</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                <td  style="display: none;"><?php echo $row['sl_id']; ?></td>
                                <td><?php echo $row['sl_name']; ?></td>
                                <td><?php echo $row['sl_text']; ?></td>
                                <td><?php echo $row['sl_discount']; ?></td>
                                    <td>
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['sl_image']); ?>" width="80px" height="80px" /> </td>
                                    <?php
                                   // echo "<td><i class='fas fa-edit' id='btnEdit'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
                                <td><a href="../Database/slider.php?id=<?php echo $row['sl_id'];?>&Delete='true'"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Discount</th>
                                <th>Image</th>
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