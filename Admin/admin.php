<?php
include('header.php');
?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Admins</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="../Database/admin.php">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                  <label>Role</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="role">
                    <option value="1">Admin</option>
                    <option value="2">Moderator</option>
                  </select>
                </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="btnSave" value="Submit"/>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          
          <div class="col-md-3"></div>
        </div>
      </div>
</section>
</div>
<?php
include('footer.php');
?>