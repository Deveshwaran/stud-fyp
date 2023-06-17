<?php
 include('../includes/header.php');
include('../includes/navbarevaluator.php');
 include('../includes/database.php');
  ?>

  <?php
  require 'db.php';
  $id = $_GET['id'];
$fypst = $_GET['sID'];

  $sql = "SELECT user.UserID,user.Name,user.PhoneNum,user.Email,student.MatricID
FROM user
INNER JOIN student ON user.UserID = student.UserID
WHERE User.UserID=$id";


$statement = $connection->prepare($sql);
  $statement->execute();
  $studfyp = $statement->fetchAll(PDO::FETCH_OBJ);



  $sql2 = "SELECT  logbook.LogbookID,logbook.Content,logbook.FYPStudentID, DATE(logbook.DateTime) AS DateTime
FROM user
INNER JOIN student ON user.UserID = student.UserID
INNER JOIN fypstudent ON student.StudentID = fypstudent.StudentID
INNER JOIN logbook ON fypstudent.FYPStudentID = logbook.FYPStudentID
WHERE logbook.FYPStudentID= $fypst
ORDER BY `DateTime`  ASC";
  $statement2 = $connection->prepare($sql2);
  $statement2->execute();
  $studfyp2 = $statement2->fetchAll(PDO::FETCH_OBJ);



?>

<script>
  decument.title = "studFYP | Home";
  var element = decument.getElementById("home");
  element.classlist.remove("collapsed");
</script>






<body>




   <main id="main" class="main">
     <div class="pagetitle">
       <h1>Data Tables</h1>
       <nav>
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.html">student list</a></li>
           <li class="breadcrumb-item">Student FYP </li>
           <li class="breadcrumb-item active">View student work</li>
         </ol>
       </nav>
     </div>

     <div class="card">
       <div class="card-body">
         <h5 class="card-title">Student Logbook</h5>

      <?php foreach($studfyp as $UserID) { ?>

     Student Name:
            <?= $UserID->Name; ?><br>
            Student MatricID:
                  <?= $UserID->MatricID; ?><br>
    Student Phone number:
          <?= $UserID->PhoneNum; ?><br>

    Student Email:
                <?= $UserID->Email; ?><br>





              </div>
            </div>
            <?php }?>

            <?php foreach($studfyp2 as $UserID) {
            $id = $UserID->LogbookID;?>

                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">submittion</h5>


                      <?= $UserID->Content; ?><br>
                        <div class="container">
                          <div class="card mt-5">
                            <form method="post" method="post">
                              <div class="form-group">
                                <label for="SupervisorFeedback"> feedback</label>
                              </div>

                              <div class="form-group">
                                <button type="button" onclick="location.href='feedback.php?id=<?php echo $id?> '"  class="btn btn-info">Add feedback</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

            <?php }?>
</body>
<?php
include('../includes/scripts.php');
include('../includes/footer.php');

 ?>
