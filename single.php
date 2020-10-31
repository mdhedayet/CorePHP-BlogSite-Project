<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">

<?php 
include 'admin/config.php';
$post_id = $_GET['id'];

$query = "SELECT post.post_id, post.title, post.category,post.description, post.post_date, post.author, category.category_name, user.username, category.category_id, post.post_img  FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.post_id = {$post_id}";

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
                        <div class="post-content single-post">
                            <h3><?php echo $title; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo $category; ?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo $author; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $post_date; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $post_img; ?>" alt=""/>
                            <p class="description">
                                <?php echo $description; ?>
                            </p>
                        </div>
<?php 
}
}else{
    echo "result not found";
}
 ?>

                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
