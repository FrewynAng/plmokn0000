<!--
********************
** prcTimeSht.php **
********************
-->

<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Log File</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';

  $sql1 =
  "SELECT *
  FROM `TagLog`
  ORDER BY TagID, TagDate, TagTime, TagMchNo";
  //execute the SQL query and return records
  $result = $conn->query($sql1);
  //Current Log Detail
  $curID = "";
  $curDate = "";
  $curDay = "";
  $curTag = "";
  $prvTag = "";
  $CurTimeIn = "";
  $CurTimeOut = "";
  $In_Out = "";
  $dur = "";
  $Inz = "Y";

  $shMin = "";
  $shMax = "";
  $shfStr = "";
  $timeInStr = "";
  $timeInEnd = "";
  $shfEnd = "";
  $timeOutStr = "";
  $timeOutEnd = "";
  $shfDur = "";
  $shfGrc = "";

  $lchStr = "";
  $lchOutStr = "";
  $lchOutEnd = "";
  $lchEnd = "";
  $lchInStr = "";
  $lchInEnd = "";
  $lchDur = "";
  $lchGrc = "";

  $tmpDayStr = "";
  $tmpDayEnd = "";
  $tmpShfStr = "";
  $tmpShfEnd = "";
  $tmpLchStr = "";
  $tmpLchEnd = "";
  $hh = "";
  $mm = "";
  $min_ = "";

  $tmpStrDt = "";
  $tmpEndDt = "";

  $TagID = "";
  $WrkDate = "";
  $TimeIn = "";
  $TimeOut = "";
  $WrkHour = "";
  $OverTime = "";
  $LunchStr = "";
  $LunchEnd = "";
  $LunchDur = "";
  $BreakStr = "";
  $BreakEnd = "";
  $BreakDur = "";

  $TimeIn_ = "";
  $TimeOut_ = "";
  $LunchStr_ = "";
  $LunchEnd_ = "";

  $sql3 = "";
  $row3 = "";
  $result3 = "";

  while ($row = $result->fetch_assoc())
  {
    if ($curID == "")
    {
      $curID = $row["TagID"];
      $curDate = $row["TagDate"];
    }

    $curTag = date("Y-m-d", strtotime($row["TagDate"])) . " " . date("H:i:s", strtotime($row["TagTime"]));
    $curTag = strtotime($curTag);
    echo "Current Tag >" . date("Y-m-d H:i:s", $curTag) . "<br>";

    if ($Inz == "Y")
    {
      GOTO Initialize;
    }

    // Get Shift Parameter
    if (($curTag > $tmpDayEnd) || ($curID <> $row["TagID"]))
    {
      $TagID = $curID;
      $WrkDate = $curDate;
      // echo $WrkDate;

      if ($TimeOut == "")
      {
        $TimeOut_ = $LunchStr_;
        $TimeOut = $LunchStr;
      }

      if ($LunchEnd == "")
      {
        $LunchEnd_ = $LunchStr_;
        $LunchEnd = $LunchStr;
      }

      $LunchStr_ = date_create($LunchStr_);
      $LunchEnd_ = date_create($LunchEnd_);
      $dur = date_diff($LunchStr_, $LunchEnd_);
      $LunchDur = $dur->format("%H:%I:%S");

      $TimeIn_ = date_create($TimeIn_);
      $TimeOut_ = date_create($TimeOut_);
      $dur = date_diff($TimeIn_, $TimeOut_);
      $WrkHour = $dur->format("%H:%I:%S");
      // echo $WrkHour . " length of day<br>";

      $min_ = "";
      $hh = date("H", strtotime($LunchDur));
      $mm = date("i", strtotime($LunchDur));
      $min_ = $min_ + ($hh * 60) + $mm;
      $min_ = "-" . $min_ . "minute";
      // echo $min_ . " minutes<br>";

      $WrkHour = date("Y-m-d", strtotime($curDate)) . " " .date("H:i:s", strtotime($WrkHour));
      $WrkHour = strtotime($WrkHour);
      $WrkHour = date("H:i:s", strtotime($min_, $WrkHour));

      $min_ = "";
      $hh = date("H", strtotime($shfDur));
      $mm = date("i", strtotime($shfDur));
      $min_ = $min_ + ($hh * 60) + $mm;
      $min_ = "-" . $min_ . "minute";

      $OverTime = date("Y-m-d", strtotime($curDate)) . " " .date("H:i:s", strtotime($WrkHour));
      $OverTime = strtotime($OverTime);
      $OverTime = date("H:i:s", strtotime($min_, $OverTime));

      $sql2 =
      "INSERT INTO `TimeSheet`
      (`TagID`, `WrkDate`, `TimeIn`, `TimeOut`, `WrkHour`, `OverTime`, `LunchStr`, `LunchEnd`, `LunchDur`, `BreakStr`, `BreakEnd`, `BreakDur`)
      VALUES ('$TagID', '$WrkDate', '$TimeIn', '$TimeOut', '$WrkHour', '$OverTime', '$LunchStr', '$LunchEnd', '$LunchDur', '$BreakStr', '$BreakEnd', '$BreakDur')";
      //execute the SQL query and return records
      echo $sql2 . "<br>";
      if ($conn->query($sql2) === TRUE)
      {
        echo "Recorded Added.<br>";
      }
      else
      {
        echo "error!<br>" . $conn->error . "<br>";
      }

      $curID = $row["TagID"];
      $curDate = $row["TagDate"];
      $TimeIn = "";
      $TimeOut = "";
      $LunchStr = "";
      $LunchEnd = "";
      $WrkHour = "";
      $LunchDur = "";
      $OverTime = "";
      $In_Out = "";

      Initialize:
      $Inz = "N";
      $sql3 =
      "SELECT *
      FROM shiftPar
      WHERE SH_No =
      (SELECT ShfNo FROM StfShfGrp WHERE TagId = $curID)";
      $result3 = $conn->query($sql3);
      $row3 = $result3->fetch_assoc();
      // echo $row3["SH_WrkDay"] . "<br>";

      $shfDur = $row3["SH_WrkHour"];
      $shMaxLen = $row3["SH_MaxLen"];
      $shfGrc = $row3["SH_Grc"];
      $lchDur = $row3["SH_LchDur"];
      $lchGrc = $row3["SH_LchGrc"];
      $curDay = date("l", strtotime($row["TagDate"]));
      // echo $curDay;

      switch ($curDay)
      {
        case "Sunday":
        $shfStr = $row3["SH_SunStr"];
        $shfEnd = $row3["SH_SunEnd"];
        $lchStr = $row3["SunLchStr"];
        $lchEnd = $row3["SunLchEnd"];
        break;

        case "Monday":
        $shfStr = $row3["SH_MonStr"];
        $shfEnd = $row3["SH_MonEnd"];
        $lchStr = $row3["MonLchStr"];
        $lchEnd = $row3["MonLchEnd"];
        break;

        case "Tuesday":
        $shfStr = $row3["SH_TueStr"];
        $shfEnd = $row3["SH_TueEnd"];
        $lchStr = $row3["TueLchStr"];
        $lchEnd = $row3["TueLchEnd"];
        break;

        case "Wednesday":
        $shfStr = $row3["SH_WedStr"];
        $shfEnd = $row3["SH_WedEnd"];
        $lchStr = $row3["WedLchStr"];
        $lchEnd = $row3["WedLchEnd"];
        break;

        case "Thursday":
        $shfStr = $row3["SH_ThuStr"];
        $shfEnd = $row3["SH_ThuEnd"];
        $lchStr = $row3["ThuLchStr"];
        $lchEnd = $row3["ThuLchEnd"];
        break;

        case "Friday":
        $shfStr = $row3["SH_FriStr"];
        $shfEnd = $row3["SH_FriEnd"];
        $lchStr = $row3["FriLchStr"];
        $lchEnd = $row3["FriLchEnd"];
        break;

        case "Saturday":
        $shfStr = $row3["SH_SatStr"];
        $shfEnd = $row3["SH_SatEnd"];
        $lchStr = $row3["SatLchStr"];
        $lchEnd = $row3["SatLchEnd"];
        break;
      }

      $min_ = "";
      $hh = date("H", strtotime($shfDur));
      $mm = date("i", strtotime($shfDur));
      $min_ = $min_ + ($hh * 60) + $mm;

      $hh = date("H", strtotime($lchDur));
      $mm = date("i", strtotime($lchDur));
      $min_ = $min_ + ($hh * 60) + $mm;

      $min_ = "+" . $min_ . "minute";
      // echo $min_ . "<br>";

      //Get Working Duration of the day
      //----------------------------------------------------------------------------
      $tmpShfStr = date("Y-m-d", strtotime($curDate)) . " " . date("H:i:s", strtotime($shfStr));
      $tmpShfStr = strtotime($tmpShfStr);
      $tmpShfEnd = date("Y-m-d H:i:s", strtotime($min_, $tmpShfStr));
      $tmpShfEnd = strtotime($tmpShfEnd);
      // echo "Start time is >" . date("Y-m-d H:i:s", $tmpShfStr) . "<br>";
      // echo "End time is   >" . date("Y-m-d H:i:s", $tmpShfEnd) . "<br>";

      $min_ = "";
      $min_ = $min_ + 60;
      $min_ = "+" . $min_ . "minute";

      $timeInStr = date("Y-m-d", strtotime($curDate)) . " " . date("H:i:s", strtotime($shfStr));
      $timeInStr = strtotime($timeInStr);
      $timeInEnd = date("Y-m-d H:i:s", strtotime($min_, $tmpShfStr));
      $timeInEnd = strtotime($timeInEnd);
      // echo "Time In STR>" . date("Y-m-d H:i:s", $timeInStr) . "<br>";
      // echo "Time In END>" . date("Y-m-d H:i:s", $timeInEnd) . "<br>";

      //Get Working Length of the day
      //----------------------------------------------------------------------------
      $min_ = "";
      $hh = date("H", strtotime($shMaxLen));
      $mm = date("i", strtotime($shMaxLen));
      $min_  = $min_ + (ceil($hh * 1 / 10) * 60) + $mm;
      $min_  = "-" . $min_ . "minute";

      $tmpDayStr = date("Y-m-d H:i:s", strtotime("-2 hours", $tmpShfStr));
      $tmpDayStr = strtotime($tmpDayStr);

      $min_ = "";
      $hh = date("H", strtotime($shMaxLen));
      $mm = date("i", strtotime($shMaxLen));
      $min_  = $min_ + (($hh * 60) - (ceil($hh * 1 / 10) * 60)) + $mm;
      $min_  = "+" . $min_ . "minute";

      $tmpDayEnd = date("Y-m-d H:i:s", strtotime("+20 hours", $tmpShfStr));
      $tmpDayEnd = strtotime($tmpDayEnd);
      // echo (($hh * 60) - (ceil($hh * 1 / 10) * 60)) . "<br>";
      // echo (ceil($hh * 1 / 10) * 60) . "<br>";
      echo "Day Start Time is >" . date("Y-m-d H:i:s", $tmpDayStr) . "<br>";
      echo "Day End time is   >" . date("Y-m-d H:i:s", $tmpDayEnd) . "<br>";

      //Lunch Out
      //----------------------------------------------------------------------------
      $min_ = "";
      $mm = date("H", strtotime($lchDur));
      $min_ = $min_ + ($hh * 60) + 60;
      $min_ = "+" . $min_ . "minute";

      $lchOutStr = date("Y-m-d", strtotime($curDate)) . " " . date("H:i:s", strtotime($lchStr));
      $lchOutStr = strtotime($lchOutStr);

      if ($lchOutStr < $tmpShfStr)
      {
        $lchOutStr = date("Y-m-d H:i:s", strtotime("+1 day", $lchOutStr));
        $lchOutStr = strtotime($lchOutStr);
        $lchOutStr = date("Y-m-d H:i:s", strtotime("-30 minute", $lchOutStr));
        $lchOutStr = strtotime($lchOutStr);
      }

      $lchOutEnd = date("Y-m-d H:i:s", strtotime($min_, $lchOutStr));
      $lchOutEnd = strtotime($lchOutEnd);
      // echo "Lunch Out STR>" . date("Y-m-d H:i:s", $lchOutStr) . "<br>";
      // echo "Lunch Out END>" . date("Y-m-d H:i:s", $lchOutEnd) . "<br>";

      $min_ = "";
      $hh = date("H", strtotime($lchDur));
      $mm = date("i", strtotime($lchDur));
      $min_ = $min_ + ($hh * 60) + $mm;
      $min_ = "+" . $min_ . "minute";
      $lchInEnd = date("Y-m-d H:i:s", strtotime($min_, $lchOutEnd));
      $lchInEnd = strtotime($lchInEnd);

      // echo "Lunch IN END>" . date("Y-m-d H:i:s", $lchInEnd) . "<br>";
    }

    switch ($In_Out)
    {
      case "IN":
      $In_Out = "OUT";
      break;

      case "OUT":
      $In_Out = "IN";
      break;

      default:
      $In_Out = "IN";
      break;
    }

    //----------------------------------------------------------------------------
    if(($curTag >= $tmpDayStr) AND ($curTag <= $tmpDayEnd))
    {
      //------ TIME IN ------
      if(($TimeIn == ""))
      {
        $TimeIn_  = date("Y-m-d H:i:s", $curTag);
        $TimeIn = date("H:i:s", $curTag);
        GOTO readnxt;
        // echo "TimeIn " . $TimeIn_ . "<br>";
      }

      //------ LUNCH OUT ------
      if(($LunchStr == ""))
      {
        $LunchStr_ = date("Y-m-d H:i:s", $curTag);
        $LunchStr = date("H:i:s", $curTag);
        // echo "LunchStr " . $LunchStr_ . "<br>";
        GOTO readnxt;

      }

      //------ LUNCH IN ------
      if(($LunchEnd == ""))
      {
        $LunchEnd_  = date("Y-m-d H:i:s", $curTag);
        $LunchEnd = date("H:i:s", $curTag);
        GOTO readnxt;
        // echo "LunchEnd" . $LunchEnd . "<br>";
      }

      //------ TIME OUT ------
      if($curTag <= $tmpDayEnd)
      {
        $TimeOut_  = date("Y-m-d H:i:s", $curTag);
        $TimeOut = date("H:i:s", $curTag);
        // echo "TimeOut " . $TimeOut . "<br>";

      }

    }
    $prvTag = $curTag;
    readnxt:


  }

  $TagID = $curID;
  $WrkDate = $curDate;

  $LunchStr_ = date_create($LunchStr_);
  $LunchEnd_ = date_create($LunchEnd_);
  $dur = date_diff($LunchStr_, $LunchEnd_);
  $LunchDur = $dur->format("%H:%I:%S");

  $TimeIn_ = date_create($TimeIn_);
  $TimeOut_ = date_create($TimeOut_);
  $dur = date_diff($TimeIn_, $TimeOut_);
  $WrkHour = $dur->format("%H:%I:%S");
  // echo $WrkHour . " length of day<br>";

  $min_ = "";
  $hh = date("H", strtotime($LunchDur));
  $mm = date("i", strtotime($LunchDur));
  $min_ = $min_ + ($hh * 60) + $mm;
  $min_ = "-" . $min_ . "minute";
  // echo $min_ . " minutes<br>";

  $WrkHour = date("Y-m-d", strtotime($curDate)) . " " .date("H:i:s", strtotime($WrkHour));
  $WrkHour = strtotime($WrkHour);
  $WrkHour = date("H:i:s", strtotime($min_, $WrkHour));

  $min_ = "";
  $hh = date("H", strtotime($shfDur));
  $mm = date("i", strtotime($shfDur));
  $min_ = $min_ + ($hh * 60) + $mm;
  $min_ = "-" . $min_ . "minute";

  $OverTime = date("Y-m-d", strtotime($curDate)) . " " . date("H:i:s", strtotime($WrkHour));
  $OverTime = strtotime($OverTime);
  $OverTime = date("H:i:s", strtotime($min_, $OverTime));

  $sql2 =
  "INSERT INTO `TimeSheet`
  (`TagID`, `WrkDate`, `TimeIn`, `TimeOut`, `WrkHour`, `OverTime`, `LunchStr`, `LunchEnd`, `LunchDur`, `BreakStr`, `BreakEnd`, `BreakDur`)
  VALUES ('$TagID', '$WrkDate', '$TimeIn', '$TimeOut', '$WrkHour', '$OverTime', '$LunchStr', '$LunchEnd', '$LunchDur', '$BreakStr', '$BreakEnd', '$BreakDur')";
  //execute the SQL query and return records
  //echo $sql2 . "<br>";
  if ($conn->query($sql2) === TRUE)
  {
    echo "Recorded Added.<br>";
  }
  else
  {
    echo "error!<br>" . $conn->error . "<br>";
  }

  $conn->close();


  ?>


</body>
</html>
