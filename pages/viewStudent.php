<?php
  include('../includes/header.php');
  include('../includes/navbarlecturer.php');
  include('../includes/database.php');
?>

<style>
  .center {
  display: block;
  margin-left: auto;
  margin-right: auto;}

  .text_center 
  {text-align: center;}

}

</style>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Student</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_umiera.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

      <div>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></h5>
              <!-- Bordered Table -->
              <table class="table table-bordered"> 
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Details</th>
                    <th scope="col">Status</th>
                    <th scope="col">Student Logbook</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  //SQL query
                  $strSQL = "SELECT fypstudent.ActiveStatus, student.MatricID, user.Name, user.PhoneNum, user.Email 
                  FROM user 
                  JOIN student ON user.UserID = student.UserID 
                  JOIN fypstudent ON student.StudentID = fypstudent.StudentID";

                  //Execute the query (the recordset $rs contains the result)
                  $rs = mysqli_query($link, $strSQL);

                  //Loop the recordset $rs 
                  //Each row will be made into an array ($row) using mysql_fetch_array 
                  while ($row=mysqli_fetch_array($rs)){
                ?>
                <tr>
                  <th scope="row">i</th>
                  <td><dl>
                        <dt>Student ID</dt>
                          <dd><?php echo $row['MatricID'];?></dd>
                        <dt>Name</dt>
                          <dd><?php echo $row['Name'];?></dd>
                        <dt>Contact</dt>
                          <dd><?php echo $row['PhoneNum'];?></dd>
                        <dt>Email</dt>
                          <dd><?php echo $row['Email'];?></dd>
                      </dl></td>
                      <td class="text-center"><span class="badge bg-success"><?php echo $row['ActiveStatus']==1? "Active" : "Inactive";?></span></td>
                  
                  <td><div class = "text-center">
                        <a href="StudentLogbook.php"><button type="button"  class="btn btn-primary">View</button></a>
                  </div></td>
                  </tr>

                <?php 
                  } //While loop
                ?>
                </tbody>
              </table>
              <!-- End Bordered Table -->
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
  document.title = "StudFYP | Dashboard";
</script>

</body>
</html>