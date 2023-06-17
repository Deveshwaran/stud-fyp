<?php
  include('../includes/header.php');
  include('../includes/navbarstudent.php');
  include('../includes/database.php');
?>

<?php
  $fypStudentID = $_SESSION['fypStudentID'];

  //SQL query
  $strSQL = "SELECT MAX(DATE(DateTime)) AS DateTime FROM Logbook WHERE FYPStudentID='$fypStudentID'";

  //Execute the query (the recordset $rs contains the result)
  $rs = mysqli_query($link, $strSQL);

  //Loop the recordset $rs 
  //Each row will be made into an array ($row) using mysql_fetch_array 
  while ($row=mysqli_fetch_array($rs)){
    $latestDateTime = $row['DateTime'];
  }

  //Today's date
  $date = date('Y-m-d');

  //Set first date for Logbook
  $logbookFirstDate = '2021-12-31';

  //Set latest date
  $latestDate = $latestDateTime!='' ? substr($latestDateTime,0,10) : $logbookFirstDate;

  //Get difference in date
  $datediff = time() - strtotime($latestDate);

  //Convert to days
  //Conflict with GMT time
  $day = round($datediff / (60 * 60 * 24))-2;

  //If got difference in latest date and today
  if($day>0){
    for($i=1; $i<=$day; $i++){
      //Set previous date
      $dateTime = date('Y-m-d H:i:s', strtotime('-'.$i.' day', strtotime($date)));

      //SQL query
      $strSQL = "INSERT INTO Logbook (FYPStudentID, DateTime, Content) VALUES ('$fypStudentID', '$dateTime', '')";

      //Execute the query
      mysqli_query($link, $strSQL);
    }
  }
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

    <script>
      var submitted = 0;
      var overdue = 0;
    </script>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">

          <!-- Today's Logbook -->
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Today's Logbook <span>| <?php echo date('jS \of F Y');?></span></h5>

              <?php 
                //SQL query
                $strSQL = "SELECT * FROM Logbook WHERE FYPStudentID='$fypStudentID' AND DATE(DateTime) = DATE(CURDATE())";

                //Execute the query (the recordset $rs contains the result)
                $rs = $link->query($strSQL);

                //Loop the recordset $rs 
                //Each row will be made into an array ($row) using mysql_fetch_array 
                if ($rs->num_rows > 0) {
                  $row = $rs->fetch_assoc();
                  $logbook = true;
                }else{
                  $logbook = false;
                }
              ?>

              <div class="d-flex align-items-center">
                <div class=" card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="ri-book-2-fill"></i>
                </div>
                <div class="ps-3">
                  <h6>
                    <?php 
                      if($logbook){
                        echo 'You have submitted the logbook for today. <a class="btn btn-info" href="viewlogbook.php?id='.$row["LogbookID"].'"><i class="bi bi-eye-fill"></i> View</a>';
                      }else{
                        echo 'Logbook is due today! <a class="btn btn-primary" href="addlogbook.php"><i class="ri-add-box-fill"></i> Add</a>';
                      }
                    ?>
                  </h6>
                </div>
              </div>

            </div>
          </div>
          <!-- End Today's Logbook -->

          <!-- Logbook Activities -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Logbook Activities</h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Supervisor's Feedback</th>
                    <th scope="col">Evaluator's Feedback</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                    //SQL query
                    $strSQL = "SELECT * FROM Logbook WHERE FYPStudentID='$fypStudentID' ORDER BY DateTime DESC";

                    //Execute the query (the recordset $rs contains the result)
                    $rs = mysqli_query($link, $strSQL);

                    //Loop the recordset $rs 
                    //Each row will be made into an array ($row) using mysql_fetch_array 
                    while ($row=mysqli_fetch_array($rs)){
                  ?>

                  <tr>
                    <th scope="row">
                      <a class="btn btn-info btn-sm" href="viewlogbook.php?id=<?php echo $row['LogbookID']?>">
                        <i class="bi bi-eye-fill"></i>
                        View
                      </a>
                    </th>
                    <td><?php echo date('d/m/Y', strtotime($row['DateTime']));?></td>
                    <td>
                      <span class="<?php echo $row['Content']!='' ? 'badge bg-success' : 'badge bg-danger';?>">
                        <?php 
                          if($row['Content']!=''){
                            echo 'Submitted';
                            echo '<script>submitted++;</script>';
                          }else{
                            echo 'Overdue';
                            echo '<script>overdue++;</script>';
                          } 
                        ?>
                      </span>
                    </td>
                    <td><?php echo $row['SupervisorFeedback']!='' ? $row['SupervisorFeedback'] : 'None';?></td>
                    <td><?php echo $row['EvaluatorFeedback']!='' ? $row['EvaluatorFeedback'] : 'None';?></td>
                  </tr>
                  
                  
                  <?php }//While loop?>

                </tbody>
              </table>
            
            </div>

          </div>
          <!-- End Logbook Activities -->

        </div>
        <!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Pie Chart -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Logbook Submissions</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <!-- End Pie CHart -->

            </div>
          </div>
          <!-- End Pie Chart -->

        </div>
        <!-- End Right side columns -->

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

  document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector('#pieChart'), {
      type: 'pie',
      data: {
        labels: [
          'Submitted',
          'Overdue'
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [submitted, overdue],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)'
          ],
          hoverOffset: 4
        }]
      }
    });
  });
</script>

</body>

</html>