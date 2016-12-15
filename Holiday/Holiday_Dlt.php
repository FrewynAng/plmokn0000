<!--
*********************
** Holidau_Dlt.php **
*********************
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

  $HDate = date("Y-m-d", strtotime($_GET["HDate"]));
  //echo $HDate;

  $sql =
  "DELETE FROM `HolidayTable`
  WHERE
  `HDate` = '$HDate'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    header('Location:../Holiday/HolidayTable.php');
  }
  else
  {
    $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
  }

  $conn->close();
  ?>

</body>
</html>
