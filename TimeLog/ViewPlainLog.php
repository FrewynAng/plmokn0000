<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Add Staff</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';

  $sql = "SELECT * FROM `PlainLog`";
  //execute the SQL query and return records
  $result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
  //output data of each row
    while($row = $result->fetch_assoc())
    {
      echo "Log : <b style='color:blue'>" . $row["Log"]  . "</b>" . " Time : " . $row["TimeLd_"] . "<br>";
    }
  }
  else
  {
      echo "0 results </br>" ;
  }
  echo
  "
  </br><a href='../TimeLog/TimeLog.php' target='cdMain'>View Log File</a></br>
  ";

  $conn->close();
  ?>

</body>
</html>
