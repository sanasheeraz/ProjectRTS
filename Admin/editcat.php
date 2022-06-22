<?php
include "header.php";

include '../Database/config.php';
$b = new Database();
$Aid = $_GET['id'];
//$ps="InActive";
$UserQuery = "select * from store";  //getting data from product table based on given id
$UserResult = mysqli_query($b->conn, $UserQuery); //executing query

$query = "Select * from category where cat_id='$Aid'";
$result = mysqli_query($b->conn, $query);
$row = mysqli_fetch_array($result);

?>
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

        <div class="card-header">
          <h3 class="card-title"> EdIt Category</h3>
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
          <form method="POST" enctype="multipart/form-data" id="edit_cat">
            <div class="card-body">
              <!-- End Quill Editor Default -->
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" value="<?php echo $row[1]; ?>">
                </div>


                <div class="form-group col-md-12">
                  <label for="prefix">Prefix</label>

                  <input type="text" class="form-control" name="prefix" value="<?php echo $row[2]; ?>">

                </div>
                <div class="form-group col-md-12">
                  <label for="store">Store</label>

                  <select name="store" id="store_dd" class="form-control">
                    <?php
                    while ($UserRow = mysqli_fetch_array($UserResult)) {
                      if ($UserRow["store_id"] == $row[4]) {
                    ?>
                        <option value="<?php echo $UserRow['store_id']; ?>" selected>
                          <?php echo $UserRow['store_name']; ?>
                        </option>
                      <?php
                      } else {
                      ?>
                        <option value="<?php echo $UserRow['store_id']; ?>">
                          <?php echo $UserRow['store_name']; ?>
                        </option>
                    <?php
                      }
                    }
                    ?>
                  </select>




                </div>

                <input type="submit" value="Submit" name="btnSubmit" class="btn btn-success">

              </div>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(document).on('submit', '#edit_cat', function(e) {
        e.preventDefault();
        const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get('id');
console.log(id);
        console.log("data update");
        var cat_id = id;

        var name_cat = $("input[name='name']").val();
        var prefix = $("input[name='prefix']").val();
        var store = $('#store_dd').val();
        
        console.log(store);
        $.ajax({
        method:"POST",
        url: "../Database/edit_cat.php",
        data:{
          Aid:cat_id,
          name:name_cat,
          prefix:prefix,
          store:store
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
  });
</script>
<?php
include "footer.php";
?>