<!--
********************
** Staff_Dlt.php **
********************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/form.css">
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body>

  <?php
  include '../Main/navBar.php';
  $StaffID = $_GET["StaffID"];
  //echo $HDate;

  $sql =
  "DELETE FROM `StaffMaster`
  WHERE
  `StaffID` = '$StaffID'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    $url = "Location:../Staff/StaffMast.php?menu={$menu}";
    header($url);
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
