<?php
  include('../includes/database.php');

  $action = $_GET['action'];

  //View announcement
  if($action=='announcement'){
    $announcementID = $_GET['id'];
 
    //SQL query
    $strSQL = "SELECT Content FROM FYPAnnouncement WHERE AnnouncementID = '$announcementID'";
  
    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);
  
    while ($row=mysqli_fetch_array($rs)){
      header("Content-type: jpg");
      echo $row['Content'];
    }
  }//View proposal
  else if($action=='workfile'){
    $fypID = $_GET['id'];
 
    //SQL query
    $strSQL = "SELECT WorkFile FROM FinalYearProject WHERE FYPID = '$fypID'";
  
    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);
  
    while ($row=mysqli_fetch_array($rs)){
      header("Content-type: application/pdf");
      echo $row['WorkFile'];
    }
  }//Delete proposal
  else if($action=='deletefile'){
    $fypID = $_GET['id'];
 
    //SQL query
    $strSQL = "UPDATE FinalYearProject SET WorkFile = NULL, ProjectName = NULL WHERE FYPID = '$fypID'";
  
    //Execute the query 
    if(mysqli_query($link, $strSQL)){
      header("Location: home.php");
    }
  }//View submission
  else if($action=='submissionfile'){
    $submissionID = $_GET['id'];
 
    //SQL query
    $strSQL = "SELECT Content FROM Submission WHERE SubmissionID = '$submissionID'";
  
    //Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($link, $strSQL);
  
    while ($row=mysqli_fetch_array($rs)){
      header("Content-type: application/pdf");
      echo $row['Content'];
    }
  }//Delete submission
  else if($action=='deletesubmission'){
    $submissionID = $_GET['id'];
    $activityID = $_GET['activity'];
 
    //SQL query
    $strSQL = "DELETE FROM Submission WHERE SubmissionID = '$submissionID'";
  
    //Execute the query 
    if(mysqli_query($link, $strSQL)){
      header("Location: submission.php?id=".$activityID."");
    }
  }

  
?>