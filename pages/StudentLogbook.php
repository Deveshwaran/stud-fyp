<?php
  include('../includes/header.php');
  include('../includes/navbarlecturer.php');
  include('../includes/database.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Box</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
  .searching .search-bar {
  min-width: 360px;
  padding: 0 20px;
}
@media (max-width: 1199px) {
  ..searching .search-bar {
    position: fixed;
    top: 50px;
    left: 0;
    right: 0;
    padding: 20px;
    box-shadow: 0px 0px 15px 0px rgba(1, 41, 112, 0.1);
    background: white;
    z-index: 9999;
    transition: 0.3s;
    visibility: hidden;
    opacity: 0;
  }
  .searching .search-bar-show {
    top: 60px;
    visibility: visible;
    opacity: 1;
  }
}
.searching .search-form {
  width: 100%;
}
.searching .search-form input {
  border: 0;
  font-size: 14px;
  color: #012970;
  border: 1px solid rgba(1, 41, 112, 0.2);
  padding: 7px 38px 7px 8px;
  border-radius: 3px;
  transition: 0.3s;
  width: 100%;
}
.searching .search-form input:focus, .header .search-form input:hover {
  outline: none;
  box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15);
  border: 1px solid rgba(1, 41, 112, 0.3);
}
.searching .search-form button {
  border: 0;
  padding: 0;
  margin-left: -30px;
  background: none;
}
.searching .search-form button i {
  color: #012970;
}

.comment{
  width: 500px;
  height: 100px;

}

::-webkit-input-placeholder {
  text-align: left;
  
}

</style>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Student Logbook</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index_umiera.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

<section class="section profile">

  <div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-body">
          <!-- Bordered Tabs -->
          <br>
          
          <div class="searching">
            <div class="search-bar">
              <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>
              <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                  <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                  </a>
                </li><!-- End Search Icon-->
              </ul>
            </div><!-- End Search Bar -->
          </div>
  
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <div class="row">
                <div class="col-lg-3 col-md-4 label"></div>
                </div>

              <div>
                <?php
                  //SQL query
                  $strSQL = "SELECT stu.StudentID, ActiveStatus, Semester, ProjectName, Status, Type
                  FROM fypstudent AS stu JOIN finalyearproject AS fyp WHERE stu.FYPStudentID = fyp.FYPStudentID";

                  //Execute the query (the recordset $rs contains the result)
                  $rs = mysqli_query($link, $strSQL);

                  //Loop the recordset $rs 
                  //Each row will be made into an array ($row) using mysql_fetch_array 
                  while ($row=mysqli_fetch_array($rs)){
                ?>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Student ID</div>
                  <div class="col-lg-9 col-md-8"><?php echo $row['StudentID'];?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Status</div>
                  <div class="col-lg-9 col-md-8"><?php echo $row['ActiveStatus'];?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Semester</div>
                  <div class="col-lg-9 col-md-8"><?php echo $row['Semester'];?></div>
                </div>

                <div class="row">
                  <hr>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Project Name</div>
                  <div class="col-lg-9 col-md-8"><?php echo $row['ProjectName'];?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Project Status</div>
                  <div class="col-lg-9 col-md-8"><?php echo $row['Status'];?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Project Type</div>
                  <div class="col-lg-9 col-md-8"><?php echo $row['Type'];?></div>
                </div>

                <?php 
                  } //While loop
                ?>
              </div>
            </div>
          </div><!-- End Bordered Tabs -->
          
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-body pt-3">
          <h5 class="card-title">Student Status Chart</h5>
          <br>
          <br>
          <!-- Doughnut Chart -->
          <canvas id="doughnutChart" style="max-height: 600px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
              new Chart(document.querySelector('#doughnutChart'), {
                type: 'doughnut',
                data: {
                labels: [
                  'Active = 1',
                  'Inactive = 0',
                ],
                datasets: [{
                label: 'My First Dataset',
                data: [300, 50],
                backgroundColor: [
                  'rgb(54, 162, 235)',
                  'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
                    }]
                  }
                });
              });
            </script><!-- End Doughnut CHart -->
            <br>
            <br>
            <br>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">

      <?php 
        
            //$logbookID = $_GET['id'];

            //SQL query
            $strSQL = "SELECT * FROM Logbook";

            //Execute the query (the recordset $rs contains the result)
            $rs = mysqli_query($link, $strSQL);

            //Loop the recordset $rs 
            //Each row will be made into an array ($row) using mysql_fetch_array 

            while ($row=mysqli_fetch_array($rs)){
      ?>

      <h5 class="card-title">Logbook for <?php echo date('l, jS \of F Y', strtotime($row['DateTime']));?></h5>
      <p><?php echo $row['Content']!='' ? $row['Content'] : 'None (Overdue)';?></p>
      <!-- Progress 2-->

      
      <a href="StudentLogbook-edit.php"><button type="button"  class="btn btn-primary">View feedback</button></a>

            <?php
                if(substr($row['DateTime'],0,10)==date("Y-m-d")){
                  echo '<a class="btn btn-primary" href="editlogbook.php?id='.$logbookID.'" style="float: right;"><i class="ri-edit-box-fill me-1"></i> Edit</a>';
                }
              }//While loop
            ?>

    </div>
  </div>

</section>

  </main><!-- End #main -->

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | Dashboard";
</script>

</body>

</html>