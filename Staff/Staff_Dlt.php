<!--
********************
** Staff_Dlt.php **
********************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Delete Holiday</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';

  $StaffID = $_GET["StaffID"];
  //echo $HDate;

  $sql =
  "DELETE FROM `StaffMaster`
  WHERE
  `StaffID` = '$StaffID'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    header('Location:../Staff/StaffMast.php');
  }
  else
  {
    $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
  }

  $conn->close();
  exit();

  ?>

</body>
</html>
