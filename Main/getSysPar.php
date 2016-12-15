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
  //$_SESSION['logged_in'] = true; //set you've logged in
  //$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
  //$_SESSION['expire_time'] = 3*60*60; //expire time in seconds: three hours (you must change this)

  if($_SESSION['UsrID'] == "LogOut" || $_SESSION['UsrID'] == "")
  {
    $_SESSION['UsrID'] = "LogOut";
    $_SESSION['UsrGrp'] = "###";
    $_SESSION['rjtMsg'] = "Please Log In";
    echo "<script language='javascript'>window.open('../Main/Login.php', '_top');</script>";
  }


  // $session_life = time() - $_SESSION['timeout'];
  // echo $session_life . "<br>";
  // echo time();
  // echo $_SESSION['timeout'];

  // if($session_life > $inactive)
  // {echo "run here ?";
  //    $_SESSION['UsrID'] = "LogOut";
  // $_SESSION['UsrGrp'] = "###";
  // $_SESSION['rjtMsg'] = "Please Log In";
  // echo "<script language='javascript'>window.open('../Main/Login.php', '_top');</script>";
  // }
  // //
  // $_SESSION['timeout'] = time();

  //_____________________________________________________________
  // Retrieving Server Detail
  //_____________________________________________________________
  $servername = "localhost";
  $SerAdd = $_SERVER['SERVER_ADDR'];
  $SerPort = $_SERVER['SERVER_PORT'];
  $Host= gethostname();
  $Host_IP = gethostbyname($Host);
  $_SESSION['Host_IP'] = $Host_IP;
  // echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
  // $browser = get_browser();

  //  print_r($_SESSION);
  // echo "</br>";

  //echo "<br> Host Name :" . $Host;
  // echo "<br> Host IP :" . $Host_IP . "<br>";
  //echo "<br> Host Address :" . $SerAdd;
  //echo "<br> Host Port :" . $SerPort . "<br>";
  // $myfile = fopen("../TimeLog/LogFile/AGL_001.txt", "r") or die("Unable to open file!");
  //_____________________________________________________________
  $servername = "localhost";
  $username = "root";
  $password = "root";
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
