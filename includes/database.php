<?php
  //Connect to the database server.
  $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

  //Select the database.
  mysqli_select_db($link, "studfyp") or die(mysqli_error($link));
?>