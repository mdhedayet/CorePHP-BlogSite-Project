<?php include "header.php"; ?>

<?php
if ($_SESSION['role']=='0') {
  $page = "post.php";
  echo '<script type="text/javascript">';
  echo 'window.location.href="'.$page.'";';
  echo '</script>';
}
 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
<?php 
  if (isset($_POST['save'])) {
      
      //db connect
      include "config.php";
      
      //data collect to from and sequrity update
      $cat = mysqli_real_escape_string($con,$_POST['cat']);
      

      //check user allrady regester or not and data sent to database.
      $query = "SELECT * FROM category WHERE category_name = '$cat'";
      $result = mysqli_query($con,$query) or die("Query Faild");
      $count = mysqli_num_rows($result);
      if ($count>0) {
        echo "Category Name allrady Exists.";
      }
      else{
        $query1 = "INSERT INTO category (category_name) VALUES ('$cat')";
        $result1 = mysqli_query($con,$query1) or die("Query Faild");
        //redirect to users list page.
        if($result1){
          $page = "category.php";
          echo '<script type="text/javascript">';
          echo 'window.location.href="'.$page.'";';
          echo '</script>';
        }
      }

      }
 ?>
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
