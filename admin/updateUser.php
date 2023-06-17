<?php
	include ("Connection.php");
	extract ($_POST);

	$query = "UPDATE user SET username = '$username', password = '$password', type = '$type' WHERE User_ID = '$User_ID'";
	$result = mysqli_query($conn, $query);

	if(isset($result)){
		header('location: manageList(admin).php');
	}
?>