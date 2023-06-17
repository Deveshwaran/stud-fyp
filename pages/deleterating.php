<?php
  include('../includes/database.php');
  include('../includes/session.php');

  $UserID=$_SESSION['userID'];

  //Then, insert query.
  $sql = "DELETE FROM rating WHERE UserID='$UserID'";

  if (mysqli_query($link, $sql)) {
    header("Refresh:1; url=rating.php");
  } 
  else {
    echo 'Error deleting data: '.mysqli_connect_error()."\n";
  }

  //And finally we close the connection to the MySQL server
  mysqli_close($link);
?>