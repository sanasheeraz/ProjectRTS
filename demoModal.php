<?php
include('header.php');

$b = new Database();
$q="SELECT * FROM `dropshipper`";
$result=$b->conn->query($q);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
  $(document).on('click', '#btnSet', function() {
    var id=$(this).val();
    $('#discount').val(id);
    $('#exampleModal').modal('toggle');
  });

  //onclick of update button
  $(document).on('click', '#save', function() {
    //getting value of input box
    var input_val = $(this).closest(".modal-body").find("#Timer_1").val();
    //getting hidden id 
    var ids = $(this).closest(".modal-body").find("#ids").val();
    //finding tr with same id and then update the td
    $("table").find("tr[id='" + ids + "']").find("td[data-target='Timer_1']").text(input_val);
    $('#myModal').modal('toggle');
  });
});

</script>

<table class="table">
<?php
    while($row = mysqli_fetch_array($result)){ 
      ?>
        <tr id="<?php echo $row['d_id']; ?>">
            <th>Timer 1</th>
            <td data-target="Timer_1">
                <?php echo $row['d_firstname']; ?>
            </td>
           <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="btnSet" value="<?php echo $row['d_id'];?>" data-whatever="@mdo">Set %</button>
             </td>
        </tr>
     <?php
          } 
     ?>
    </table>


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
          <div class="form-group">
            <label for="discount" class="col-form-label">Discount Percentage :</label>
            <input type="text" class="form-control" id="discount" >
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
  <?php

include('footer.php');
?>