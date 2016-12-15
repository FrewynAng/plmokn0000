<!--
***********************
** StfShfGrp_Dlt.php **
***********************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Delete Staff Shift Group</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';

  $ShfNo = $_GET["ShfNo"];
  $StaffID = $_GET["StaffID"];

  $sql =
  "DELETE FROM `StfShfGrp`
  WHERE `ShfNo` = '$ShfNo' AND `StaffID` = '$StaffID'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    header('Location:../TimeSheet/StfShfGrp.php');
  }
  else
  {
    $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
  }

  $conn->close();
  ?>

</body>
</html>
