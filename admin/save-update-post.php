<?php 
include 'config.php';

if (empty($_FILES['new-image']['name'])) {
	$new_name = $_POST['old-images'];
}
else{
	
	$errors = array();

	$file_name = $_FILES['new-image']['name'];
	$file_size = $_FILES['new-image']['size'];
	$file_tmp = $_FILES['new-image']['tmp_name'];
	$file_type = $_FILES['new-image']['type'];
	$file_ext = @end(explode('.', $file_name));

	$extensions = array("jpeg","jpg","png");

	if (in_array($file_ext, $extensions) === false) {
		$errors[] = "This extensions file not allowed, Please choose a JPG or PNG File.";
	}
	if ($file_size>2097152) {
		$errors[] = "File size must be 2mb or lower.";
	}

	$new_name = time()."-".basename($file_name);
	$target = "upload/".$new_name;

	if (empty($errors) == true) {
		move_uploaded_file($file_tmp, $target);
	}else{
		print_r($errors);
		die();
	}

	$delete_img = $_POST['delete_img'];
	unlink($delete_img);
}


$title = mysqli_real_escape_string($con,$_POST["post_title"]);
$description = mysqli_real_escape_string($con,$_POST["postdesc"]);
$category = mysqli_real_escape_string($con,$_POST["category"]);

$query ="UPDATE post SET 
title = '{$title}',
description = '{$description}',
category = '{$category}',
post_img = '{$new_name}'
WHERE post_id = {$_POST["post_id"]};
";

if ($_POST['old_category'] != $_POST["category"]) {
	$query .="UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']};";
	$query .="UPDATE category SET post=post+1 WHERE category_id = {$_POST['category']};";
}

$result = mysqli_multi_query($con,$query) or die(mysqli_error());

if ($result) {
	header("location:../admin/post.php");
}else{
	echo "update failed";
}


 ?>
