<?php
  include('../includes/header.php');
  include('../includes/navbarevaluator.php');
 include('../includes/database.php');
  ?>

  <?php
  require 'db.php';
  $id = $_GET['id'];

  if (isset($_POST['addmark'])) {


   $Mark = $_POST['IndustrialEvaluatorMark'];
   $sql =" UPDATE `submission` SET `IndustrialEvaluatorMark`='$Mark' WHERE `SubmissionID`=$id";

   $statement = $connection->prepare($sql);
   $statement->execute();
   $studfyp = $statement->fetchAll(PDO::FETCH_OBJ);} ?>

   <script>
     document.title = "studFYP | Home";
     var element = document.getElementById("home");
     element.classlist.remove("collapsed");
   </script>

   <main id="main" class="main">

     <div class="pagetitle">
       <h1>Data Tables</h1>
       <nav>
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.html">student list</a></li>
           <li class="breadcrumb-item">Student FYP </li>
           <li class="breadcrumb-item active">Evaluate Student</li>
         </ol>
       </nav>
     </div>
     <body>



  <form method="post">


      <div class="card">
        <div class="card-body">
          <h5 class="card-title">FYP2</h5>
                 <table class="table">
                   <thead>
                     <tr>
                     <th></th>
                     <th>Mark</th>
                    </tr>
                   </thead>
                   <tr>
                     <td>
                         <button type="submit"  name="addmark" class="btn btn-info rounded-pill"  >Add Mark</button></td>
                   <td> <input type="text" name="IndustrialEvaluatorMark" value="" class="form-control"></td>

                 </tr>




  </table>

    </div>
  </div>




</form>

</body>
</main>
    <?php
  include('../includes/scripts.php');
  include('../includes/footer.php');

     ?>
