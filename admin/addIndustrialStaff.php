<?php include('function.php'); ?>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="default.css">
</head>
	
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
				
				<form action="addSupervisor.php" method="post">
					<h2 style="text-align: center">Add Industry Staff</h2>
					<label for="id"><b style="margin-right: 140px">ID:</b></label>
					<input type="text" placeholder="Enter Student ID" name="id" id="id" required><br><br>
					
					<label for="uid"><b style="margin-right: 96px">User ID:</b></label>
					<input type="text" placeholder="Enter User ID" name="uid" id="uid" required><br><br>
					
					<label for="uname"><b style="margin-right: 75px">Username:</b></label>
					<input type="text" placeholder="Enter Username" name="uname" id="uname" required><br><br>

					<label for="name"><b style="margin-right: 112px">Name:</b></label>
					<input type="text" placeholder="Enter Name" name="name" id="name" required><br><br>
					
					<label for="phone"><b style="margin-right: 82px">Phone no:</b></label>
					<input type="text" placeholder="Enter Contact" name="phone" id="phone" required><br><br>
					
					<label for="email"><b style="margin-right: 110px">Email:</b></label>
					<input type="text" placeholder="Enter Email" name="email" id="email" required><br><br>
					
					<label for="pwd1"><b style="margin-right: 78px">Password:</b></label>
					<input type="password" placeholder="Enter Password" name="pwd1" id="pwd1" required><br><br>

					<label for="pwd2"><b>Confirm Password:</b></label>
					<input type="password" placeholder="Confirm Password" name="pwd2" id="pwd2" required><br><br>
					
					<?php include ('error.php'); ?>
					
					<button name="createIS" value="Sign Up" style="margin-left: 35%">Sign Up</button>
					<button onclick="window.location.href='manageList(admin).php'">Back</button>
					</div>
				</form>
            </div>
        </div>
    </body>
</html>