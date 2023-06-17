<?php

	$errors = array();
	require_once("Connection.php");
	
	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		
		$query = "SELECT * FROM user WHERE username='$username' AND password='$password' AND type='$type'";
		$result = mysqli_query($conn, $query) or die ("Could not execute query");
		
		if (mysqli_num_rows($result) == 1) {
		    session_start(); 
			while($row = mysqli_fetch_assoc($result)) {
			    $_SESSION['username'] = $row['username'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['type'] = $_POST['type'];
				$_SESSION['User_ID'] = $row['User_ID'];
				if($type == "admin") {
                    ob_start();
					header('location: /admin/viewUser.php');
					ob_end_flush();
				} else if($type == "Coordinator") {
                    ob_start();
					header('location: /faculty_coordinator/facultycoordinator.php');
					ob_end_flush();
				} else if($type == "Lecturer") {
                    ob_start();
					header('location: /faculty_supervisor/facultysupervisor.php');
					ob_end_flush();
				} else if($type == "Industrial Staff") {
                    ob_start();
					header('location: /industrial_staff/default.php');
					ob_end_flush();
				} else if($type == "Student") {
                    ob_start();
					header('location: /faculty_student/profile.php');
					ob_end_flush();
				}
			}
		} else {
			array_push($errors, "Wrong username or password !!!");
		}
	}
	
	if (isset($_POST['createAdmin'])) {
		$Admin_ID = mysqli_real_escape_string($conn, $_POST['id']);
		$User_ID = mysqli_real_escape_string($conn, $_POST['uid']);
		$username = mysqli_real_escape_string($conn, $_POST['uname']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
		$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
		
		$query = "SELECT * FROM user WHERE User_ID='$User_ID'";
		$check = mysqli_query($conn, $query) or die ("Could not execute query");
		
		if(mysqli_num_rows($check) != 0) {
			array_push($errors, "The User ID already exist!");
		} elseif($pwd1 != $pwd2 && isset($pwd1) && isset($pwd2)) {
			array_push($errors, "The two passwords do not match!");
		} else {
			if(count($errors) == 0) {
				$query1 = "INSERT INTO user VALUES ('$User_ID', '$username', '$pwd1','admin')";
				$result = mysqli_query($conn, $query1) or die ("Could not execute query");
				$query2 = "INSERT INTO admin VALUES ('$Admin_ID', '$name', '$User_ID')";
				$result = mysqli_query($conn, $query2) or die ("Could not execute query");
                ob_start();
				header('location: /admin/manageList(admin).php');
				ob_end_flush();
			}			
		}
	}
	
	if (isset($_POST['createFC'])) {
		$FC_ID = mysqli_real_escape_string($conn, $_POST['id']);
		$User_ID = mysqli_real_escape_string($conn, $_POST['uid']);
		$username = mysqli_real_escape_string($conn, $_POST['uname']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
		$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
		
		$query = "SELECT * FROM user WHERE User_ID='$User_ID'";
		$check = mysqli_query($conn, $query) or die ("Could not execute query");
		
		if(mysqli_num_rows($check) != 0) {
			array_push($errors, "The User ID already exist!");
		} elseif($pwd1 != $pwd2 && isset($pwd1) && isset($pwd2)) {
			array_push($errors, "The two passwords do not match!");
		} else {
			if(count($errors) == 0) {
				$query1 = "INSERT INTO user VALUES ('$User_ID', '$username', '$pwd1','Coordinator')";
				$result = mysqli_query($conn, $query1) or die ("Could not execute query");
				$query2 = "INSERT INTO faculty_coordinator VALUES ('$FC_ID', '$User_ID', '$name', '$phone', '$email')";
				$result = mysqli_query($conn, $query2) or die ("Could not execute query");
                ob_start();
				header('location: /admin/manageList(admin).php');
				ob_end_flush();
			}			
		}
	}
	
	if (isset($_POST['createLec'])) {
		$FS_ID = mysqli_real_escape_string($conn, $_POST['id']);
		$User_ID = mysqli_real_escape_string($conn, $_POST['uid']);
		$username = mysqli_real_escape_string($conn, $_POST['uname']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
		$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
		
		$query = "SELECT * FROM user WHERE User_ID='$User_ID'";
		$check = mysqli_query($conn, $query) or die ("Could not execute query");
		
		if(mysqli_num_rows($check) != 0) {
			array_push($errors, "The User ID already exist!");
		} elseif($pwd1 != $pwd2 && isset($pwd1) && isset($pwd2)) {
			array_push($errors, "The two passwords do not match!");
		} else {
			if(count($errors) == 0) {
				$query1 = "INSERT INTO user VALUES ('$User_ID', '$username', '$pwd1','Lecturer')";
				$result = mysqli_query($conn, $query1) or die ("Could not execute query");
				$query2 = "INSERT INTO faculty_supervisor VALUES ('$FS_ID', '$User_ID', '$name', '$phone', '$email', '$address', NULL)";
				$result = mysqli_query($conn, $query2) or die ("Could not execute query");
                ob_start();
				header('location: /admin/manageList(admin).php');
				ob_end_flush();
			}			
		}
	}
	
	if (isset($_POST['createIS'])) {
		$IS_ID = mysqli_real_escape_string($conn, $_POST['id']);
		$User_ID = mysqli_real_escape_string($conn, $_POST['uid']);
		$username = mysqli_real_escape_string($conn, $_POST['uname']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
		$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
		
		$query = "SELECT * FROM user WHERE User_ID='$User_ID'";
		$check = mysqli_query($conn, $query) or die ("Could not execute query");
		
		if(mysqli_num_rows($check) != 0) {
			array_push($errors, "The User ID already exist!");
		} elseif($pwd1 != $pwd2 && isset($pwd1) && isset($pwd2)) {
			array_push($errors, "The two passwords do not match!");
		} else {
			if(count($errors) == 0) {
				$query1 = "INSERT INTO user VALUES ('$User_ID', '$username', '$pwd1','Industrial Staff')";
				$result = mysqli_query($conn, $query1) or die ("Could not execute query");
				$query2 = "INSERT INTO industrial_staff VALUES ('$IS_ID', '$User_ID', '$phone', '$name', '$email', NULL, NULL)";
				$result = mysqli_query($conn, $query2) or die ("Could not execute query");
                ob_start();
				header('location: /admin/manageList(admin).php');
				ob_end_flush();
			}			
		}
	}
	
	if (isset($_POST['createStu'])) {
		$Stu_ID = mysqli_real_escape_string($conn, $_POST['id']);
		$User_ID = mysqli_real_escape_string($conn, $_POST['uid']);
		$username = mysqli_real_escape_string($conn, $_POST['uname']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
		$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
		
		$query = "SELECT * FROM user WHERE User_ID='$User_ID'";
		$check = mysqli_query($conn, $query) or die ("Could not execute query");
		
		if(mysqli_num_rows($check) != 0) {
			array_push($errors, "The User ID already exist!");
		} elseif($pwd1 != $pwd2 && isset($pwd1) && isset($pwd2)) {
			array_push($errors, "The two passwords do not match!");
		} else {
			if(count($errors) == 0) {
				$query1 = "INSERT INTO user VALUES ('$User_ID', '$username', '$pwd1','Student')";
				$result = mysqli_query($conn, $query1) or die ("Could not execute query");
				$query2 = "INSERT INTO faculty_student VALUES ('$Stu_ID', NULL, NULL, NULL, NULL, '$User_ID', NULL, NULL, '$name', '$phone', '$email', '$department', NULL, NULL)";
				$result = mysqli_query($conn, $query2) or die ("Could not execute query");
                ob_start();
				header('location: /admin/manageList(admin).php');
				ob_end_flush();
			}			
		}
	}
	
	if(isset($_GET['logout'])) {
	    session_destroy();
		$_SESSION['username'];
		$_SESSION['password'];
		$_SESSION['type'];
		$_SESSION['User_ID'];
        ob_start();
		header('location: /index.php');
		ob_end_flush();
	}
?>