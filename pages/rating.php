<?php
  include('../includes/header.php');
  include('../includes/navbar.php');
  include('../includes/database.php');
?>

<main id="main" class="main">

  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  </head>

  <div class="pagetitle">
    <h1>Rating</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <?php
              $UserID = $_SESSION['userID'];

              //SQL query
              $strSQL = "SELECT * FROM rating WHERE UserID='$UserID'";

              //Execute the query (the recordset $rs contains the result)
              $rs = mysqli_query($link, $strSQL);

              //Loop the recordset $rs 
              //Each row will be made into an array ($row) using mysql_fetch_array 
              if ($rs->num_rows > 0) {
                  $UserID = true;
              } else {
                  $UserID = false;
              }

              if (!$UserID) {
            ?>

            <center>
              <h5 class="card-title">TOP 10 FYP II STUDENT LIST</h5>
            </center>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Matric ID</th>
                  <th scope="col">Project Title</th>
                  <th scope="col">Rate</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

              <?php
                $strSQL = "SELECT * FROM tabledisplay";
                $i = 0;

                //Execute the query (the recordset $rs contains the result)
                $rs = $link->query($strSQL);

                //Loop the recordset $rs 
                //Each row will be made into an array ($row) using mysql_fetch_array 
                while ($row = mysqli_fetch_array($rs)) {
                  $i++;
              ?>

                <form action="insertrating.php?id=<?php echo $row['FYPID']; ?>" method="post">
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['MatricID'];?></td>
                    <td><?php echo $row['ProjectName'];?></td>
                    <td>
                      <div class="rateyo" id="rating" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                      <span class='result'>0</span>
                      <input type="hidden" name="rating">
                    </td>
                    <td><input type="submit" name="submit" class="btn btn-primary"></td>
                  </tr>
                </form>

              <?php 
                  }//While loop
              ?>

              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <?php
              }else{
            ?>

            <center>
              <h5 class="card-title">You have already voted</h5>
              <a href="displayrating.php" class="btn btn-primary">Display Ratings</a>
            </center>

            <?php 
              }//Else statement
            ?>

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
  document.title = "StudFYP | Rating";

  var x = document.getElementsByTagName("BODY")[0];
  x.classList.add("toggle-sidebar");

  $(function() {
    $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
      var rating = data.rating;
      $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
      $(this).parent().find('.result').text('Rating: ' + rating);
      $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
    });
  });
</script>

</body>

</html>