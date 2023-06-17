<?php
 include('../includes/header.php');
 include('../includes/navbarevaluator.php');
 include('../includes/database.php');


  ?>
  <script>
    document.title = "studFYP | Home";
    var element = document.getElementById("home");
    element.classlist.remove("collapsed");
  </script>
  <?php
  require 'db.php';


  $sql = 'SELECT fypstudent.FYPStudentID,user.UserID, student.StudentID , user.Name,finalyearproject.ProjectName,finalyearproject.Type
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

  $sql = 'SELECT fypstudent.FYPStudentID,user.UserID, student.StudentID , user.Name,finalyearproject.ProjectName,finalyearproject.Type
FROM user
INNER JOIN student ON user.UserID = student.UserID
INNER JOIN fypstudent ON student.StudentID = fypstudent.StudentID
INNER JOIN finalyearproject ON fypstudent.FYPStudentID = finalyearproject.FYPStudentID
INNER JOIN industrialstaff ON  finalyearproject.IndustrialEvaluator = industrialstaff.IndustrialStaffID
INNER JOIN industry ON industrialstaff.IndustryID = industry.IndustryID
WHERE finalyearproject.IndustrialEvaluator=1 AND finalyearproject.Type=2';

  $statement = $connection->prepare($sql);
  $statement->execute();
  $studfyp2 = $statement->fetchAll(PDO::FETCH_OBJ);



   ?>



     <main id="main" class="main">

       <div class="pagetitle">
         <h1>Data Tables</h1>
         <nav>
           <ol class="breadcrumb">
             <li class="breadcrumb-item"><student list</a></li>
             <li class="breadcrumb-item">Student FYP </li>

           </ol>
         </nav>
       </div>
   <body>

     <div class="card">
       <div class="card-body">
         <h5 class="card-title">FYP1</h5>

        <table class="table" >

    <thead>


          <tr>
            <th>Student details</th>
            <th>Project details</th>
            <th>Evaluation</th>
          </tr>
          </thead>
           <?php foreach($studfyp as $UserID) {
               $id = $UserID->UserID;
              $fypst = $UserID->FYPStudentID;?>

          <tr>
            <td>Student Name:<br>
                   <?= $UserID->Name; ?><br><br>

                   </td>
                  <td>
                 <?= $UserID->ProjectName; ?><br>

            <td><button type="button" class="btn btn-info rounded-pill"  onclick="location.href='evaluatest.php?id=<?php echo $id?>&sID=<?php echo $fypst?>'" >Evaluate</button><br><br>
            <button type="button" class="btn btn-info rounded-pill"  onclick="location.href='logbook2.php?id=<?php echo $id  ?>&sID=<?php echo $fypst?>'" >logbook</button></td>
     <?php }?>
        </table>



</div>
</div>





<div class="card">
  <div class="card-body">
    <h5 class="card-title">FYP2</h5>
    <table class="table" >

<thead>


      <tr>
        <th>Student details</th>
        <th>Project details</th>
        <th>Evaluation</th>
      </tr>
      </thead>
       <?php foreach($studfyp2 as $UserID) {
           $id = $UserID->UserID;
          $fypst = $UserID->FYPStudentID;?>

      <tr>
        <td>Student Name:<br>
               <?= $UserID->Name;?>

                 </td>
                <td>
             <?= $UserID->ProjectName; ?><br>
 </td>
        <td><button type="button" class="btn btn-info rounded-pill"  onclick="location.href='evaluatest.php?id=<?php echo $id?>&sID=<?php echo $fypst?>'" >Evaluate</button><br><br>
          <button type="button" class="btn btn-info rounded-pill"  onclick="location.href='logbook2.php?id=<?php echo $id  ?>&sID=<?php echo $fypst?>'" >logbook</button></td>
 <?php }?>
    </table>

         </div>
         </div>
         </form>
  </main>
  <?php
include('../includes/scripts.php');
  include('../includes/footer.php');

   ?>
