<?php
include "header.php";
$b = new Database();

?>
<!-- content -->



  <br>
<div class="container">

  
    <!-- Start portfolio Section  -->
    <a class="anchor" id="portfolio-link"></a>
    <div id="portfolio" class="container-fluid">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1>Our Best Brands</h1>
          <hr />
          <div class="container">
            <div class="row">
            <?php
                        $b->select("brands", "*","`brand_status`='Active'");
                        $result = $b->sql;
                        while ($row = mysqli_fetch_assoc($result)) { ?>

              <div class="col-lg-4" style="height:150px;">

                <div class="thumbnail">
                  <a href="#" target="_blank">
                    <div class="thumbnail-hover text-center">
                     
                    </div>
                    <a href="products.php?brand_id=<?php echo $row['brand_id']?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['brand_logo']); ?>" alt="" style="width:50%; height:150px;" /></a>
                  </a>
                 
                </div>

              </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End portfolio Section  -->

</div>






<!-- /content -->
<?php
include "footer.php";
?>