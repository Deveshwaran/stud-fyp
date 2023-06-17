<?php
 include('../includes/header.php');
include('../includes/navbarevaluator.php');
 include('../includes/database.php');
  ?>



  <?php
  require 'db.php';


  $EvaluatorFeedback = $_POST['EvaluatorFeedback'];
  $id = $_GET['id'];

if (isset($_POST['add'])) {
       $sql = "UPDATE `logbook` SET `EvaluatorFeedback`='$EvaluatorFeedback' where LogbookID=$id ";
       $statement = $connection->prepare($sql);
       $statement->execute();
       $studfyp = $statement->fetchAll(PDO::FETCH_OBJ);
}
       $sql = "SELECT `EvaluatorFeedback` FROM `logbook` WHERE   LogbookID=$id ";
       $statement = $connection->prepare($sql);
       $statement->execute();
       $studfyp2 = $statement->fetchAll(PDO::FETCH_OBJ);


   ?>


   <script>
     decument.title = "studFYP | Home";
     var element = decument.getElementById("home");
     element.classlist.remove("collapsed");
   </script>



<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">student list</a></li>
        <li class="breadcrumb-item">Student FYP </li>
        <li class="breadcrumb-item active">feedback</li>
      </ol>
    </nav>
  </div>





                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">submittion</h5>
<?php foreach($studfyp2 as $UserID) {?>




        <form class=""   method="post">
          <div class="container">
            <div class="card mt-5">
              <form method="post">
                  <div class="form-group">
                    <label for="SupervisorFeedback"> feedback</label>
                    <input type="text" name="EvaluatorFeedback" id="EvaluatorFeedback" class="form-control" value="<?= $UserID->EvaluatorFeedback; ?>">
                  </div>
<?php } ?>
                  <div class="form-group">
                    <button type="submit" onclick="location.href='feedback.php?id=<?php echo $id?> '"  class="btn btn-info" name="add">Add</button>
                  </div>

                </form>
                </div>
                </div>
                </form>

              </div>
              </div>

      </body>
      <?php
      include('../includes/scripts.php');
      include('../includes/footer.php');

       ?>
