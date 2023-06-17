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

    <section class="section">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Logbook for <?php echo date('l, jS \of F Y');?></h5>

          <?php 
            $logbookID = $_GET['id'];

            //If form submitted
            if(isset($_POST['submit'])){
              $dateTime = date('Y-m-d H:i:s');
              $content = $_POST['content'];

              //SQL query
              $strSQL = "UPDATE Logbook SET DateTime = '$dateTime', Content = '$content' WHERE LogbookID='$logbookID'";

              //Execute the query
              if (mysqli_query($link, $strSQL)) {
                //Redirect
                echo '<script>window.location.replace("viewlogbook.php?id='.$logbookID.'");</script>';
              }

            }

            //SQL query
            $strSQL = "SELECT Content FROM Logbook WHERE LogbookID='$logbookID'";

            //Execute the query (the recordset $rs contains the result)
            $rs = mysqli_query($link, $strSQL);

            //Loop the recordset $rs 
            //Each row will be made into an array ($row) using mysql_fetch_array 

            while ($row=mysqli_fetch_array($rs)){
          ?>

          <!-- Logbook Form -->
          <form class="needs-validation" method="post" novalidate>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Date Time</label>
              <div class="col-sm-10">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar"></i></span>
                  <input type="text" class="form-control" name="dateTime" value="<?php echo date('d/m/Y h:i A');?>" aria-describedby="basic-addon1" readonly>
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Reflection on Tasks</label>
              <div class="col-sm-10">
                <div class="form-floating mb-3">
                  <textarea class="form-control" id="floatingTextarea" name="content" placeholder="Leave a comment here" style="height: 500px;" required><?php echo $row['Content'];}//While loop?></textarea>
                  <label for="floatingTextarea">Comments</label>
                  <div class="invalid-feedback">
                    Please enter the comments.
                  </div>  
                </div>  
              </div>
            </div>

            <div class="col-12">
              <button class="btn btn-primary" type="submit" name="submit" style="float: right;">Update</button>
            </div>
            
          </form><!-- End Logbook Form -->

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