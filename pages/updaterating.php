<?php

  include('../includes/database.php');

  $UserID = $_GET["UserID"];
  $rating = $_POST["rating"];

  $sql = "UPDATE rating SET rating='$rating' WHERE UserID='$UserID'";

  if (mysqli_query($link, $sql)) {

  } else {
    echo 'Error updating database: '.mysqli_connect_error()."\n";
  }

  //And finally we close the connection to the MySQL server
  mysqli_close($link);

  // header("Refresh:1; url=displayrating.php");
?>                                     


