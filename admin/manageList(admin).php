<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="default.css">
    </head>
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
				<?php include ('manageUser.php'); ?>
            </div>
        </div>
    </body>
</html>