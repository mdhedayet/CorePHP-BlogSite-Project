<?php include "header.php"; ?><?php
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
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">

<?php 
include 'config.php';
$limit = 10;
if (isset($_GET['p'])) {
  # code...
  $page_number = $_GET['p'];
}
else{
  $page_number=1;
}
$offset = ($page_number-1)*$limit;
$query = "SELECT * FROM category  ORDER BY category_id DESC LIMIT {$offset},{$limit}";
$result = mysqli_query($con,$query) or die("Query faild");
$count = mysqli_num_rows($result);
if ($count>0) {
$serial=($page_number*$limit)-$limit;
?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>

                    <tbody>
<?php
while ($row=mysqli_fetch_assoc($result)) {
  $category_id = $row['category_id'];
  $category_name = $row['category_name'];
  $post = $row['post'];
?>
                        <tr>
                            <td class='id'><?php echo ++$serial; ?></td>
                            <td><?php echo $category_name; ?></td>
                            <td><?php echo $post; ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $category_id; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $category_id; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
<?php  }?>
                    </tbody>
<?php } else{ echo "No data found.";} ?>
                </table>
<?php 
include 'config.php';
$query1 = "SELECT * FROM category";
$result1 = mysqli_query($con,$query1) or die("Query faild");
if(mysqli_num_rows($result1)){
  $total_records = mysqli_num_rows($result1);
  $total_page = ceil($total_records/$limit);

  echo "<ul class='pagination admin-pagination'>";
  if ($page_number>1) {
    # code...
    echo '<li><a href="category.php?p='.($page_number-1).'">Prev</a></li>';
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
    echo '<li class='.$active.'><a href="category.php?p='.$i.'">'.$i.'</a></li>';
  }
  if ($total_page>$page_number) {
    # code...
    echo '<li><a href="category.php?p='.($page_number+1).'">Next</a></li>';
  }
  echo "</ul>";

}

 ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
