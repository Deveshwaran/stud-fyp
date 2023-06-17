<?php
  include('../includes/header.php');
  include('../includes/navbarstudent.php');
  include('../includes/database.php');
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Logbook</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Logbook</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

      <div class="card profile-overview">
        <div class="card-body">

          <?php 
            $logbookID = $_GET['id'];

            //SQL query
            $strSQL = "SELECT * FROM Logbook WHERE LogbookID='$logbookID'";

            //Execute the query (the recordset $rs contains the result)
            $rs = mysqli_query($link, $strSQL);

            //Loop the recordset $rs 
            //Each row will be made into an array ($row) using mysql_fetch_array 

            while ($row=mysqli_fetch_array($rs)){
          ?>

          <h5 class="card-title">Logbook for <?php echo date('l, jS \of F Y', strtotime($row['DateTime']));?></h5>

          <div class="row ">
            <div class="col-lg-2 col-md-2 label">Date Time</div>
            <div class="col-lg-10 col-md-10"><?php echo date('d/m/Y h:i:s A', strtotime($row['DateTime']));?></div>
          </div>

          <div class="row ">
            <div class="col-lg-2 col-md-2 label">Reflection on Tasks</div>
            <div class="col-lg-10 col-md-10"><?php echo $row['Content']!='' ? $row['Content'] : 'None (Overdue)';?></div>
          </div>

          <div class="row ">
            <div class="col-lg-2 col-md-2 label">Supervisor's Feedback</div>
            <div class="col-lg-10 col-md-10"><?php echo $row['SupervisorFeedback']!='' ? $row['SupervisorFeedback'] : 'None';?></div>
          </div>

          <div class="row ">
            <div class="col-lg-2 col-md-2 label">Evaluator's Feedback</div>
            <div class="col-lg-10 col-md-10"><?php echo $row['EvaluatorFeedback']!='' ? $row['EvaluatorFeedback'] : 'None';?></div>
          </div>

          <div class="col-12">
            <?php
                if(substr($row['DateTime'],0,10)==date("Y-m-d")){
                  echo '<a class="btn btn-primary" href="editlogbook.php?id='.$logbookID.'" style="float: right;"><i class="ri-edit-box-fill me-1"></i> Edit</a>';
                }
              }//While loop
            ?>
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
  document.title = "StudFYP | Logbook";
  
  var element = document.getElementById("logbook");
  element.classList.remove("collapsed");
</script>

</body>

</html>