<?php
  include('../includes/database.php');
  //Fetch a student from db by their FYPStudentID
  if(isset($_GET["student"]))
  {
    $FYPStudentID = $_GET["student"];
    $data = array();

    $query = "SELECT fyps.FYPStudentID, u.Name, s.MatricID, fyps.Semester FROM user as u JOIN student as s ON u.UserID = s.UserID JOIN fypstudent as fyps ON s.StudentID = fyps.StudentID WHERE fyps.FYPStudentID='$FYPStudentID'";
      $result = mysqli_query($link, $query);
      if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
          $data = array_merge($data, $row);
        }
        echo json_encode($data);
      }
    exit;
  }

  include('../includes/header.php');
  include('../includes/navbarcoordinator.php');

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Progress List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Progress List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">View Student Progress</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Matric ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Status</th>
                    <th scope="col">Supervisor</th>
                    <th scope="col">Evaluator Marks</th>
                  </tr>
                </thead>
                <tbody>
                  <script>
                    var active = 0, inactive = 0;
                  </script>
                  <?php
                  $query = "SELECT fyps.FYPStudentID, u.Name, s.MatricID, fyps.Semester, fyps.ActiveStatus, (SELECT u.Name FROM user as u JOIN lecturer as lec ON u.UserID = lec.UserID INNER JOIN finalyearproject as fyp ON fyps.FYPStudentID = fyp.FYPStudentID WHERE lec.LecturerID = fyp.FacultySupervisor) as 'SupervisorName', (SELECT SUM(sub.FacultyEvaluatorMark) + SUM(sub.IndustrialEvaluatorMark) FROM submission as sub INNER JOIN finalyearproject as fyp ON fyps.FYPStudentID = fyp.FYPStudentID WHERE sub.FYPStudentID = fyp.FYPStudentID) as 'TotalMark' FROM user as u JOIN student as s ON u.UserID = s.UserID LEFT JOIN lecturer as lec ON u.UserID = lec.UserID LEFT JOIN industrialstaff as ids ON u.UserID = ids.UserID JOIN fypstudent as fyps ON s.StudentID = fyps.StudentID INNER JOIN finalyearproject as fyp ON fyps.FYPStudentID = fyp.FYPStudentID";

                  $result = mysqli_query($link, $query);
                  if(mysqli_num_rows($result) > 0)
                  {
                    while($row = mysqli_fetch_array($result))
                    {
                      $FYPStudentID = $row['FYPStudentID'];
                      $MatricID = $row['MatricID'];
                      $Name = $row['Name'];
                      $Semester = $row['Semester'];
                      $ActiveStatus = $row['ActiveStatus'];
                      $SupervisorName = $row['SupervisorName'];
                      $TotalMark = $row['TotalMark'];
                      // $IndEvalMark = $row['IndEvalMark'];
                      $Badge = ''; //HTML for active or inactive badge

                      if($ActiveStatus)
                        echo '<script>active++;</script>';
                      else
                        echo '<script>inactive++;</script>';

                      if($ActiveStatus)
                        $Badge = '<td align="center"><span class="badge bg-success">Active</span></td>';
                      else
                        $Badge = '<td align="center"><span class="badge bg-danger">Inactive</span></td>';

                      echo <<<EOD
                      <tr>
                      <td scope="row" id="RowID" hidden>{$FYPStudentID}</td>
                      <td>{$MatricID}</td>
                      <td>{$Name}</td>
                      <td align="center">{$Semester}</td>
                      {$Badge}
                      <td>
                        {$SupervisorName}
                      </td>
                      <td align="center">
                        {$TotalMark} Marks
                      </td>                                           
                    </tr>
                    EOD;
                    }
                  }
                  ?>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
        <!-- Right side columns -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Student Status</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#pieChart'), {
                    type: 'pie',
                    data: {
                      labels: [
                        'Active',
                        'Inactive'
                      ],
                      datasets: [{
                        label: 'Student Status',
                        data: [active, inactive],
                        backgroundColor: [
                          'rgb(75, 192, 192)',
                          'rgb(255, 64, 105)'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Pie CHart -->

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
  document.title = "StudFYP | Progress List";
  var element = document.getElementById("progressList");
  element.classList.remove("collapsed");

  $(function() {
      console.log( "ready!" );//remove .ready jquery block if not used
  });


</script>