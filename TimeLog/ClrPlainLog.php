<?php
session_start();
 ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Log File</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';

  $sql1 = "DELETE FROM `PlainLog`";
  $sql2 = "DELETE FROM `taglog`";
  $sql3 = "DELETE FROM `TimeSheet`";

  if (($conn->query($sql1) === TRUE) AND ($conn->query($sql2) === TRUE) AND ($conn->query($sql3) === TRUE))
  {
    echo "Log File Clear successfully</br>";
    header("Location:../TimeLog/TimeLog.php");
  }
  else
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  exit();

  ?>

</body>
</html>
