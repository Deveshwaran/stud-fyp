<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=studfyp', 'root', '');

if(isset($_POST["Title"]))
{
 $query = "
 INSERT INTO fypactivity 
 (Title, StartDateTime, EndDateTime) 
 VALUES (:Title, :StartDateTime, :EndDateTime)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':Title'  => $_POST['Title'],
   ':StartDateTime' => $_POST['StartDateTime'],
   ':EndDateTime' => $_POST['EndDateTime']
  )
 );
}


?>