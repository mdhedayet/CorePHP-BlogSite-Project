<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
<?php 
include 'config.php';
$post_id = $_GET['id'];

$query = "SELECT post.post_id, post.title, post.category, post.author, category.category_name, post.post_img, post.description FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.post_id = {$post_id}";

$result = mysqli_query($con,$query) or die("Query Failed.");
$count = mysqli_num_rows($result);
//start if codition
if ($count>0) {
    while ($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $title = $row['title'];
    $category = $row['category_name'];
    $description = $row['description'];
    $post_img = $row['post_img'];
 ?>
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $post_id; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $title; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <option disabled selected> Select Category</option>
<?php 
include 'config.php';
$query = "SELECT * FROM category";
$result = mysqli_query($con,$query) or die("Faild");
 if (mysqli_num_rows($result)>0) {
   # code...
  while ($row1 = mysqli_fetch_assoc($result)) {
    # code...
    if ($row['category'] == $row1['category_id']) {
        $selected = "selected";
    }else{
        $selected = "";
    }
    echo "<option {$selected} value='{$row1['category_id']}'> {$row1['category_name']}</option>";
  }
 }
 ?>
                </select>
                <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>">
            </div> 
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $post_img; ?>" height="150px">
                <input type="hidden" name="delete_img" value="upload/<?php echo $post_img; ?>">
                <input type="hidden" name="old-images" value="<?php echo $post_img; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->

<?php 
}
}else{
    echo "result not found";
}
 ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
