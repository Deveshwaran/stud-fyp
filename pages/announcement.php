<?php
  include('../includes/database.php');

  //Insert an announcement into db
  if(isset($_POST['insert']))
  {
    session_start();
    $coordinatorID = $_SESSION['coordinatorID'];
    $title = $_POST["title"];
    $dateTime = date("Y-m-d H:i:s",strtotime($_POST["dateTime"]));
    $status = $_POST["announcementStatus"];

    $filename = $_FILES['file']['name'];
    if($filename!=''){
      $target_dir = "image/";
      $target_file = $target_dir.basename($_FILES["file"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $extensions_arr = array("jpg","jpeg","png","gif");

      if( in_array($imageFileType,$extensions_arr) ){
        if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
          $query = "INSERT INTO fypannouncement (CoordinatorID, Title, DateTime, Content, Status) VALUES ('$coordinatorID', '$title', '$dateTime', '".$filename."', '$status')";
          $result = mysqli_query($link, $query);
          print_r($query); 
        } 
      }
    }
    $_POST = array();
     
    header("Location: announcement.php");
    exit;
  }

  if(isset($_GET["fypannouncement"]))
  {
    $AnnouncementID = $_GET["fypannouncement"];
    $data = array();

    $query = "SELECT AnnouncementID, CoordinatorID, Title, DateTime, Content, Status FROM fypannouncement as ann WHERE ann.AnnouncementID= '$AnnouncementID'";
      $result = mysqli_query($link, $query);
      if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
          $row['DateTime'] = date("Y-m-d\TH:i:s", strtotime($row['DateTime']));
          $data = array_merge($data, $row);
        }
        echo json_encode($data);
      }
    exit;
  }

  //Delete Announcement
  if(isset($_GET["removeAnnouncement"]))
  {
    $AnnouncementID = $_GET["removeAnnouncement"];
    $data = array();

    $query = "DELETE FROM fypannouncement WHERE AnnouncementID = '$AnnouncementID'";
      $result = mysqli_query($link, $query);
      echo json_encode($result);
    exit;
  }

  //Update Announcement
  if(isset($_POST['update']))
  {
    session_start();
    $AnnouncementID = $_POST["announcementID"];
    $CoordinatorID = $_SESSION["coordinatorID"];
    $Title = $_POST["announcementTitle"];
    $DateTime = date("Y-m-d H:i:s",strtotime($_POST["DT"]));
    // $Content = $_POST["announcementContent"];
    $Status = $_POST["announcementStatus"];

    $filename = $_FILES['file']['name'];
    print_r($filename);
    if($filename!=''){
      $target_dir = "image/";
      $target_file = $target_dir.basename($_FILES["file"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $extensions_arr = array("jpg","jpeg","png","gif");

      if( in_array($imageFileType,$extensions_arr) ){
        if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
          $query = "UPDATE fypannouncement SET CoordinatorID = '$CoordinatorID', Title = '$Title', DateTime = '$DateTime', Content = '".$filename."', Status = '$Status' WHERE AnnouncementID = '$AnnouncementID'";
          $result = mysqli_query($link, $query); 
        } 
      }
    }

    $_POST = array();
    header("Location: announcement.php");
    exit;
  }

  include('../includes/header.php');
  include('../includes/navbarcoordinator.php');
?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Announcement</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Announcement</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Announcements</h5>
          <form method="post" id="form1" action="announcement.php" enctype="multipart/form-data">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Date & Time</label>
              <div class="col-sm-10">
                <input type="datetime-local" name="dateTime" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Content</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="file" required>
              </div>
            </div>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Status</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="announcementStatus" value="1">
                  <label class="form-check-label" for="announcementStatus">
                    Active
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="announcementStatus" value="0">
                  <label class="form-check-label" for="announcementStatus">
                    Inactive
                  </label>
                </div>               
              </div>
            </fieldset>
            <div>
              <button type="submit" name="insert" class="btn btn-success" form="form1">Add</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Announcement List</h5>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Date & Time</th>
                <th scope="col">Content</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query2 = "SELECT AnnouncementID, CoordinatorID, Title, DateTime, Content, Status FROM fypannouncement ORDER BY AnnouncementID DESC";
                $result2 = mysqli_query($link, $query2);
                if(mysqli_num_rows($result2) > 0)
                {                
                  while($row = mysqli_fetch_array($result2))
                  {
                    $AnnouncementID = $row['AnnouncementID'];
                    $CoordinatorID = $row['CoordinatorID'];
                    $Title = $row['Title'];
                    $DateTime = date("Y-m-d H:i", strtotime($row['DateTime']));
                    $Content = '<img src="image/'.$row['Content'].'" width="200px" />';
                    $Status = $row['Status'];
                    if($Status)
                        $Badge = '<td><span class="badge bg-success">Active</span></td>';
                      else
                        $Badge = '<td><span class="badge bg-danger">Inactive</span></td>';

                    echo <<<EOD
                    <tr>
                      <td scope="row" id="RowID" hidden>{$CoordinatorID}</td>
                      <td>{$Title}</td>
                      <td>{$DateTime}</td>
                      <td>{$Content}</td>
                      {$Badge}
                      <td><button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#updateAnnouncementModal" onclick="updateAnnouncement({$AnnouncementID})">Update</button></td>
                      <td><button type="button" class="btn btn-danger rounded-pill" onclick="removeAnnouncement({$AnnouncementID})"><i class = "ri-delete-bin-line"></i></button></td>                      
                    </tr>
                    EOD;
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- updateAnnouncementModal -->
      <div class="modal fade" id="updateAnnouncementModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Announcement</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Vertical Form -->
              <form class="row g-3" method="post" id="form2" action="announcement.php" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="announcementID" name="announcementID">
                <input type="hidden" class="form-control" id="coordinatorID" name="coordinatorID">
                <div class="col-12">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="announcementTitle" name="announcementTitle">
                </div>
                <div class="col-12">
                  <label for="dateTime" class="form-label">Date & Time</label>
                  <input type="datetime-local" class="form-control" id="DT" name="DT">
                </div>
                <div class="col-12">
                  <label for="content" class="form-label">Content</label>
                  <input type="file" class="form-control" id="file" name="file">
                </div>
                <fieldset class="row mb-3 mt-3">
                  <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="announcementStatusActive" name="announcementStatus" value="1">
                      <label class="form-check-label" for="announcementStatus">
                        Active
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="announcementStatusInactive" name="announcementStatus" value="0">
                      <label class="form-check-label" for="announcementStatus">
                        Inactive
                      </label>
                    </div>                       
                  </div>
                </fieldset>
              </form><!-- Vertical Form -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="update" class="btn btn-primary" form="form2">Save changes</button>
            </div>
          </div>
        </div>
      </div><!-- End updateAnnouncementModal-->
    </section>

  </main><!-- End #main -->

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | Announcements";
  var element = document.getElementById("announcement");
  element.classList.remove("collapsed");

  function updateAnnouncement(AnnouncementID){
    //load form with ajax 
    $.ajax({    //create an ajax request to display.php
      type: "GET",
      url: "", 
      data: {fypannouncement: AnnouncementID},            
      dataType: "json",   //expect html to be returned                
      success: function(data){                    
        $("#announcementID").val(data.AnnouncementID); 
        $("#coordinatorID").val(data.CoordinatorID); 
        $("#announcementTitle").val(data.Title); 
        $("#DT").val(data.DateTime); 
        $("#announcementContent").val(data.Content);
        if(data.Status == 1)
          $("#announcementStatusActive").prop("checked", true);
        else
          $("#announcementStatusInactive").prop("checked", true);

      },
      error: function(error){                    
        alert("Something went wrong");
        console.log(error);
      },
    });
  }

  function removeAnnouncement(AnnouncementID){
    //load form with ajax 
    $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "", 
        data: {removeAnnouncement: AnnouncementID},            
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
    $("#announcementID").val(''); 
    $("#coordinatorID").val(''); 
    $("#announcementTitle").val(''); 
    $("#DT").val(''); 
    $("#announcementcontent").val('');
    $("#announcementstatus").val('');
  });

  $(function() {
      console.log( "ready!" );//remove .ready jquery block if not used
  });

  $("#file").change(function () {

  var validExtensions = ['jpeg', 'jpg', 'png', 'gif']
  var file = $(this).val().split('.').pop();
  if (validExtensions.indexOf(file) == -1) {
    alert("Only formats are allowed : "+validExtensions.join(', '));
  }

  });

</script>

</body>

</html>