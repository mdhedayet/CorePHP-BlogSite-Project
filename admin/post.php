<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
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

if ($_SESSION['role']=='1') {
  $query = "SELECT post.post_id, post.title, post.category, post.post_date, post.author, category.category_name, user.username, category.category_id, post.post_img FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
}elseif ($_SESSION['role']=='0') {
  $query = "SELECT post.post_id, post.title, post.category, post.post_date, post.author, category.category_name, user.username FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.author = {$_SESSION['user_id']} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
}

$result = mysqli_query($con,$query) or die("Query Failed.");
$count = mysqli_num_rows($result);
//start if codition
if ($count>0) {

$show_data_id =($page_number*$limit)-$limit;

 ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
<?php 

//Start while loop
while ($row = mysqli_fetch_assoc($result)) {
   ++$show_data_id;
   $post_id = $row['post_id'];
   $title = $row['title'];
   $category = $row['category_name'];
   $post_date = $row['post_date'];
   $author = $row['username'];
   $category_id = $row['category_id'];
   $post_img = $row['post_img'];
   
   //$role = $row['role'];
?>
                          <tr>
                              <td class='id'><?php echo $show_data_id; ?></td>
                              <td><img height="50px" src="../admin/upload/<?php echo $post_img; ?>"></td>
                              <td><?php echo $title; ?></td>
                              <td><?php echo $category; ?></td>
                              <td><?php echo $post_date; ?></td>
                              <td><?php echo $author; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $post_id; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $post_id; ?>&catid=<?php echo $category_id; ?>'><i class='fa fa-trash-o'></i></a></td>
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
$query2 = "SELECT * FROM post";
$result2 = mysqli_query($con,$query2) or die("Failed");
if(mysqli_num_rows($result2)){
  $total_records = mysqli_num_rows($result2);
  $total_page = ceil($total_records/$limit);

  echo "<ul class='pagination admin-pagination'>";
  if ($page_number>1) {
    # code...
    echo '<li><a href="post.php?page='.($page_number-1).'">Prev</a></li>';
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
    echo '<li class='.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';
  }
  if ($total_page>$page_number) {
    # code...
    echo '<li><a href="post.php?page='.($page_number+1).'">Next</a></li>';
  }
  echo "</ul>";

}

 ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
