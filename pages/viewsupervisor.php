<?php
  include('../includes/header.php');
  include('../includes/navbarstudent.php');
  include('../includes/database.php');
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Supervisor Info</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Supervisor Info</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="col-xl-12">

          <div class="card profile-overview">
            <div class="card-body">

              <?php 
                $fypStudentID = $_SESSION['fypStudentID'];

                //SQL query
                $strSQL = "SELECT user.Name, user.PhoneNum, user.Email, lecturer.OfficeLoc, lecturer.Expertise, finalyearproject.FYPStudentID 
                FROM user 
                INNER JOIN lecturer ON user.UserID = lecturer.UserID 
                INNER JOIN finalyearproject ON lecturer.LecturerID = finalyearproject.FacultySupervisor
                WHERE FYPStudentID = '$fypStudentID'";

                //Execute the query (the recordset $rs contains the result)
                $rs = mysqli_query($link, $strSQL);

                //Loop the recordset $rs 
                //Each row will be made into an array ($row) using mysql_fetch_array 
                while ($row=mysqli_fetch_array($rs)){
              ?>
              
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="../assets/img/profile.png" alt="Profile" class="rounded-circle">
                <h2><?php echo $row['Name'];?></h2>
                <h3><?php echo $row['Expertise'];?></h3>
              </div>
                
              <h5 class="card-title">Supervisor Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Full Name</div>
                <div class="col-lg-9 col-md-8"><?php echo $row['Name'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Expertise</div>
                <div class="col-lg-9 col-md-8"><?php echo $row['Expertise'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Office Location</div>
                <div class="col-lg-9 col-md-8"><?php echo $row['OfficeLoc'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone</div>
                <div class="col-lg-9 col-md-8"><?php echo $row['PhoneNum'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?php echo $row['Email'];}?></div>
              </div>

            </div>
          </div>

        </div>

    </section>

  </main><!-- End #main -->

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | Supervisor Info";
  
  var element = document.getElementById("viewsupervisor");
  element.classList.remove("collapsed");
</script>

</body>

</html>