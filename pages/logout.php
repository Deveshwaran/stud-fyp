<?php
  session_start();
  unset($_SESSION["name"]);
  unset($_SESSION["userID"]);
  unset($_SESSION["fypStudentID"]);
  unset($_SESSION["lecturerID"]);
  unset($_SESSION["coordinatorID"]);
  unset($_SESSION["industrialStaffID"]);
  unset($_SESSION["adminID"]);
  session_destroy();
  header("Location:../index.php");
?>