<!--
*********************
** ClrPlainLog.php **
*********************
-->

<?php session_start(); ?>

<html>

<head>
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body>

  <?php
  include '../Main/navBar.php';

  $sql1 = "DELETE FROM `PlainLog`";
  $sql2 = "DELETE FROM `taglog`";
  $sql3 = "DELETE FROM `TimeSheet`";

  if (($conn->query($sql1) === TRUE) AND ($conn->query($sql2) === TRUE) AND ($conn->query($sql3) === TRUE))
  {
    echo "Log File Clear successfully</br>";
    $url = "Location:../TimeLog/TimeLog.php?menu={$menu}";
    header($url);
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
