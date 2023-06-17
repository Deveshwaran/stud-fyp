<?php
  include('../includes/header.php');
  include('../includes/navbarstudent.php');
  include('../includes/database.php');
?>

<?php
  $fypStudentID = $_SESSION['fypStudentID'];

  if(isset($_POST['submit'])){
    $projectName = $_POST['projectName'];
    
    if(count($_FILES) > 0) {
      if(is_uploaded_file($_FILES['proposalFile']['tmp_name'])) {
        $fileData = addslashes(file_get_contents($_FILES['proposalFile']['tmp_name']));
        
        $strSQL = "UPDATE FinalYearProject SET ProjectName = '$projectName', WorkFile = '{$fileData}' WHERE FYPStudentID = '$fypStudentID'";
        mysqli_query($link, $strSQL);
      }
    }
  }
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <?php 
                //SQL query
                $strSQL = "SELECT AnnouncementID, Title, Content FROM FYPAnnouncement WHERE Status = 1";

                //Execute the query (the recordset $rs contains the result)
                $rs = mysqli_query($link, $strSQL);

                //Number of rows
                $results = $rs->num_rows;
  
                $i=0;
              ?>

              <h5 class="card-title"><?php echo $results>0 ? 'Announcements' : 'No Announcements';?></h5>

              <!-- Slides with captions -->
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <?php
                    for($j=0; $j<$results; $j++){
                  ?>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $j;?>" class="<?php echo $j==0 ? 'active' : '';?>" aria-current="<?php echo $j==0 ? 'true' : '';?>"></button>
                  <?php }//For loop?>   
                </div>  
                
                <div class="carousel-inner">
                  
                  <?php
                    //Loop the recordset $rs 
                    //Each row will be made into an array ($row) using mysql_fetch_array
                    while ($row=mysqli_fetch_array($rs)){
                      $i++;
                  ?>

                  <div class="carousel-item <?php echo $i==1 ? 'active' : '';?>">
                    <img src="<?php echo "image/".$row['Content'];?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5 class="card-title"><?php echo $row['Title'];?></h5>
                    </div>
                  </div>

                  <?php }//While loop?>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with captions -->

            </div>
          </div>

        </div>

        <div class="col-lg-12">

          <?php
            //SQL query
            $strSQL = "SELECT * FROM FinalYearProject WHERE FYPStudentID='$fypStudentID'";

            //Execute the query (the recordset $rs contains the result)
            $rs = $link->query($strSQL);

            //Loop the recordset $rs 
            //Each row will be made into an array ($row) using mysql_fetch_array 
            if ($rs->num_rows > 0) {
              $row = $rs->fetch_assoc();

              //If Project Name not set
              if($row['ProjectName']!=''){
          ?>

          <!-- If Project Name is set -->
          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Proposal Submission <span>| Submitted</span></h5>

              <!-- General Form Elements -->
              <div class="row mb-3">
                <div class="col-lg-2 col-md-2 label">Project Name</div>
                <div class="col-lg-10 col-md-10"><?php echo $row['ProjectName'];?></div>
              </div>
                
              <div class="row mb-3">
                <div class="col-lg-2 col-md-2 label">Project File</div>
                <div class="col-lg-10 col-md-10">
                  <a href="transaction.php?action=workfile&id=<?php echo $row['FYPID'];?>" class="btn btn-primary btn-sm" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="View Proposal File">
                    <i class="bi bi-eye-fill"></i>
                  </a>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProposal" title="Remove Submission">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </div>

              <!-- Delete Proposal Modal -->
              <div class="modal fade" id="deleteProposal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Submission</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to remove the Proposal Submission?
                    </div>
                    <div class="modal-footer">
                      <a href="transaction.php?action=deletefile&id=<?php echo $row['FYPID'];?>" class="btn btn-primary">Yes</a>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div><!-- Delete Proposal Modal-->

            </div>
          </div>
        
          <?php
            }else{
          ?>

          <!-- If Project Name not set -->
          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Proposal Submission</h5>

              <!-- General Form Elements -->
              <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Project Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="projectName" required>
                    <div class="invalid-feedback">
                      Please enter the Project Name.
                    </div>  
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="proposalFile" id="formFile" accept="application/pdf" required>
                    <div class="invalid-feedback">
                      Please upload the Proposal.
                    </div>
                  </div>
                </div>

               <button type="submit" name="submit" class="btn btn-primary" style="float:right;">Submit</button>

              </form><!-- End General Form Elements -->

            </div>
          </div>

          <?php }}//If statement?>

          <!-- Submissions -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Submissions</h5>

              <?php
                //SQL query
                $strSQL = "SELECT ActivityID, Title, EndDateTime, DATEDIFF(EndDateTime, CURDATE()) AS Days 
                FROM FYPActivity WHERE 
                StartDateTime BETWEEN StartDateTime AND CURDATE() AND
                EndDateTime BETWEEN CURDATE() AND EndDateTime
                ORDER BY EndDateTime ASC";
                
                //Execute the query (the recordset $rs contains the result)
                $rs = mysqli_query($link, $strSQL);

                //Loop the recordset $rs 
                //Each row will be made into an array ($row) using mysql_fetch_array 
                while ($row=mysqli_fetch_array($rs)){

                  $activityID = $row['ActivityID'];

                  //SQL query
                  $strSQL1 = "SELECT fypactivity.Title, submission.ActivityID, submission.FYPStudentID FROM fypactivity 
                  INNER JOIN submission ON fypactivity.ActivityID = submission.ActivityID
                  WHERE submission.ActivityID='$activityID' AND FYPStudentID='$fypStudentID'";

                  //Execute the query (the recordset $rs contains the result)
                  $rs1 = $link->query($strSQL1);

                  //Loop the recordset $rs 
                  //Each row will be made into an array ($row) using mysql_fetch_array 
                  if ($rs1->num_rows > 0) {
                    $submission = true;
                  }else{
                    $submission = false;
                  }
                  
              ?>

              <!-- List group with Advanced Contents -->
              <div class="list-group">
                <a href="submission.php?id=<?php echo $row['ActivityID'];?>" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo $row['Title'];?></h5>
                    <small><?php echo $row['Days'].' days remaining'?></small>
                  </div>
                  <p class="mb-1"><?php echo ($submission) ? 'Submitted' : 'Not Submitted';?></p>
                  <small><?php echo 'Due on '.date('jS \of F Y h:i A', strtotime($row['EndDateTime']));?></small>
                </a>
              </div><!-- End List group Advanced Content -->

              <?php }//While loop?>

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
  document.title = "StudFYP | Home";

  var element = document.getElementById("home");
  element.classList.remove("collapsed");
</script>

</body>

</html>