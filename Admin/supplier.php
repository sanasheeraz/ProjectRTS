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
    
        
        $('#btnUpdate').click(function(){
            var sid=$('#s_id').val();
            var name=$('#s_name').val();
            var code=$('#s_code').val();
            

            //var b_image=$('#b_image').val();
            if(name=="")
            {
                $('#nameerr').html("Please fill the field");
            }else{
                $('#nameerr').html("");
            }
         
            if(name!="")
            {
                $.ajax({
                    url:'editsup.php',
                    type:'post',
                    data:{btnSubmit:1,id:sid,name:name,code:code},
                    success: function(response){
                        alert("Updation Done");
                        clearAll();
                        window.location.reload();
                    },
                    error: function(){
                        alert("Updation Failed");
                    }
                });
            }
        });
        $(document).on('click','#btnEdit',function(){
            var row=$(this).closest("tr").find("td");
            $('#s_id').val(row[0].innerText);
            $('#s_name').val(row[1].innerText);
            $('#s_code').val(row[2].innerText);

            
            $('#btnSave').hide();
            $('#btnUpdate').show();
        });
        function clearAll()
        {
            $('#s_name').val('');
            $('#s_location').val('');
            $('#nameerr').html('');
            $('#locerr').html('');
        }
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
                        <li class="breadcrumb-item active">Add Supplier</li>
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
                    <h3 class="card-title">Supplier</h3>

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

                        <form method="post" action="../Database/suppliers.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <!-- form start -->
                                <div class="form-group">
                                    <input type="hidden" id="s_id">
                                    <label for="exampleInputEmail1">Supplier Name</label>
                                    <input type="text" class="form-control" id="s_name" name="s_name" placeholder="Enter Supplier name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Supplier Code</label>
                                    <input type="text" class="form-control" id="s_code" name="s_code" placeholder="Enter Supplier Code" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Supplier Image</label>
                                    <input type="file" class="form-control" id="s_image" name="s_image">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;" name="btnSave" id="btnSave" value="Submit" />
                            <input type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;display:none" id="btnUpdate" name="btnUpdate" value="Update" />

                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Suppliers</h3>
                </div>
                <?php

                $b->select("supplier", "*","`sup_status`='Active'");
                $result = $b->sql;
                ?>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="storeData" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Supplier Id</th>
                                <th>Supplier Name</th>
                                <th>Supplier Code</th>
                                <th>Supplier Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                <td><?php echo $row['sup_id']; ?></td>
                                    <td><?php echo $row['sup_name']; ?></td>
                                    <td><?php echo $row['sup_code']; ?></td>
                                    <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['sup_image']); ?>" width="80px" height="80px"/> </td>
                                    <?php
        echo "<td><a  id='btnEdit'><i class='fas fa-edit'></i></a></th>";?>
                                    <a href="../Database/suppliers.php?id=<?php echo $row['sup_id'];?>&Delete='true'"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Supplier Name</th>
                                <th>Supplier Code</th>
                                <th>Supplier Image</th>
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