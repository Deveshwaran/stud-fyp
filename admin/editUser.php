<?php include('function.php'); ?>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="default.css">
</head>

<?php
include("Connection.php");

$id = $_GET['ID'];

$query = "SELECT * FROM user WHERE User_ID = '$id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

$User_ID = $row['User_ID'];
$username = $row['username'];
$password = $row['password'];
$type = $row['type'];

if(isset($_POST["editUser"]) && $_POST["editUser"]!="") {
	$query = "UPDATE user SET username = '$username', password = '$password', type = '$type' WHERE User_ID = '$User_ID'";
	$result = mysqli_query($conn, $query);
	
    header('location: manageList(admin).php');
}
?>
	
<style>
form {
	border: 3px solid black;
	margin: 10px 20%;
	width: 60%;
	border-collapse: collapse;
}

button {
	width: 15%;
	height: 60px;
	margin: 10px 20px;
	color: white;
	background: #0e5555;
}

input {
	width: 70%;
	padding: 15px;
	margin-top: 10px;
}

label {
	width: 20%;
	font-size: 20px;
	margin: 20px
}
</style>
    <body>
        <div class="header">
            <h1>UMP-FK Final Year Project Management System</h1>
            <p class="text">Welcome to StudFYP</p>
        </div>

        <div class="table">
            <div class="cell">
                <div>
                    <br><br><br><br><br>
                    <div class="box">
                    <a href="viewUser.php">User List</a>
                    </div><br>
                    <div class="box select">
                    <a href="manageList(admin).php" style="color:black;">User Management</a>
                    </div><br>
                    <div class="box">
                    <a href="viewReport(admin).php">Report</a>
                    </div><br>
                </div>
            </div>
            
            <div class="cell">
                <div>
                    <p class="right"><i>Admin</i> &nbsp;&nbsp;&nbsp; | <a style="color: black;" href="function.php?logout='1'">Log Out</a></p>
                </div>
				
				<form action="updateUser.php" method="post">
					<h2 style="text-align: center">Edit User Inform</h2>
					<label for="User_ID"><b style="margin-right: 95px">User ID:</b></label>
					<input type="text" placeholder="Enter Student ID" name="User_ID" value="<?php echo $User_ID; ?>" readonly required><br><br>
					
					<label for="username"><b style="margin-right: 75px">Username:</b></label>
					<input type="text" placeholder="Enter Username" name="username" value="<?php echo $username; ?>" required><br><br>
					
					<label for="type"><b style="margin-right: 75px">User Type:</b></label>
					<input type="text" placeholder="Enter Name" name="type" value="<?php echo $type; ?>" required><br><br>
					
					<label for="password"><b style="margin-right: 26px">Enter Password:</b></label>
					<input type="password" placeholder="Enter Password" name="password" value="<?php echo $password; ?>" required><br><br>
					
					<button name="editUser" value="editUser" style="margin-left: 35%">Submit</button>
					<button onclick="window.location.href='manageList(admin).php'">Back</button>
					</div>
				</form>
            </div>
        </div>
    </body>
</html>