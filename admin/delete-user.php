<?php 
include 'config.php';
$rcv_id= $_GET['id'];

$query ="DELETE FROM `user` WHERE `user`.`user_id` = '$rcv_id'";

$result = mysqli_query($con,$query);

if ($result) {
	$page = "users.php";
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$page.'";';
	echo '</script>';
	die();
}
else{
	echo "Can't Delete User.";
}

mysqli_close($con);

?>