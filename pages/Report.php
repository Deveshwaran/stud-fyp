<?php
 include('../includes/header.php');
require 'db.php';
 include('../includes/navbarevaluator.php');
  include('../includes/database.php');

  ?>
  <script>
    decument.title = "studFYP | Home";
    var element = decument.getElementById("home");
    element.classlist.remove("collapsed");
  </script>
<?php



  $sql = "SELECT COUNT('FYPID') FROM finalyearproject WHERE Type=1";
    $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $fyp1 = $row[0];


  $sql = "SELECT COUNT('FYPID') FROM finalyearproject WHERE Type=2";
    $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $fyp2 = $row[0];


$total = $fyp2 + $fyp1;

$dataPoints = array(
	array("y" => $fyp1, "label" => "FYP1" ),
	array("y" => $fyp2, "label" => "FYP2" ),

)

 ?>
  <main id="main" class="main">
<!-- End Navbar -->

<!-- Contents Starts-->

<div class="container-fluid py-4">
<div><strong>total student  <?php echo $total?></div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</div>

<!-- Contents End-->

<script>
    function naviHead() {
        //Header name
        document.getElementById("head-nav").style.display = "none";
        document.getElementById("page-head").innerHTML = "Manage User";
        //Side Navigation Bar
        document.getElementById("mod1").className = "nav-link  ";
        document.getElementById("mod3").className += "active";
        document.getElementById("name-3").innerHTML = "Manage User";
    }
    window.onload = naviHead;
</script>
<script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "FYP student under evaluater"
},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
