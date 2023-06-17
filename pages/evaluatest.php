<?php
  include('../includes/header.php');
  include('../includes/navbarevaluator.php');
 include('../includes/database.php');
  ?>

  <?php
  require 'db.php';
  $id = $_GET['id'];
  $fypst = $_GET['sID'];

$sql2 = "SELECT `SubmissionName`,`SubmissionID` FROM `submission` WHERE `FYPStudentID`=$fypst";

$statement2 = $connection->prepare($sql2);
$statement2->execute();
$studfyp2 = $statement2->fetchAll(PDO::FETCH_OBJ);

  ?>
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

 <?php foreach($studfyp2 as $UserID) {
   $id2 = $UserID->SubmissionID;?>
<form method="post">


    <div class="card">
      <div class="card-body">
        <h5 class="card-title">FYP2</h5>
               <table class="table">
                 <thead>
                   <tr>
                   <th>Indicator</th>
                   <th>Mark</th>
                  </tr>
                 </thead>
                 <tr>
                 <td>  <?= $UserID->SubmissionName; ?></td>
                 <td><button type="button"  onclick="location.href='mark.php?id=<?php echo $id2?>'" class="btn btn-info rounded-pill"  >Add Mark</button></td>
                 </tr>



</table>

  </div>
</div>



</form>
<?php } ?>
</body>

























</main>
    <?php
  include('../includes/scripts.php');
  include('../includes/footer.php');

     ?>
