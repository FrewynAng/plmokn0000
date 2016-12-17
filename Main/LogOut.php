<!--
****************
** LogOut.php **
****************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Log Out</title>
</head>

<body class="footer">

  <?php
  include '../Main/getSysPar.php';

  if ((isset($_GET["LogOut"])) AND ($_GET["LogOut"] == "LogOut"))
  {
    echo $_GET["LogOut"];
    $_GET["LogOut"] = "";
    $_SESSION['UsrID'] = "LogOut";
    $_SESSION['UsrGrp'] = "000";
    session_destroy();
    // header('Location:../Main/Login.php');
    echo "<script>window.open('../Main/Login.php', '_parent')</script>";
  }

  $conn->close();
  ?>


    <a href="../Main/LogOut.php?LogOut=LogOut" class="" ><div class="logOut">Log  Out</div></a>


</body>
</html>
