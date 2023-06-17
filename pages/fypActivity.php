<?php
  include('../includes/database.php');

  //Insert an activity into db
  if(isset($_POST['insert']))
  {
    session_start();
    $coordinatorID = $_SESSION["coordinatorID"];
    $title = $_POST["title"];
    $startDateTime = date("Y-m-d H:i:s",strtotime($_POST["startDateTime"]));
    $endDateTime = date("Y-m-d H:i:s",strtotime($_POST["endDateTime"]));

    $query = "INSERT INTO fypactivity (CoordinatorID, Title, StartDateTime, EndDateTime) VALUES ('$coordinatorID', '$title', '$startDateTime', '$endDateTime')";
    $result = mysqli_query($link, $query);
    $_POST = array();

    // print_r("POST DATA:" . json_encode($query));
    header("Location: fypActivity.php");
    exit;
  }

  if(isset($_GET["fypactivity"]))
  {
    $ActivityID = $_GET["fypactivity"];
    $data = array();

    $query = "SELECT ActivityID, CoordinatorID, Title, StartDateTime, EndDateTime FROM fypactivity as fypa WHERE fypa.ActivityID= '$ActivityID'";
      $result = mysqli_query($link, $query);
      if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
          $row['StartDateTime'] = date("Y-m-d\TH:i:s", strtotime($row['StartDateTime']));
          $row['EndDateTime'] = date("Y-m-d\TH:i:s", strtotime($row['EndDateTime']));
          $data = array_merge($data, $row);
        }
        echo json_encode($data);
      }
    exit;
  }

  if(isset($_GET["removeActivity"]))
  {
    $ActivityID = $_GET["removeActivity"];
    $data = array();

    $query = "DELETE FROM fypactivity WHERE ActivityID = '$ActivityID'";
      $result = mysqli_query($link, $query);
      echo json_encode($result);
    exit;
  }

  //Update Activity
  if(isset($_POST['update']))
  {
    session_start();
    $ActivityID = $_POST["activityID"];
    $CoordinatorID = $_SESSION["coordinatorID"];
    $Title = $_POST["activityTitle"];
    $StartDateTime = date("Y-m-d H:i:s",strtotime($_POST["startDT"]));
    $EndDateTime = date("Y-m-d H:i:s",strtotime($_POST["endDT"]));

    $query = "UPDATE fypactivity SET CoordinatorID = '$CoordinatorID', Title = '$Title', StartDateTime = '$StartDateTime', EndDateTime = '$EndDateTime' WHERE ActivityID = '$ActivityID'";
    $result = mysqli_query($link, $query);
    $_POST = array();
    header("Location: fypActivity.php");
    exit;
  }

  include('../includes/header.php');
  include('../includes/navbarcoordinator.php');
?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>FYP Activity</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">FYPActivity</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">FYP Activity</h5>
          <form method="post" id="form1" action="fypActivity.php">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Start Date & Time</label>
              <div class="col-sm-10">
                <input type="datetime-local" name="startDateTime" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">End Date & Time</label>
              <div class="col-sm-10">
                <input type="datetime-local" name="endDateTime" class="form-control" required>
              </div>
            </div>
            <div>
              <button type="submit" name="insert" class="btn btn-success" form="form1">Add</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">FYP Activity List</h5>
          <a href="calendar.php"><button name="calendar" class="btn btn-primary">Calendar View</button></a>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Duration</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query2 = "SELECT ActivityID, CoordinatorID, Title, StartDateTime, EndDateTime FROM fypactivity ORDER BY ActivityID DESC";
                $result2 = mysqli_query($link, $query2);
                if(mysqli_num_rows($result2) > 0)
                {                
                  while($row = mysqli_fetch_array($result2))
                  {
                    $ActivityID = $row['ActivityID'];
                    $CoordinatorID = $row['CoordinatorID'];
                    $Title = $row['Title'];
                    $StartDateTime = date("Y-m-d H:i", strtotime($row['StartDateTime']));
                    $EndDateTime = date("Y-m-d H:i", strtotime($row['EndDateTime']));
                    $durationStart = new DateTime($StartDateTime);
                    $durationEnd = new DateTime($EndDateTime);
                    $duration = date_diff($durationEnd, $durationStart)->days;
                    echo <<<EOD
                    <tr>
                      <td scope="row" id="RowID" hidden>{$CoordinatorID}</td>
                      <td>{$Title}</td>
                      <td>{$StartDateTime}</td>
                      <td>{$EndDateTime}</td>
                      <td>{$duration} days</td>
                      <td><button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#updateActivityModal" onclick="updateActivity({$ActivityID})">Update</button></td>
                      <td><button type="button" class="btn btn-danger rounded-pill" onclick="removeActivity({$ActivityID})"><i class = "ri-delete-bin-line"></i></button></td>                      
                    </tr>
                    EOD;
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- updateActivityModal -->
      <div class="modal fade" id="updateActivityModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Activity</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Vertical Form -->
              <form class="row g-3" method="post" id="form2" action="fypActivity.php">
                <input type="hidden" class="form-control" id="activityID" name="activityID">
                <input type="hidden" class="form-control" id="coordinatorID" name="coordinatorID">
                <div class="col-12">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="activityTitle" name="activityTitle">
                </div>
                <div class="col-12">
                  <label for="startDT" class="form-label">Start Date & Time</label>
                  <input type="datetime-local" class="form-control" id="startDT" name="startDT">
                </div>
                <div class="col-12">
                  <label for="endDT" class="form-label">End Date & Time</label>
                  <input type="datetime-local" class="form-control" id="endDT" name="endDT">
                </div>
              </form><!-- Vertical Form -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="update" class="btn btn-primary" form="form2">Save changes</button>
            </div>
          </div>
        </div>
      </div><!-- End updateActivityModal-->
    </section>

  </main><!-- End #main -->

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | FYP Activity";
  var element = document.getElementById("fypActivity");
  element.classList.remove("collapsed");

  function updateActivity(ActivityID){
    //load form with ajax 
    $.ajax({    //create an ajax request to display.php
      type: "GET",
      url: "", 
      data: {fypactivity: ActivityID},            
      dataType: "json",   //expect html to be returned                
      success: function(data){                    
        $("#activityID").val(data.ActivityID); 
        $("#coordinatorID").val(data.CoordinatorID); 
        $("#activityTitle").val(data.Title); 
        $("#startDT").val(data.StartDateTime); 
        $("#endDT").val(data.EndDateTime); 
      },
      error: function(error){                    
        alert("Something went wrong");
        console.log(error);
      },
    });
  }

  function removeActivity(ActivityID){
    //load form with ajax 
    $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "", 
        data: {removeActivity: ActivityID},            
        dataType: "json",   //expect html to be returned                
        success: function(data){ 
          window.location.reload();                    
        },
        error: function(error){                    
            alert("Something went wrong");
            console.log(error);
        },
    });
  }

  $('#updateActivityModal').on('hide.bs.modal', function (e) {
    $("#activityID").val(''); 
    $("#coordinatorID").val(''); 
    $("#activityTitle").val(''); 
    $("#startDT").val(''); 
    $("#endDT").val(''); 
    // $('select').prop('selectedIndex', 0);
  });

  $(function() {
      console.log( "ready!" );//remove .ready jquery block if not used
  });

</script>

</body>

</html>