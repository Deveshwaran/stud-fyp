<!-- Session -->
<?php
  session_start();
  if(!isset($_SESSION['name'])){
    //If session name is not set, redirect to login page
    session_destroy();
    header('Location: ../index.php');
  } 
?>