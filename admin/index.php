<!DOCTYPE html>
<html>
<head>
<title>UMP-FK Final Year Project Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
form {
	border-radius: 5px; 
	margin: 5% 30%; 
	background-color: #0e5555;
}

body {
	background-color: rgb(0,173,165);
}

input[type=text], input[type=password], select {
	width: 100%;
	padding: 12px 20px;
	margin: 8px 0;
	display: inline-block;
	box-sizing: border-box;
}

.button {
	background-color: #08a5a5;
	color: white;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	width: 100%;
}

.container {
	padding: 20px;
}

.fp {
	font-size:15px;
	text-align:right;
	margin: 10px 20px;
	padding-bottom: 5px;
	color: white;
}
</style>

<?php include('admin/function.php'); ?>

<header>
	
</header>

<body>

<form action="index.php" method="post">
	<div class="container">
		<img src="https://assets.nst.com.my/images/articles/UMP_Tvet-MS1611_NSTfield_image_socialmedia.var_1573879246.jpg" alt="UMP" width="100%">
		<?php include ('admin/error.php'); ?>
		<input type="text" placeholder="Enter Username" id="username" name="username" required><br><br>

		<input type="password" placeholder="Enter Password" id="password" name="password" required><br><br>
	
		<select id="type" name="type">
			<option value="Admin">Admin</option>
			<option value="Coordinator">Coordinator</option>
			<option value="Lecturer">Supervisor</option>
			<option value="Industrial Staff">Industrial Staff</option>
			<option value="Student">Student</option>
		</select><br><br>
		<input type="submit" name="login" class="button" value="Login">
	</div>
	
	<div class="fp">
		<a href="#" onclick="window.alert('Please contact 05-XXXX XXX');"><font color=white><b>Forgot password?</b></font></a>
	</div>
</form>

<div><img src="umpmyli.png" style="position: fixed; bottom: 0; width: 150px; left: 1%;"></div>

</body>
</html>