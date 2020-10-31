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
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
<?php 
include 'config.php';
$limit=10;
if (isset($_GET['page'])) {
  # code...
  $page_number = $_GET['page'];
}
else{
  $page_number=1;
}
$offset = ($page_number-1)*$limit;
$query = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
$result = mysqli_query($con,$query) or die("Query Failed.");
$count = mysqli_num_rows($result);
//start if codition
if ($count>0) {

$show_data_id =($page_number*$limit)-$limit;

 ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
<?php 

//Start while loop
while ($row = mysqli_fetch_assoc($result)) {
   ++$show_data_id;
   $user_id = $row['user_id'];
   $username = $row['username'];
   $first_name = $row['first_name'];
   $last_name = $row['last_name'];
   $password = $row['password'];
   $role = $row['role'];
?>

                          <tr>
                              <td class='id'><?php echo $show_data_id; ?></td>
                              <td><?php echo $first_name." ".$last_name; ?></td>
                              <td><?php echo $username; ?></td>
                              <td><?php 
                              if ($role==1) {
                                echo "Admin";
                              }
                              else{
                                echo "Moderator";
                              } ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $user_id; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $user_id; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
<?php 
//end while loop
}
 ?>
                          
                      </tbody>
<?php
//end if condition 
} ?>
                  </table>
<?php 

include 'config.php';
$query2 = "SELECT * FROM user";
$result2 = mysqli_query($con,$query2) or die("Failed");
if(mysqli_num_rows($result2)){
  $total_records = mysqli_num_rows($result2);
  $total_page = ceil($total_records/$limit);

  echo "<ul class='pagination admin-pagination'>";
  if ($page_number>1) {
    # code...
    echo '<li><a href="users.php?page='.($page_number-1).'">Prev</a></li>';
  }

  for ($i=1; $i <= $total_page ; $i++) { 
    # code...
    if ($i==$page_number) {
      # code...
      $active="active";
    }
    else{
      $active="";
    }
    echo '<li class='.$active.'><a href="users.php?page='.$i.'">'.$i.'</a></li>';
  }
  if ($total_page>$page_number) {
    # code...
    echo '<li><a href="users.php?page='.($page_number+1).'">Next</a></li>';
  }
  echo "</ul>";

}

 ?>
                  
                      <!-- <li class="active"><a>1</a></li> -->
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
