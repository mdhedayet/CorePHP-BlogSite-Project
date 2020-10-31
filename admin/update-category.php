<?php include "header.php"; ?>
<?php
if ($_SESSION['role']=='0') {
  $page = "post.php";
  echo '<script type="text/javascript">';
  echo 'window.location.href="'.$page.'";';
  echo '</script>';
}
?>
<?php 

if (isset($_POST['sumbit'])) {
  //db connect
  include "config.php";
  
  //data collect to from and sequrity update
  $cat_name = mysqli_real_escape_string($con,$_POST['cat_name']);
  $cat_id = mysqli_real_escape_string($con,$_POST['cat_id']);

  $query2 = "UPDATE category SET category_name = '$cat_name' WHERE category_id = '$cat_id'";

    $result2 = mysqli_query($con,$query2) or die("Query Faild");

    if ($result2) {
    $page = "category.php";
    echo '<script type="text/javascript">';
    echo 'window.location.href="'.$page.'";';
    echo '</script>';

  }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
<?php
  $data_id = $_GET['id'];
  include 'config.php';
  $query = "SELECT * FROM category WHERE category_id = {$data_id}";
  $result = mysqli_query($con,$query) or die("Query Failed for read data.");
  $count = mysqli_num_rows($result);
  //start if codition
  if ($count>0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $category_name = $row['category_name'];
      $category_id = $row['category_id'];

     
 ?>

                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $category_id; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $category_name; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
<?php }} ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
