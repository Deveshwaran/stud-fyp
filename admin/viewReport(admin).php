<?php
	include('function.php');
	error_reporting(E_ALL & ~E_NOTICE);
	
    $query = "SELECT *, count(type) as number FROM user GROUP BY type"; 
	$result = mysqli_query($conn, $query);
?>

<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="default.css">
    </head>
	
	<script src="https://www.gstatic.com/charts/loader.js"></script>  
    <script>  
        google.charts.load('current', {'packages':['corechart']});  
        google.charts.setOnLoadCallback(drawChart);  
		function drawChart() {  
            var data = google.visualization.arrayToDataTable([['type', 'number'],  
            <?php  
                while($row = mysqli_fetch_array($result)) {  
                    echo "['".$row["type"]."', ".$row["number"]."],";  
                }  
            ?>  
            ]);  
            var option = {   
				title: 'THE TOTAL NUMBER FOR EACH USER BASED ON THE USER TYPE',
				is3D:true
            };  
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
            chart.draw(data, option);  
		}
    </script>
	
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
                    <div class="box">
                    <a href="manageList(admin).php">User Management</a>
                    </div><br>
                    <div class="box select">
                    <a href="viewReport(admin).php" style="color:black;">Report</a>
                    </div><br>
                </div>
            </div>
            
            <div class="cell">
                <div>
                    <p class="right"><i>Admin</i> &nbsp;&nbsp;&nbsp; |  <a style="color: black;" href="function.php?logout='1'">Log Out</a></p>
                </div>
				
				<div class="center">
					<div id="piechart" style="width: 80%; height: 500px; margin: 0 10%; border: 1px solid #ccc"></div>
				</div>
            </div>
        </div>
    </body>
</html>