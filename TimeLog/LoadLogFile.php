<!--
*********************
** LoadLogFile.php **
*********************
-->

<?php session_start(); ?>

<html>
<body>
  <?php
  include '../Main/getSysPar.php';

  $file_loc = "../TimeLog/LogFile/" . $_SESSION['LogFile'];
  $myfile = fopen($file_loc, "r")
  or die("Unable to open file!");

  $LoadCnt = 0;
  $LoadDate = date("Y-m-d", time());
  $LoadTime = date("H:i:s A", time());
  $TimeLd_ = $LoadDate . " - " . $LoadTime;

  while(!feof($myfile))
  {
    $Log = fgets($myfile);
    $logLen = strlen($Log);
    $TagLogNo = trim(substr($Log, 1, 5));
    $TagMchNo = trim(substr($Log, 6, 1));
    $TagID = trim(substr($Log, 9, 8));
    $TagName = trim(substr($Log, 17, -27));
    $TagMod = trim(substr($Log, -27, -24));
    $TagIOMd = trim(substr($Log, -24, -23));
    $TagDate = trim(substr($Log, -22, -10));
    $TagTime = trim(substr($Log, -10));
    // echo $TagDate . "<br>";

    if ($TagLogNo < 1)
    {
      goto readNxt;
    }

    $LoadCnt = $LoadCnt + 1;
    //echo $TagDate . "<br>";
    //echo $LoadCnt . $TagID .  $TagDate . $TagTime . "<br>";

    $sql1 =
    "INSERT INTO `PlainLog`
    (log, TimeLd_)
    VALUES
    ('$Log', '$TimeLd_')";

    $sql2 =
    "INSERT INTO `taglog`
    (TagLogNo, TagMchNo, TagID, TagName, TagMod, TagIOMd, TagDate, TagTime, LoadDate, LoadTime, LoadCnt)
    VALUES
    ('$TagLogNo', '$TagMchNo', '$TagID', '$TagName', '$TagMod', '$TagIOMd', '$TagDate', '$TagTime', '$LoadDate', '$LoadTime', '$LoadCnt')";

    if (($conn->query($sql1) === TRUE) AND ($conn->query($sql2) === TRUE))
    {
      $_SESSION['cmpMsg'] = "Total count loaded : " . $LoadCnt;
      header("Location:../TimeSheet/TimeSheet.php");
    }
    else
    {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    readNxt:
  }

  fclose($myfile);
  $conn->close();
  include '../TimeLog/prcTimeSht.php';

  ?>

</body>
</html>
