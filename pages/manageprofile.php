<?php
  include('../includes/header.php');
  include('../includes/navbarlecturer.php');
  include('../includes/database.php');
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_umiera.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <?php 
        $userID=$_SESSION['userID'];

        //SQL query
        $strSQL = "SELECT user.UserID, user.Name, user.PhoneNum, user.Email, lecturer.OfficeLoc, lecturer.Expertise 
        FROM user 
        INNER JOIN lecturer ON user.UserID = lecturer.UserID 
        INNER JOIN finalyearproject ON lecturer.LecturerID = finalyearproject.FacultySupervisor
        WHERE lecturer.UserID='$userID'
        LIMIT 1";

        //Execute the query (the recordset $rs contains the result)
        $rs = mysqli_query($link, $strSQL);

        //Loop the recordset $rs 
        //Each row will be made into an array ($row) using mysql_fetch_array 
        $i=0;
        while ($row=mysqli_fetch_array($rs)){
        ?>

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="../assets/img/profile.png" alt="Profile" class="rounded-circle">
                    <h2><?php echo $row['Name']; ?></h2>
                    <h3>Supervisor</h3>
                    <div class="social-links mt-2">
                      <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>

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
                <div class="col-lg-9 col-md-8"><?php echo $row['Email'];?></div>
              </div>

                </div>

              </div><!-- End Bordered Tabs -->

              <div style="float:right">

                <a href="manageprofile-edit.php">
                <button type="button"  class="btn btn-primary">Edit</button>
                </a>
              </div>
            </div>
          </div>
        
        <?php } ?>

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