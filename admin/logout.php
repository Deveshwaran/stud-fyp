<?php
  session_start();
  unset($_SESSION["name"]);
  unset($_SESSION["adminID"]);
  session_destroy();
  header("Location:../index.php");
?>