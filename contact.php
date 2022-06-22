<?php
include "header.php";
?>
<!-- contact -->
<style>
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

</style>
<br>
<div class="container">
    <div class="col-lg-6 col-md-6 col-sm-12">
  <form >
    <label for="fname">Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name.." required>

    <label for="lname">Email</label>
    <input type="email" id="lname" name="lastname" placeholder="Your email.." required>

    <label for="lname">Subject</label>
    <input type="text" id="lname" name="lastname" placeholder="Subject.." required>

    <label for="subject">Message</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">
  </form>
    </div>
<div class="col-lg-6 col-md-6 col-sm-12">
<img src="assets/img/about/services.jpg" width="100%">
</div>    

</div>
</body>
</html>

<!-- /contact -->
<?php
include "footer.php";
?>