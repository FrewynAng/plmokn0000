<!--
********************
** Leave_Dlt.php **
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
  $LeaveTyp = $_GET["LeaveTyp"];
  $DateFR = date("Y-m-d", strtotime($_GET["DateFR"]));
  $DateTO = date("Y-m-d", strtotime($_GET["DateTO"]));
  $NoOfDay = $_GET["NoOfDay"];
  // echo $StaffID . "<br>";
  // echo $LeaveTyp . "<br>";
  // echo $DateFR . "<br>";
  // echo $DateTO . "<br>";
  // echo $NoOfDay . "<br>";

  $sql =
  "DELETE FROM `LeaveTable`
  WHERE
  `StaffID` = '$StaffID' AND `LeaveTyp` = '$LeaveTyp' AND `DateFR` = '$DateFR' AND `DateTO` = '$DateTO' AND `NoOfDay` = '$NoOfDay'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    header('Location:../Leave/LeaveTable.php');
  }
  else
  {
    $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
  }

  $conn->close();
  ?>

</body>
</html>
