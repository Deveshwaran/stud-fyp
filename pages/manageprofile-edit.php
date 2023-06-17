<?php
  include('../includes/header.php');
  include('../includes/navbarlecturer.php');
  include('../includes/database.php');

$UserID=$_REQUEST['UserID'];
$strSQL = "SELECT user.Name, user.PhoneNum, user.Email, lecturer.OfficeLoc, lecturer.Expertise, finalyearproject.FYPStudentID 
FROM user 
INNER JOIN lecturer ON user.UserID = lecturer.UserID 
INNER JOIN finalyearproject ON lecturer.LecturerID = finalyearproject.FacultySupervisor"; 
$rs = mysqli_query($link, $strSQL);
$row = mysqli_fetch_assoc($rs);
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_umiera.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Edit Profile</h5>

                  <?php
                    $status = "";
                    if(isset($_POST['new']) && $_POST['new']==1)
                    {
                      $Name =$_REQUEST['Name'];
                      $Expertise =$_REQUEST['Expertise'];
                      $OfficeLoc =$_REQUEST['OfficeLoc'];
                      $PhoneNum =$_REQUEST['PhoneNum'];
                      $Email =$_REQUEST['Email'];
                      $update="update user set Name='".$Name."', Expertise='".$Expertise."', OfficeLoc='".$OfficeLoc."', PhoneNum='".$PhoneNum."', Email='".$Email."'
                       where id='".$id."'";
                      mysqli_query($link, $update);
                      $status = "Record Updated Successfully. </br></br>
                      <a href='manageprofile.php'>View Updated Record</a>";
                      echo '<p style="color:#FF0000;">'.$status.'</p>';
                      }else {
                  ?>

                  <form>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-xl-8">
                        <img src="../assets/img/profile.png" alt="Profile" width="100" height="100"/>
                      
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo $row['Name'];?>" />
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Expertise</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?php echo $row['Expertise'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $row['PhoneNum'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo $row['Email'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                      </div>
                    </div>

                  </form>
                  <?php } ?>

                  <div class="text-center">
                    <a href="manageprofile.php"><button type="submit" class="btn btn-primary">Update</button></a>
                    </div>
                </div>
              </div><!-- End Bordered Tabs -->
            </div>
          </div>
    </section>

  </main><!-- End #main -->

<?php
  include('../includes/footer.php');
  include('../includes/scripts.php'); 
?>

<script>
  document.title = "StudFYP | Dashboard";
</script>

</body>

</html>