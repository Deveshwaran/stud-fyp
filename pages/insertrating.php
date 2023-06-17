<?php
  include('../includes/database.php');
  include('../includes/session.php');

  $rating = $_POST["rating"];
  $FYPID = $_GET["id"];
  $UserID = $_SESSION['userID'];

  $sql = "INSERT INTO rating (UserID,FYPID,Rate) VALUES ('$UserID','$FYPID','$rating')";
  if (mysqli_query($link, $sql)) {
    echo "New Rate addedddd successfully";
    echo '<script>window.location.href = "displayrating.php";</script>';
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
  }

  mysqli_close($link);                
?>