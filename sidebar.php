<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
<?php 
include 'admin/config.php';
$limit=5;

$query = "SELECT post.post_id, post.title, post.category,post.description, post.post_date, post.author, category.category_name, user.username, category.category_id, post.post_img FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT {$limit}";

$result = mysqli_query($con,$query) or die("Query Failed.");
$count = mysqli_num_rows($result);
//start if codition
if ($count>0) {
while ($row = mysqli_fetch_assoc($result)) {
   $post_id = $row['post_id'];
   $title = $row['title'];
   $category = $row['category_name'];
   $post_date = $row['post_date'];
   $author = $row['username'];
   $category_id = $row['category_id'];
   $post_img = $row['post_img'];
   $description = $row['description'];

 ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $post_id; ?>">
                <img src="admin/upload/<?php echo $post_img; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $post_id; ?>"><?php echo substr($title,0,28)."..."; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?id=<?php echo $category_id; ?>'><?php echo $category; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $post_date; ?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $post_id; ?>">read more</a>
            </div>
        </div>
<?php 
}
}else{
    echo "no post found";
}
?>

    </div>
    <!-- /recent posts box -->
</div>
