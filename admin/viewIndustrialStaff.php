<?php
	require_once("Connection.php");

	$query1 = "SELECT * FROM industrial_staff ORDER BY IS_ID";
	$result1 = mysqli_query($conn, $query1);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="default.css">
<script type="text/javascript" charset="utf8" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$(document).ready(function(){
	  $("#search").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#myTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });
	});
</script>
</head>

<style>
table {
	border: 3px solid black;
	width: 100%;
	border-collapse: collapse;
	background-color: white;
}

.container {
	border: none;
	margin: 10px 20%;
	width: 60%;
	border-collapse: collapse;
}

th, td {
	border: 3px solid black;
	padding: 10px;
}

.input1 {
	width: 96%;
	padding: 15px;
}

.input2 {
	width: 60%;
	padding: 15px;
}

.text1 {
	margin: 0 10%;
}

button {
	width: 15%;
	height: 60px;
	margin: 10px 3px;
	padding: 0px;
	color: white;
	background: #0e5555;
}

.select {
	border: solid black;
	border-radius: 3px;
    background-color: white;
	color: black;
}

.inform {
	margin-left: 20%;
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
                <div class="box select">
                <a href="viewUser.php" style="color:black;">User List</a>
                </div><br>
                <div class="box">
                <a href="manageList(admin).php">User Management</a>
                </div><br>
                <div class="box">
                <a href="viewReport(admin).php">Report</a>
                </div><br>
            </div>
        </div>
            
        <div class="cell">
            <div>
                <p class="right"><i>Admin</i> &nbsp;&nbsp;&nbsp; |  <a style="color: black;" href="function.php?logout='1'">Log Out</a></p>
            </div>
			
			<div class="container">
				<button onclick="window.location.href='viewUser.php'">View User</button>
				<button onclick="window.location.href='viewAdmin.php'">View Admin</button>
				<button onclick="window.location.href='viewCoordinator.php'">View Coordinator</button>
				<button onclick="window.location.href='viewLecturer.php'">View Lecturer</button>
				<button onclick="window.location.href='viewIndustrialStaff.php'" class="select">View Industrial Staff</button>
				<button onclick="window.location.href='viewStudent.php'">View Student</button>
				
				<input type="text" id="search" placeholder="Search..." class="input1"><br>
			
				<b>Number of user:</b>
				<?php 
					$query = "SELECT COUNT(IS_ID) as totalUser FROM industrial_staff";
					$result = mysqli_query($conn, $query);
					$total = mysqli_fetch_assoc($result);
					echo $total['totalUser'];
					mysqli_close($conn);
				?><br><br>
				
				<table>
					<thead>
						<tr>
							<th>Industrial Staff ID</th>
							<th>User ID</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Email</th>
						</tr>
					</thead>
					
					<?php
						while($row = mysqli_fetch_assoc($result1)) {
							$IS_ID = $row['IS_ID'];
							$User_ID = $row['User_ID'];
							$IS_name = $row['IS_name'];
							$IS_phoneNo = $row['IS_phoneNo'];
							$IS_email = $row['IS_email'];                
						?>
						<tbody id="myTable">
							<tr>
								<td><?php echo $IS_ID  ?></td>
								<td><?php echo $User_ID ?></td>
								<td><?php echo $IS_name ?></td>
								<td><?php echo $IS_phoneNo	 ?></td>
								<td><?php echo $IS_email	 ?></td>
							</tr>
						</tbody>
					<?php
						}
					?>
				</table><br>
			</div><br>
		</div>
	</div>
</body>
</html>