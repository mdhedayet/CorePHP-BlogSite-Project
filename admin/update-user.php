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

if (isset($_POST['submit'])) {
  //db connect
  include "config.php";
  
  //data collect to from and sequrity update
  $f_name = mysqli_real_escape_string($con,$_POST['f_name']);
  $l_name = mysqli_real_escape_string($con,$_POST['l_name']);
  $user_id = mysqli_real_escape_string($con,$_POST['user_id']);
  $user = mysqli_real_escape_string($con,$_POST['username']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $role = mysqli_real_escape_string($con,$_POST['role']);
  $pas = mysqli_real_escape_string($con,md5($_POST['password']));

  if (!$password) {
    $query1 = "UPDATE `user` SET first_name ='$f_name', last_name = '$l_name', username = '$user', role = '$role' WHERE `user`.`user_id` = '$user_id'";

    $result1 = mysqli_query($con,$query1) or die("Query Faild password not update");

    if ($result1) {
    $page = "users.php";
    echo '<script type="text/javascript">';
    echo 'window.location.href="'.$page.'";';
    echo '</script>';

  }
  }
  else{
    $query2 = "UPDATE `user` SET first_name ='$f_name', last_name = '$l_name', username = '$user', password = '$pas', role = '$role' WHERE `user`.`user_id` = '$user_id'";

    $result2 = mysqli_query($con,$query2) or die("Query Faild");

    if ($result2) {
    $page = "users.php";
    echo '<script type="text/javascript">';
    echo 'window.location.href="'.$page.'";';
    echo '</script>';

  }
  }
}


 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
<?php
  $uer_id = $_GET['id'];
  include 'config.php';
  $query = "SELECT * FROM user WHERE user_id = {$uer_id}";
  $result = mysqli_query($con,$query) or die("Query Failed for read data.");
  $count = mysqli_num_rows($result);
  //start if codition
  if ($count>0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $user_id = $row['user_id'];
      $username = $row['username'];
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $password = $row['password'];
      $role = $row['role'];
 ?>
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $user_id; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $first_name; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $last_name; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Password</label>
                          <input type="text" name="password" class="form-control" placeholder="Enter New Password or Continue old"  autocomplete="false">
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">

                              <?php
                              if ($role==1) {
                                echo "<option value='0'>Moderator</option>";
                                echo "<option value='1' selected>Admin</option>";
                              }
                              else{
                                echo "<option value='0' selected>Moderator</option>";
                                echo "<option value='1'>Admin</option>";
                              }

                              ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
<?php 
 }
}
 ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
