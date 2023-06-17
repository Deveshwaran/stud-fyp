<?php
  include('../includes/header.php');
  include('../includes/navbar.php');
  include('../includes/database.php');
?>

<?php
  $UserID = $_SESSION['userID'];

  $sql = "SELECT tabledisplay.Name, tabledisplay.FYPID, tabledisplay.MatricID, tabledisplay.ProjectName, rating.Rate, rating.UserID FROM tabledisplay RIGHT JOIN rating ON tabledisplay.FYPID=rating.FYPID WHERE rating.UserID='$UserID'";

  $rs = $link->query($sql);

  //Loop the recordset $rs 
  //Each row will be made into an array ($row) using mysql_fetch_array 
  $row = mysqli_fetch_array($rs);

  if (isset($_POST['submit'])) {
    
    $rating = $_POST["rating"];

    $sql = "UPDATE rating SET Rate='$rating' WHERE UserID='$UserID'";

    if (mysqli_query($link, $sql)) {
      echo '<script>alert("Updated successfully");window.location.href = "displayrating.php";</script>';
    } else {
      echo '<script>alert("Something went wrong!")</script>';
    }
  }
?>

<main id="main" class="main">

  <head>  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  </head>

  <div class="pagetitle">
    <h1>Edit Rating</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <center>
              <h5 class="card-title">Update Rating</h5>
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

                <form method="post">
                  <tr>
                    <td>1</td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['MatricID'];?></td>
                    <td><?php echo $row['ProjectName'];?></td>
                    <td>
                      <div class="rateyo" id="rating" data-rateyo-rating="<?php echo $row['Rate'];?>" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                      <span class='result'><?php echo $row['Rate'];?></span>
                      <input type="hidden" name="rating">
                    </td>
                    <td><input type="submit" name="submit" class="btn btn-primary"></td>
                  </tr>
                </form>

              </tbody>
            </table>
            <!-- End Table with stripped rows -->

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
  document.title = "StudFYP | Edit Rating";

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