<!--
****************
** LogOut.php **
****************
-->

<?php session_start(); ?>

<html>

<head>
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body class="footer">

  <?php
  include '../Main/getSysPar.php';

  if ((isset($_GET["LogOut"])) AND ($_GET["LogOut"] == "LogOut"))
  {
    $_GET["LogOut"];
    $_GET["LogOut"] = "";
    $_SESSION['UsrID'] = "LogOut";
    $_SESSION['UsrGrp'] = "000";
    session_destroy();
    header('Location:../Main/LogIn.php');
  }

  $conn->close();
  ?>

</body>
</html>
