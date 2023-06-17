<?php
  include('../includes/header.php');
  include('../includes/database.php');
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="#" class="logo d-flex align-items-center">
      <img src="#" alt="">
      <span class="d-none d-lg-block">StudFYP</span>
    </a>
  </div><!-- End Logo -->

</header><!-- End Header -->

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Rating Chart</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">FYP II Ratings</h5>

            <?php 
              //SQL query
              $strSQL = "SELECT COALESCE(SUM(Rate),0) AS Rate, tabledisplay.FYPID,tabledisplay.Name from rating right join tabledisplay on rating.FYPID = tabledisplay.FYPID GROUP BY FYPID";

              //Execute the query (the recordset $rs contains the result)
              $rs = mysqli_query($link, $strSQL);

              $i=0;

              //Loop the recordset $rs 
              //Each row will be made into an array ($row) using mysql_fetch_array 
              while ($row=mysqli_fetch_array($rs)){
                $i++
            ?>

            <input type="hidden" id="name<?php echo $i;?>" value="<?php echo $row['Name'];?>">
            <input type="hidden" id="rate<?php echo $i;?>" value="<?php echo $row['Rate'];?>">

            <?php
              }//While loop
            ?>

            <!-- Bar Chart -->
            <canvas id="barChart" style="max-height: 400px;"></canvas>
            <!-- End Bar CHart -->
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

<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
  document.title = "StudFYP | Rating Chart";

  var x = document.getElementsByTagName("BODY")[0];
  x.classList.add("toggle-sidebar");

  var name1 = document.getElementById("name1").value;
  var name2 = document.getElementById("name2").value;
  var name3 = document.getElementById("name3").value;
  var name4 = document.getElementById("name4").value;
  var name5 = document.getElementById("name5").value;
  var name6 = document.getElementById("name6").value;
  var name7 = document.getElementById("name7").value;
  var name8 = document.getElementById("name8").value;
  var name9 = document.getElementById("name9").value;
  var name10 = document.getElementById("name10").value;

  var rate1 = document.getElementById("rate1").value;
  var rate2 = document.getElementById("rate2").value;
  var rate3 = document.getElementById("rate3").value;
  var rate4 = document.getElementById("rate4").value;
  var rate5 = document.getElementById("rate5").value;
  var rate6 = document.getElementById("rate6").value;
  var rate7 = document.getElementById("rate7").value;
  var rate8 = document.getElementById("rate8").value;
  var rate9 = document.getElementById("rate9").value;
  var rate10 = document.getElementById("rate10").value;

  document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector('#barChart'), {
      type: 'bar',
      data: {
        labels: [name1, name2, name3, name4, name5, name6, name7, name8, name9, name10],
        datasets: [{
          label: "Rating",
          data: [rate1, rate2, rate3, rate4, rate5, rate6, rate7, rate8, rate9, rate10],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)',
            'rgba(255, 99, 71, 0.6)',
            'rgba(255, 211, 234, 0.8)',
            'rgba(229, 233, 176, 0.8)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)',
            'rgb(255, 99, 71)',
            'rgb(255, 211, 234)',
            'rgb(229, 233, 176)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>

</body>

</html>