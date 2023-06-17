<?php
 include('../includes/header.php');
 include('../includes/navbarevaluator.php');
 include('../includes/database.php');


  ?>
<?php
require 'db.php';
  $sql = 'SELECT `Name`,`Category`,`Address`,`ContactNum`,`Email` FROM `industry` WHERE 1';

  $statement = $connection->prepare($sql);
  $statement->execute();
  $studfyp = $statement->fetchAll(PDO::FETCH_OBJ);?>



<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">industry Staff Profile </a></li>

      </ol>
    </nav>
  </div>
  <body>

  <script>
    document.title = "studFYP | Home";
    var element = document.getElementById("home");
    element.classlist.remove("collapsed");
  </script>

<?php foreach($studfyp as $UserID) {?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"></h5>
  <div class="tab-content pt-2">
  <div class="tab-pane fade show active profile-overview" id="profile-overview">

    <h5 class="card-title">Profile Details</h5>

    <div class="row">
      <div class="col-lg-3 col-md-4 label ">Full Name</div>
      <div class="col-lg-9 col-md-8"><i><?= $UserID->Name; ?></i></div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-md-4 label">Category</div>
      <div class="col-lg-9 col-md-8"><?= $UserID->Category; ?></div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-md-4 label">Address</div>
      <div class="col-lg-9 col-md-8"><?= $UserID->Address; ?></div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-md-4 label">Contact Number</div>
      <div class="col-lg-9 col-md-8"><?= $UserID->ContactNum; ?></div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-md-4 label">Email</div>
      <div class="col-lg-9 col-md-8"><?= $UserID->Email; ?></div>
    </div>

  <?php } ?>

  </main>
    <?php
  include('../includes/scripts.php');
  include('../includes/footer.php');

     ?>
