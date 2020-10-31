<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
<?php 
include 'admin/config.php';

$query1 = "SELECT * FROM category WHERE category_id={$_GET['id']}";
$result1 = mysqli_query($con,$query1) or die("Faild");
 if (mysqli_num_rows($result1)>0) {
   # code...
  while ($row1 = mysqli_fetch_assoc($result1)) {
    echo "<h2 class='page-heading'>{$row1['category_name']}</h2>";
  }
 }

//post query and pagination start here.
$limit=5;
if (isset($_GET['page'])) {
  # code...
  $page_number = $_GET['page'];
}
else{
  $page_number=1;
}
$offset = ($page_number-1)*$limit;


  $query = "SELECT post.post_id, post.title, post.category,post.description, post.post_date, post.author, category.category_name, user.username, category.category_id, post.post_img FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE category.category_id = {$_GET['id']} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

$result = mysqli_query($con,$query) or die("Query Failed.");
$count = mysqli_num_rows($result);
//start if codition
if ($count>0) {

$show_data_id =($page_number*$limit)-$limit;
while ($row = mysqli_fetch_assoc($result)) {
   ++$show_data_id;
   $post_id = $row['post_id'];
   $title = $row['title'];
   $category = $row['category_name'];
   $post_date = $row['post_date'];
   $author = $row['username'];
   $author_id = $row['author'];
   $category_id = $row['category_id'];
   $post_img = $row['post_img'];
   $description = $row['description'];

 ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $post_id; ?>"><img src="admin/upload/<?php echo $post_img; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $post_id; ?>'><?php echo $title; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?id=<?php echo $category_id; ?>'><?php echo $category; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?id=<?php echo $author_id; ?>&name=<?php echo $author; ?>'><?php echo $author; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $post_date; ?>
                                        </span>
                                    </div>
                                    <p class="description"><?php echo substr($description,0,170)."..." ?></p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $post_id; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php 
}
}else{
    echo "no post found";
}


$query2 = "SELECT * FROM post WHERE post.category = {$_GET['id']}";
$result2 = mysqli_query($con,$query2) or die("Failed");
if(mysqli_num_rows($result2)){
  $total_records = mysqli_num_rows($result2);
  $total_page = ceil($total_records/$limit);

  echo "<ul class='pagination admin-pagination'>";
  if ($page_number>1) {
    # code...
    echo '<li><a href="category.php?page='.($page_number-1).'&id='.$_GET['id'].'">Prev</a></li>';
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
    echo '<li class='.$active.'><a href="category.php?page='.$i.'&id='.$_GET['id'].'">'.$i.'</a></li>';
  }
  if ($total_page>$page_number) {
    # code...
    echo '<li><a href="category.php?page='.($page_number+1).'&id='.$_GET['id'].'">Next</a></li>';
  }
  echo "</ul>";

}

 ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
