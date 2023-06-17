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

  //Insert a student into finalyearproject table
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $FYPStudentID = $_POST["fypStudentID"];
    $supervisor = $_POST["supervisor"];
    $facultyEvaluator = $_POST["facultyEvaluator"];
    $industryEvaluator = $_POST["industryEvaluator"];
    $data = array();

    $query = "INSERT INTO finalyearproject (FYPStudentID, FacultySupervisor, FacultyEvaluator, IndustrialEvaluator) VALUES ($FYPStudentID, $supervisor, $facultyEvaluator, $industryEvaluator)";
    $result = mysqli_query($link, $query);
    $_POST = array();
    header("Location: updateStudentInfo.php");
    exit;
  }

  include('../includes/header.php');
  include('../includes/navbarcoordinator.php');

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Coordinator Menu</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Coordinator Menu</li>
          <li class="breadcrumb-item active">Assign Role</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">

      <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Assign Role</button>
        </li>
        <li class="nav-item" role="presentation">
          <a href="updateStudentInfo.php"><button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Edit Role</button></a>
        </li>
      </ul>

      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Manage Student</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Matric ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Status</th>
                    <th scope="col">Supervisor</th>
                    <th scope="col">Faculty Evaluator</th>
                    <th scope="col">Industry Evaluator</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $dropdown_supervisor = '';
                  $dropdown_evaluator = '';
                  $query2 = "SELECT lec.LecturerID, u.Name FROM user as u JOIN lecturer as lec ON u.UserID = lec.UserID";
                  $result2 = mysqli_query($link, $query2);
                  if(mysqli_num_rows($result2) > 0)
                  {
                    $dropdown_supervisor = '<select class="form-select" id="dropdown_supervisor" name="supervisor" required><option value="" selected>-</option>';
                    $dropdown_evaluator = '<select class="form-select" id="dropdown_evaluator" name="facultyEvaluator" required><option value="" selected>-</option>';
                    while($row = mysqli_fetch_array($result2))
                    {
                      $dropdown_supervisor .= '<option value="'.$row['LecturerID'].'">'.$row['Name'].'</option>';
                      $dropdown_evaluator .= '<option value="'.$row['LecturerID'].'">'.$row['Name'].'</option>';
                    }
                     $dropdown_supervisor .= '</select>';
                     $dropdown_evaluator .= '</select>';
                  }

                  $dropdown_industry = '';
                  $query3 = "SELECT inds.IndustrialStaffID, u.Name, ind.IndustryID FROM user as u JOIN industrialstaff as inds ON u.UserID = inds.UserID JOIN industry as ind ON inds.IndustryID = ind.IndustryID";
                  $result3 = mysqli_query($link, $query3);
                  if(mysqli_num_rows($result3) > 0)
                  {
                    $dropdown_industry = '<select class="form-select" id="dropdown_industry" name="industryEvaluator" required><option value="" selected>-</option>';
                    while($row = mysqli_fetch_array($result3))
                    {
                      $dropdown_industry .= '<option value="'.$row['IndustrialStaffID'].'">'.$row['Name'].'</option>';
                    }
                     $dropdown_industry .= '</select>';
                  }


                  $query = "SELECT fyps.FYPStudentID, u.Name, s.MatricID, fyps.Semester, fyps.ActiveStatus FROM user as u JOIN student as s ON u.UserID = s.UserID JOIN fypstudent as fyps ON s.StudentID = fyps.StudentID LEFT JOIN finalyearproject as fyp ON fyps.StudentID = fyp.FYPStudentID WHERE fyps.FYPStudentID NOT IN ( SELECT fyp.FYPStudentID FROM finalyearproject AS fyp)";


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
                      $Badge = ''; //HTML for active or inactive badge

                      if($ActiveStatus)
                        $Badge = '<td><span class="badge bg-success">Active</span></td>';
                      else
                        $Badge = '<td><span class="badge bg-danger">Inactive</span></td>';

                      echo <<<EOD
                      <tr>
                      <td scope="row" id="RowID" hidden>{$FYPStudentID}</td>
                      <td>{$MatricID}</td>
                      <td>{$Name}</td>
                      <td>{$Semester}</td>
                      {$Badge}
                      <td>
                        -
                      </td>
                      <td>
                        -
                      </td>
                      <td>
                        -
                      </td>
                      <td><button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#assignEvaluatorsModal" onclick="assignEvaluators({$FYPStudentID})">Assign</button></td>                      
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
      </div>
      <!-- assignEvaluatorsModal -->
  
  <div class="modal fade" id="assignEvaluatorsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Assign Evaluators</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Vertical Form -->
              <form class="row g-3" method="post" id="form1" action="coordinatorMenu.php">
                <input type="hidden" class="form-control" id="fypStudentID" name="fypStudentID">
                <div class="col-12">
                  <label for="matricID" class="form-label">Matric ID</label>
                  <input type="text" class="form-control" id="matricID" name="matricID" disabled>
                </div>
                <div class="col-12">
                  <label for="studentName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="studentName" name="studentName" disabled>
                </div>
                <div class="col-12">
                  <label for="semester" class="form-label">Semester</label>
                  <input type="text" class="form-control" id="semester" name="semester" disabled>
                </div>
                <div class="col-12">
                  <label for="supervisor" class="form-label">Supervisor</label>
                  <?php echo $dropdown_supervisor ?>
                </div>
                <div class="col-12">
                  <label for="facultyEvaluator" class="form-label">Faculty Evaluator</label>
                  <?php echo $dropdown_evaluator ?>
                </div>
                <div class="col-12">
                  <label for="industryEvaluator" class="form-label">Industry Evaluator</label>
                  <?php echo $dropdown_industry ?>
              </form><!-- Vertical Form -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="form1">Save changes</button>
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->
    </section>

  </main><!-- End #main -->

  

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | Coordinator Menu";
  var element = document.getElementById("coordinatormenu");
  element.classList.remove("collapsed");

  function assignEvaluators(FYPStudentID){
    //load form with ajax 
    $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "", 
        data: {student: FYPStudentID},            
        dataType: "json",   //expect html to be returned                
        success: function(data){                    
            $("#fypStudentID").val(data.FYPStudentID); 
            $("#matricID").val(data.MatricID); 
            $("#studentName").val(data.Name); 
            $("#semester").val(data.Semester); 
        },
        error: function(error){                    
            alert("Something went wrong");
            console.log(error);
        },
    });
  }

  $('#assignEvaluatorsModal').on('hidden.bs.modal', function (e) {
    $("#fypStudentID").val(''); 
    $("#matricID").val(''); 
    $("#studentName").val(''); 
    $("#semester").val(''); 
    $('select').prop('selectedIndex', 0);
  });
  

  $(function() {
      console.log( "ready!" );//remove .ready jquery block if not used
  });


</script>