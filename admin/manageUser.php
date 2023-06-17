<?php
	require_once("Connection.php");

	$query1 = "SELECT * FROM user ORDER BY User_ID";
	$result1 = mysqli_query($conn, $query1);
?>

<!DOCTYPE html>
<html>
<head>
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
	width: 100%;
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
	margin: 10px 15px;
	padding: 0px;
	color: white;
	background: #0e5555;
}

.inform {
	margin-left: 20%;
}
</style>

<body>
	<div class="container">
		<button onclick="window.location.href='addAdmin.php'">Add Admin</button>
		<button onclick="window.location.href='addCoordinator.php'">Add Coordinator</button>
		<button onclick="window.location.href='addLecturer.php'">Add Lecturer</button>
		<button onclick="window.location.href='addIndustrialStaff.php'">Add Industrial Staff</button>
		<button onclick="window.location.href='addStudent.php'">Add Student</button><br>
		
		<input type="text" id="search" placeholder="Search..."class="input1"><br><br>
		
		<table>
			<thead>
				<tr>
					<th>User ID</th>
					<th>Username</th>
					<th>Password</th>
					<th>User Type</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
			
			<?php
				while($row = mysqli_fetch_assoc($result1)) {
					$User_ID = $row['User_ID'];
					$username = $row['username'];
					$password = $row['password'];
					$type = $row['type'];                
				?>
				<tbody id="myTable">
					<tr>
						<td><?php echo $User_ID  ?></td>
						<td><?php echo $username ?></td>
						<td><?php echo $password ?></td>
						<td><?php echo $type	 ?></td>
						<td><a href="editUser.php?ID=<?php echo $User_ID ?>"><font color="black"><u>Edit</u></font></a></td>
						<td><a href="deleteUser.php?Del=<?php echo $User_ID ?>" onclick="return confirm('Confirm?');"><font color="black"><u>Delete</u></font></a></td>
					</tr>
				</tbody>
			<?php
				}
			?>
		</table>
	</div>
</body>
</html>