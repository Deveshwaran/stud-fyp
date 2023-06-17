<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=studfyp', 'root', '');

$data = array();

$query = "SELECT * FROM fypactivity ORDER BY CoordinatorID";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["ActivityID"],
  'title'   => $row["Title"],
  'start'   => $row["StartDateTime"],
  'end'   => $row["EndDateTime"]
 );
}

echo json_encode($data);

?>