
  <?php
  require 'db.php';
  $sql = 'SELECT user.UserID,user.Name, student.MatricID,finalyearproject.ProjectName,finalyearproject.Status, finalyearproject.Type,industry.Name AS Iname,fypstudent.FYPStudentID
FROM user
INNER JOIN student ON user.UserID = student.UserID
INNER JOIN fypstudent ON student.StudentID = fypstudent.StudentID
INNER JOIN finalyearproject ON fypstudent.FYPStudentID = finalyearproject.FYPStudentID
INNER JOIN industrialstaff ON  finalyearproject.IndustrialEvaluator = industrialstaff.IndustrialStaffID
INNER JOIN industry ON industrialstaff.IndustryID = industry.IndustryID
WHERE finalyearproject.IndustrialEvaluator=1 AND finalyearproject.Type=1';

  $statement = $connection->prepare($sql);
  $statement->execute();
  $studfyp = $statement->fetchAll(PDO::FETCH_OBJ);

   ?>


   <?php
     include('../includes/header.php');
     include('../includes/navbarevaluator.php');
     include('../includes/database.php');

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
        <li class="breadcrumb-item">Student FYP 1</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div>


  <div class="card">
    <div class="card-body">

     <table class="table">
     <h5>FYP 1 Student</h5>
   <thead>


     <tr>
       <th>Student details</th>
       <th>Supervisor</th>
       <th>Status Evaluation</th>
       <th>Evaluation</th>
     </tr>
     </thead>
     <?php foreach($studfyp as $UserID) {
       $id = $UserID->UserID;
      $fypst = $UserID->FYPStudentID;?>
     <tr>



       <td>Student Name:<br>
              <?= $UserID->Name; ?><br><br>
              Student Matric Number:<br>
              <?= $UserID->MatricID; ?><br><br>
              Project Name:<br>
              <?= $UserID->ProjectName; ?><br><br>
            </td>

        <td>



            <?= $UserID->Iname; ?>
            </td>
       <td>


          <?php  $Status=$UserID->Status;
          if($Status==1){
                          echo "evaluated";
                      }else{
                          echo "not evaluated";}?>
            </td>

       <td><button type="button" class="btn btn-info rounded-pill" onclick="location.href='evaluatest.php?id=<?php echo $id  ?>&sID=<?php echo $fypst?>'">Evaluation</button></td>
     </tr>
     <?php }?>

     </table>
     <button type="button" class="btn btn-info rounded-pill" onclick="location.href='Report.php'">Report</button>

</main

     <?php
     include('../includes/scripts.php');
       include('../includes/footer.php');
     ?>
