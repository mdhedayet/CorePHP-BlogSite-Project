<?php 
include 'config.php';

$post_id = $_GET['id'];
$catid = $_GET['catid'];

$query1 = "SELECT * FROM post WHERE post_id={$post_id}";
$result = mysqli_query($con,$query1);
$row = mysqli_fetch_assoc($result);
unlink("upload/".$row['post_img']);

$query = "DELETE FROM post WHERE post_id={$post_id};";
$query .= "UPDATE category SET post = post - 1 WHERE category_id = {$catid}";

if (mysqli_multi_query($con,$query)) {
	header("location: ../admin/post.php");
}else{
	echo "Delete faild";
}
?>
