<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>StudFYP</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<?php
  //Set timezone
  date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<body>

<?php
  include('includes/database.php');
?>

<?php
  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    //SQL query for student
    $strSQL = "SELECT user.*, student.StudentID, fypstudent.FYPStudentID
    FROM user 
    INNER JOIN student ON user.UserID = student.UserID
    INNER JOIN fypstudent ON student.StudentID = fypstudent.StudentID
    WHERE user.username = '$username' AND user.password = '$password'";

    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);

    if ($rs->num_rows > 0) {
      session_start();
      $row = $rs->fetch_assoc();
      $_SESSION['name'] = $row['Name'];
      $_SESSION['userID'] = $row['UserID'];
      $_SESSION['fypStudentID'] = $row['FYPStudentID'];

      echo '<script>window.location.replace("pages/home.php");</script>';
    }

    //SQL query for coordinator
    $strSQL = "SELECT user.*, lecturer.LecturerID, coordinator.CoordinatorID
    FROM user 
    INNER JOIN lecturer ON user.UserID = lecturer.UserID
    INNER JOIN coordinator ON lecturer.LecturerID = coordinator.LecturerID
    WHERE user.username = '$username' AND user.password = '$password'";

    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);

    if ($rs->num_rows > 0) {
      session_start();
      $row = $rs->fetch_assoc();
      $_SESSION['name'] = $row['Name'];
      $_SESSION['userID'] = $row['UserID'];
      $_SESSION['lecturerID'] = $row['LecturerID'];
      $_SESSION['coordinatorID'] = $row['CoordinatorID'];

      echo '<script>window.location.replace("pages/coordinatormenu.php");</script>';
    }

    //SQL query for supervisor
    $strSQL = "SELECT user.*, lecturer.LecturerID
    FROM user 
    INNER JOIN lecturer ON user.UserID = lecturer.UserID
    WHERE user.username = '$username' AND user.password = '$password'";

    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);

    if ($rs->num_rows > 0) {
      session_start();
      $row = $rs->fetch_assoc();
      $_SESSION['name'] = $row['Name'];
      $_SESSION['userID'] = $row['UserID'];
      $_SESSION['lecturerID'] = $row['LecturerID'];

      echo '<script>window.location.replace("pages/index_umiera.php");</script>';
    }
    
    //SQL query for industrial staff
    $strSQL = "SELECT user.*, industrialstaff.IndustrialStaffID
    FROM user 
    INNER JOIN industrialstaff ON user.UserID = industrialstaff.UserID
    WHERE user.username = '$username' AND user.password = '$password'";

    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);

    if ($rs->num_rows > 0) {
      session_start();
      $row = $rs->fetch_assoc();
      $_SESSION['name'] = $row['Name'];
      $_SESSION['userID'] = $row['UserID'];
      $_SESSION['industrialStaffID'] = $row['IndustrialStaffID'];

      echo '<script>window.location.replace("pages/show.php");</script>';
    }

    //SQL query for admin
    $strSQL = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";

    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);

    if ($rs->num_rows > 0) {
      session_start();
      $row = $rs->fetch_assoc();
      $_SESSION['name'] = $row['Username'];
      $_SESSION['adminID'] = $row['AdminID'];

      echo '<script>window.location.replace("admin/addqrcode.php");</script>';
    }
  }
?>

<body>

<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="../assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">StudFYP</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your username & password to login</p>
                </div>

                <form class="row g-3 needs-validation" method="post" novalidate>

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="username" class="form-control" id="yourUsername" required>
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" name="submit" type="submit">Login</button>
                  </div>
                </form>

              </div>
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script>
  document.title = "StudFYP | Login";
</script>

</body>

</html>