<?php
  include('../includes/header.php');
  include('../includes/navbar.php');
  include('../includes/database.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Display Rating</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">

      <div class="col-lg-8">

        <div class="card">
          <div class="card-body">
            <center>
              <h5 class="card-title">TOP 10 FYP II STUDENT LIST</h5>
            </center>

            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Project Details</th>
                  <th scope="col">Cummulative Rate</th>
                </tr>
              </thead>

              <tbody>

                <?php
                  //SQL query
                  $strSQL = "SELECT COALESCE(SUM(Rate),0) AS Rate, tabledisplay.FYPID,tabledisplay.Name, tabledisplay.ProjectName from rating right join tabledisplay on rating.FYPID = tabledisplay.FYPID GROUP BY FYPID ORDER BY Rate DESC";

                  //Execute the query (the recordset $rs contains the result)
                  $rs = mysqli_query($link, $strSQL);

                  $i = 0;

                  //Loop the recordset $rs 
                  //Each row will be made into an array ($row) using mysql_fetch_array 
                  while ($row = mysqli_fetch_array($rs)) {
                    $i++;
                ?>

                <tr>
                  <td><?php echo $i;?></td>
                  <td id="name<?php echo $i;?>">
                    <?php echo $row['Name'];?>
                  </td>
                  <td><?php echo $row['ProjectName'];?></td>
                  <td id="rate<?php echo $i;?>">
                    <?php echo $row['Rate'];?>
                  </td>
                </tr>

                <?php 
                  } //While loop
                ?>

              </tbody>

            </table>
            <!-- End Table with stripped rows -->
          </div>

        </div>
      
      </div>

      <div class="col-lg-4">

        <div class="card">
          <div class="card-body">
            
            <h5 class="card-title">Your Vote</h5>

            <?php
              $UserID = $_SESSION['userID'];
              $strSQL = "SELECT tabledisplay.ProjectName, tabledisplay.FYPID, tabledisplay.MatricID, tabledisplay.Name, rating.UserID FROM tabledisplay INNER JOIN rating on tabledisplay.FYPID=rating.FYPID WHERE rating.UserID='$UserID'";

              //Execute the query (the recordset $rs contains the result)
              $rs = mysqli_query($link, $strSQL);

              //Loop the recordset $rs 
              //Each row will be made into an array ($row) using mysql_fetch_array 
              while ($row = mysqli_fetch_array($rs)) {
            ?>
          
            <p>You have voted for <b><?php echo $row['Name'];?></b>, <b><?php echo $row['MatricID'];?></b> with Project Title <b><?php echo $row['ProjectName'];?></b></p>
            <a href="deleterating.php" class="btn btn-danger" style="float: right;"><i class="bi bi-trash"></i> Delete</a>
            <a href="editrating.php" class="btn btn-info" style="float: right; margin-right: 5px;"><i class="ri-edit-box-fill"></i> Edit</a>
            
            <?php 
              } //While loop 
            ?>

          </div>
        </div>
        
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">View Rating Chart</h5>

            <?php
              //SQL query
              $strSQL = "SELECT QRCodePath FROM qrcode";

              //Execute the query (the recordset $rs contains the result)
              $rs = mysqli_query($link, $strSQL);

              $row = mysqli_fetch_assoc($rs);
            ?>

            <center>
              <div style="height:300px; width:300px;">
                <img src="<?php echo $row['QRCodePath'];?>" class="d-block w-100" alt="...">
              </div>
            </center>
             
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
  document.title = "StudFYP | Display Rating";

  var x = document.getElementsByTagName("BODY")[0];
  x.classList.add("toggle-sidebar");
</script>

</body>

</html>