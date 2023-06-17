<?php
	require_once("Connection.php");
	
    $User_ID = $_GET['Del'];
    $query = "DELETE FROM user WHERE User_ID ='$User_ID'";
    $result = mysqli_query($conn, $query);

    if(isset($result)) {
        header('location: manageList(admin).php');
    }
?>