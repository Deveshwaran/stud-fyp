<?php
  include('../includes/header.php');
  include('../includes/navbarstudent.php');
  include('../includes/database.php');
?>

<?php
  $activityID = $_GET['id'];
  $fypStudentID = $_SESSION['fypStudentID'];

  //Submit form
  if(isset($_POST['submit'])){
    $comment = isset($_POST['comment']) ? $_POST['comment'] : NULL;
  
    if(count($_FILES) > 0) {
      if(is_uploaded_file($_FILES['submissionFile']['tmp_name'])) {
        $fileData = addslashes(file_get_contents($_FILES['submissionFile']['tmp_name']));
        $fileName = $_FILES['submissionFile']['name'];
        
        //SQL query
        $strSQL = "INSERT INTO Submission (FYPStudentID, ActivityID, DateTime, SubmissionName, Content, Comment) 
        VALUES ('$fypStudentID', '$activityID', SYSDATE(), '$fileName', '{$fileData}', '$comment')";
  
        //Execute the query 
        mysqli_query($link, $strSQL);
      }
    }
  }
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Submission</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Submission</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

      <?php
        //SQL query
        $strSQL = "SELECT fypactivity.Title, fypactivity.EndDateTime, submission.* FROM fypactivity 
        INNER JOIN submission ON fypactivity.ActivityID = submission.ActivityID
        WHERE submission.ActivityID = '$activityID' AND FYPStudentID = '$fypStudentID'";

        //Execute the query (the recordset $rs contains the result)
        $rs = $link->query($strSQL);

        //Loop the recordset $rs 
        //Each row will be made into an array ($row) using mysql_fetch_array 
        if ($rs->num_rows > 0) {
          $row = $rs->fetch_assoc();

      ?>

      <!-- If submitted -->
      <div class="card">
        <div class="card-body">

          <h5 class="card-title"><?php echo $row['Title'].' Submission ';?><span>| <?php echo 'Due on '.date('jS \of F Y h:i A', strtotime($row['EndDateTime']));?></span></h5>
            
            <div class="row mb-3">
              <div class="col-lg-2 col-md-2 label">Uploaded File</div>
              <div class="col-lg-10 col-md-10"><?php echo $row['SubmissionName'];?></div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-2 col-md-2 label">Comments</div>
              <div class="col-lg-10 col-md-10"><?php echo $row['Comment']!='' ? $row['Comment'] : 'None';?></div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-2 col-md-2 label">Submitted On</div>
              <div class="col-lg-10 col-md-10"><?php echo date('d/m/Y h:i:s A', strtotime($row['DateTime']));?></div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-2 col-md-2 label">Actions</div>
              <div class="col-lg-10 col-md-10">
                <a href="transaction.php?action=submissionfile&id=<?php echo $row['SubmissionID'];?>" class="btn btn-primary btn-sm" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="View Uploaded File">
                  <i class="bi bi-eye-fill"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSubmission" title="Remove Submission">
                  <i class="bi bi-trash"></i>
                </button>  
              </div>
            </div>

            <!-- Delete Submission Modal -->
            <div class="modal fade" id="deleteSubmission" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to remove the Submission?
                  </div>
                  <div class="modal-footer">
                    <a href="transaction.php?action=deletesubmission&id=<?php echo $row['SubmissionID'];?>&activity=<?php echo $row['ActivityID'];?>" class="btn btn-primary">Yes</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div><!-- Delete Submission Modal-->

        </div>
      </div>

      <?php
        }else{
        //SQL query
        $strSQL = "SELECT ActivityID, Title, EndDateTime FROM FYPActivity WHERE ActivityID = '$activityID'";

        //Execute the query (the recordset $rs contains the result)
        $rs = mysqli_query($link, $strSQL);

        //Loop the recordset $rs 
        //Each row will be made into an array ($row) using mysql_fetch_array 
        while ($row=mysqli_fetch_array($rs)){
      ?>

      <!-- If not submitted -->
      <div class="card">
        <div class="card-body">

          <h5 class="card-title"><?php echo $row['Title'].' Submission ';?><span>| <?php echo 'Due on '.date('jS \of F Y h:i A', strtotime($row['EndDateTime']));?></span></h5>

          <!-- General Form Elements -->
          <form class="needs-validation" enctype="multipart/form-data" method="post" novalidate>
            
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
              <div class="col-sm-10">
                <input class="form-control" name="submissionFile" type="file" id="formFile" accept="application/pdf" required>
                <div class="invalid-feedback">
                  Please upload the <?php echo $row['Title'];?>.
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Comments <code>(optional)</code></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="comment">  
              </div>
            </div>

           <button type="submit" name="submit" class="btn btn-primary" style="float:right;">Submit</button>

          </form><!-- End General Form Elements -->

        </div>
      </div>

      <?php }}//While loop //Else statement?>

    </section>

  </main><!-- End #main -->

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | Submission";
  
  var element = document.getElementById("home");
  element.classList.remove("collapsed");
</script>

</body>

</html>