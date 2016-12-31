<!--
******************
** db_Reset.php **
******************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';
  // $sql_1 = "DELETE FROM `StaffMaster`";
  $sql_2 = "DELETE FROM `LeaveTable`";
  $sql_3 = "DELETE FROM `HolidayTable`";
  // $sql_4 = "DELETE FROM `ShiftPar`";
  // $sql_5 = "DELETE FROM `StfShfGrp`";
  $sql_6 = "DELETE FROM `PlainLog`";
  $sql_7 = "DELETE FROM `taglog`";
  $sql_8 = "DELETE FROM `TimeSheet`";
  $sql_9 = "DELETE FROM `UsrLogin` WHERE `UsrID` <> 'Admin'";
  $sql_10 = "DELETE FROM `UsrGrpPar` WHERE `UsrGrp` <> '888'";
  $sql_11 = "DELETE FROM `SysPar`";
  // $sql_12 = "DELETE FROM `RolePar`";
  // $sql_13 = "DELETE FROM `department`";

  if (
  // ($conn->query($sql_1) === TRUE) AND
  ($conn->query($sql_2) === TRUE) AND
  ($conn->query($sql_3) === TRUE) AND
  // ($conn->query($sql_4) === TRUE) AND
  // ($conn->query($sql_5) === TRUE) AND
  ($conn->query($sql_6) === TRUE) AND
  ($conn->query($sql_7) === TRUE) AND
  ($conn->query($sql_8) === TRUE) AND
  ($conn->query($sql_9) === TRUE) AND
  ($conn->query($sql_10) === TRUE) AND
  ($conn->query($sql_11) === TRUE))
  // ($conn->query($sql_12) === TRUE) AND
  // ($conn->query($sql_13) === TRUE))
  {
    $_SESSION['cmpMsg'] = "FILE CLEARED.";
    header("Location:../Staff/Stf_BirthD.php");
  }
  else
  {
    echo "Error: " . $sql_ . "<br>" . $conn->error;
  }

  $conn->close();
  exit();

  ?>

</body>
</html>
