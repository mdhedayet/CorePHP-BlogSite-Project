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
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->

<?php 
  if (isset($_POST['submit'])) {
      
      //db connect
      include "config.php";
      
      //data collect to from and sequrity update
      $fname = mysqli_real_escape_string($con,$_POST['fname']);
      $lname = mysqli_real_escape_string($con,$_POST['lname']);
      $user = mysqli_real_escape_string($con,$_POST['user']);
      $password = mysqli_real_escape_string($con,md5($_POST['password']));
      $role = mysqli_real_escape_string($con,$_POST['role']);

      //check user allrady regester or not and data sent to database.
      $query = "SELECT username FROM user WHERE username='$user'";
      $result = mysqli_query($con,$query) or die("Query Faild");
      $count = mysqli_num_rows($result);
      if ($count>0) {
        echo "UserName allrady Exists.";
      }
      else{
        $query1 = "INSERT INTO user (first_name, last_name, username, password, role) VALUE ('$fname','$lname','$user','$password','$role')";
        $result1 = mysqli_query($con,$query1) or die("Query Faild");
        //redirect to users list page.
        if($result1){
          $page = "users.php";
          echo '<script type="text/javascript">';
          echo 'window.location.href="'.$page.'";';
          echo '</script>';
        }
      }

      }
 ?>

                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="post" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Moderator</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="submit" class="btn btn-primary" value="Add User" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
