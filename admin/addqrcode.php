<?php
  include('../includes/header.php');
  include('../includes/navbaradmin.php');
  include('../includes/database.php');
  include('../assets/vendor/phpqrcode/qrlib.php');
?>
<?php 
  if(isset($_POST['submit'])){
    $text = $_POST['qrcontent'];

    $path = '../qrimg/';
    $file = $path . uniqid() . ".png";

    //other parameters
    $ecc = 'L';
    $pixel_size = 20;
    $frame_size = 2;

    //header("Content-type: application/pdf");
    $strSQL = "UPDATE qrcode SET QRCodePath = '{$file}', Content = '$text' WHERE QRCodeID = 1";
    
    if(mysqli_query($link, $strSQL)){
      echo '<script>alert("Updated successfully!");</script>';

      //QR Code generator content
      QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
    }
  }
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Add QR Code</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Update QR Code Content</h5>

          <!-- Logbook Form -->
          <form class="needs-validation" method="post" novalidate>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">QR Code Content</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="qrcontent" required>
                <div class="invalid-feedback">
                  Please enter QR Code content.
                </div>  
              </div>
            </div>

            <div class="col-12">
              <button class="btn btn-primary" type="submit" name="submit" style="float: right;">Submit</button>
            </div>
            
          </form><!-- End Logbook Form -->

        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">QR Code Details</h5>

          <!-- Default Table -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">QR Code ID</th>
                <th scope="col">QR Code Path</th>
                <th scope="col">QR Code Content</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //SQL query
                $strSQL = "SELECT * FROM QRCode";

                //Execute the query (the recordset $rs contains the result)
                $rs = mysqli_query($link, $strSQL);

                //Loop the recordset $rs 
                //Each row will be made into an array ($row) using mysql_fetch_array 
                while ($row=mysqli_fetch_array($rs)){
              ?>
              <tr>
                <td><?php echo $row['QRCodeID'];?></td>
                <td><?php echo $row['QRCodePath'];?></td>
                <td><?php echo $row['Content'];?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- End Default Table Example -->
        </div>
      </div>

    </section>

  </main><!-- End #main -->

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | QR Code";

  var element = document.getElementById("qrcode");
  element.classList.remove("collapsed");
</script>

</body>

</html>