<!DOCTYPE html>

<!--
*******************
** getSysPar.php **
*******************
-->

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Get System Parameter</title>
</head>

<body>

  <?php
  date_default_timezone_set('Asia/Singapore');

  if($_SESSION['UsrID'] == "LogOut" || $_SESSION['UsrID'] == "")
  {
    $_SESSION['UsrID'] = "LogOut";
    $_SESSION['UsrGrp'] = "###";
    $_SESSION['rjtMsg'] = "Please Log In";
    echo "<script language='javascript'>window.open('../Main/LogIn.php', '_top');</script>";
  }

  //_____________________________________________________________
  // Retrieving Server Detail
  //_____________________________________________________________
  $SerAdd = $_SERVER['SERVER_ADDR'];
  $SerPort = $_SERVER['SERVER_PORT'];
  $Host= gethostname();
  $Host_IP = gethostbyname($Host);
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $pieces = parse_url($actual_link);
  // print_r($pieces);
  $_SESSION['Host_IP'] = $Host_IP;

  // print_r($_SESSION);
  // echo "</br>";
  //_____________________________________________________________
  $servername = "localhost";
  $username = "root";
  $password = "ckang870118";
  $dbname = "TimeSystem";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }

  ?>

</body>
</html>
