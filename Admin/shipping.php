<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header('location:login.php');
}
include('header.php');
?>
<script>
    $(document).ready(function(){
        $('#btnSave').click(function(){
            var name=$('#ship_name').val();
            var price=$('#ship_price').val();
            if(name=="")
            {
                $('#nameerr').html("Please fill the field");
            }else{
                $('#nameerr').html("");
            }
            if(price=="")
            {
                $('#locerr').html("Please fill the field");
            }else{
                $('#locerr').html("");
            }
            if(name!="" && price!="")
            {
                $.ajax({
                    url:'../Database/shipping.php',
                    type:'post',
                    data:{btnSave:1,ship_name:name,ship_price:price},
                    success: function(response){
                        alert(response);
                        clearAll();
                        window.location.reload();
                    },
                    error: function(){
                        alert("Insertion Failed");
                    }
                });
            }
        });
        
        $('#btnUpdate').click(function(){
            var sid=$('#sid').val();
            var name=$('#ship_name').val();
            var location=$('#ship_price').val();
            if(name=="")
            {
                $('#nameerr').html("Please fill the field");
            }else{
                $('#nameerr').html("");
            }
            if(location=="")
            {
                $('#locerr').html("Please fill the field");
            }else{
                $('#locerr').html("");
            }
            if(name!="" && location!="")
            {
                $.ajax({
                    url:'../Database/shipping.php',
                    type:'post',
                    data:{Edit:1,id:sid,ship_name:name,ship_price:location},
                    success: function(response){
                        alert(response);
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
            $('#sid').val(row[0].innerText);
            $('#ship_name').val(row[1].innerText);
            $('#ship_price').val(row[2].innerText);
            $('#btnSave').hide();
            $('#btnUpdate').show();
        });
        function clearAll()
        {
            $('#ship_name').val('');
            $('#ship_price').val('');
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
                        <li class="breadcrumb-item active">Add Shipping Service</li>
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
                    <h3 class="card-title">Shipping Services</h3>

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

                        <!-- <form method="post" action="../Database/stores.php"> -->
                            <div class="card-body">
                                <input type="hidden" id="sid"/>
                                <!-- form start -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Shipping Service Name</label>
                                    <input type="text" class="form-control" id="ship_name" name="ship_name" placeholder="Enter Shipping Service name" required>
                                    <p id="nameerr" class="error"></p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Shipping Service Charges</label>
                                    <input type="text" class="form-control" id="ship_price" name="ship_price" placeholder="Enter Charges" required>
                                    <p id="locerr" class="error"></p>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;" id="btnSave">Submit </button>
                            <button type="submit" class="btn btn-primary float-right" style="margin-bottom: 20px;display:none" id="btnUpdate">Update </button>

                        <!-- </form> -->
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Shipping Services</h3>
                </div>
                <?php 
                    include '../Database/config.php';
                    $b = new Database();
                    $b->select("shipping","*","`ship_status`='Active'");
                    $result = $b->sql;
                ?>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="shipData" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Shipping Service Name</th>
                                <th>Shipping Service Charges</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td style="display: none;"><?php echo $row['ship_id']; ?></td>
                                <td><?php echo $row['ship_name']; ?></td>
                                <td><?php echo $row['ship_price']; ?></td>
                                <td><i class="fas fa-edit" id="btnEdit"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../Database/shipping.php?id=<?php echo $row['ship_id'];?>&Delete='true'"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Shipping Service Name</th>
                                <th>Shipping Service Charges</th>
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