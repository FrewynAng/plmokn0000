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
  <title>Process TimeSheet</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';

  //-------------------------------------------------------
  $sql1 =
  "SELECT *
  FROM `TagLog`
  ORDER BY TagID, TagDate, TagTime, TagMchNo";
  //execute the SQL query and return records
  $result = $conn->query($sql1);
  //-------------------------------------------------------

  $Inz = "Y";
  $count = 0;
  $curID = "";
  $curTag = "";
  $TimeIn_ = "";
  $LchOut_ = "";
  $LchIn_ = "";
  $TimeOut_ = "";

  //-------------------------------------------------------
  $TagID = "";
  $StaffID = "";
  $WrkDate = "";
  $DB_OT_IN = "";
  $DB_OT_OUT = "";
  $DB_OT_Dur = "";
  $TimeIn = "";
  $TimeOut = "";
  $WrkHour = "";
  $OT_IN = "";
  $OT_OUT = "";
  $OT_Dur = "";
  $LunchStr = "";
  $LunchEnd = "";
  $LunchDur = "";
  $BreakStr = "";
  $BreakEnd = "";
  $BreakDur = "";

  while ($row = $result->fetch_assoc())
  {
    $curTag = date("Y-m-d", strtotime($row["TagDate"])) . " " . date("H:i:s", strtotime($row["TagTime"]));
    $curTag = strtotime($curTag);

    if ($Inz == "Y")
    {
      //  "is this work?<br>";
      // echo "Day End > " . date("Y-m-d H:i:s", $dayEnd) . "<br>";
      // echo "Current ID > " . $curID . " " . $row["TagID"] . "<br>";
      GOTO Inz;
    }

    if (($curTag > $dayEnd) || ($curID <> $row["TagID"]))
    {
      $TagID = $curID;
      $WrkDate = $curDate;
      $count = wrtTSht($conn, $count, $OTStr_, $TagID, $WrkDate, $TimeIn_, $LchOut_, $LchIn_, $TimeOut_);
      $TimeIn_ = "";
      $LchOut_ = "";
      $LchIn_ = "";
      $TimeOut_ = "";

      Inz:
      $Inz = "N";
      $curID = $row["TagID"];
      $curDate = date("Y-m-d", $curTag);
      $shf_Detl = getShfDt($conn, $curID, $curTag);
      $dayStr = $shf_Detl['dayStr'];
      $dayStr = strtotime($dayStr);
      $dayEnd = $shf_Detl['dayEnd'];
      $dayEnd = strtotime($dayEnd);
      $TimeIn_End = $shf_Detl['TimeIn_End'];
      $TimeIn_End = strtotime($TimeIn_End);
      $LchOut_Str = $shf_Detl['LchOut_Str'];
      $LchOut_Str = strtotime($LchOut_Str);
      $LchIn_Str = $shf_Detl['LchIn_Str'];
      $LchIn_Str = strtotime($LchIn_Str);
      $LchIn_End = $shf_Detl['LchIn_End'];
      $LchIn_End = strtotime($LchIn_End);
      $TimeOut = $shf_Detl['TimeOut'];
      $TimeOut = strtotime($TimeOut);

    }
    // echo "current Tag > " . date("Y-m-d H:i:s", $curTag) . "<br>";
    //----------------------------------------------------------------------------
    if(($curTag >= $dayStr) AND ($curTag <= $dayEnd))
    {
      //------ TIME IN ------
      if(($TimeIn_ == "") AND ($curTag <= $LchOut_Str))
      {
        $TimeIn_ = date("Y-m-d H:i:s", $curTag);
        // echo "Time In " . $TimeIn_ . "<br>";
        GOTO readnxt;
      }

      //------ LUNCH OUT ------
      if(($curTag >= $LchOut_Str) AND ($curTag <= $LchIn_Str))
      {
        $LchOut_ = date("Y-m-d H:i:s", $curTag);
        // echo "Lunch Out " . $LchOut_ . "<br>";
        GOTO readnxt;
      }

      //------ LUNCH IN ------
      if(($LchIn_ == "") AND ($curTag > strtotime($LchOut_))
      AND ($curTag > $LchIn_Str))
      {
        $LchIn_ = date("Y-m-d H:i:s", $curTag);
        // echo "Lunch In " . $LchIn_ . "<br>";
        // GOTO readnxt;
      }

      //------ TIME OUT ------
      if(($curTag >= strtotime($LchIn_)))
      {
        $TimeOut_ = date("Y-m-d H:i:s", $curTag);
        // echo "Time Out " . $TimeOut_ . "<br>";
        GOTO readnxt;
      }


      //------ OT Start ------


      //------ OT End ------

    }

    readnxt:
  }

  $TagID = $curID;
  $WrkDate = $curDate;
  $count = wrtTSht($conn, $count, $OTStr_, $TagID, $WrkDate, $TimeIn_, $LchOut_, $LchIn_, $TimeOut_);
  //-------------------------------------------------------

  function wrtTSht($conn, $count, $OTStr_, $TagID, $WrkDate, $TimeIn_, $LchOut_, $LchIn_, $TimeOut_)
  {
    $StaffID = "";
    $DB_OT_IN = "";
    $DB_OT_OUT = "";
    $DB_OT_Dur = "";
    $TimeIn = date("H:i:s", strtotime($TimeIn_));
    $TimeOut = date("H:i:s", strtotime($TimeOut_));
    $OT_IN = "";
    $OT_OUT = "";
    $OT_Dur = "";
    $BreakStr = "";
    $BreakEnd = "";
    $BreakDur = "";
    //-------------------------------------------------------
    # Lunch Duration
    if ($LchOut_ <> "")
    {
      $LunchStr = date("H:i:s", strtotime($LchOut_));
      // echo $LchOut_;
    }

    if ($LchIn_ <> "")
    {
      $LunchEnd = date("H:i:s", strtotime($LchIn_));
    }

    if (($TimeOut == $LunchStr) OR ($TimeOut == $LunchEnd))
    {
      $LunchStr = "";
      $LunchEnd = "";
    }

    if (($LunchStr <> "") AND ($LunchEnd <> ""))
    {
      $LchOut_ = date_create($LchOut_);
      $LchIn_ = date_create($LchIn_);
      $dur = date_diff($LchOut_, $LchIn_);
      $LunchDur = $dur->format("%H:%I:%S");
    }
    else
    {
      $LunchDur = "00:00:00";
    }
    //-------------------------------------------------------
    # Working Hour Duration
    $TimeIn_ = date_create($TimeIn_);
    $TimeOut_ = date_create($TimeOut_);
    $dur = date_diff($TimeIn_, $TimeOut_);
    $WrkHour = $dur->format("%H:%I:%S");
    // echo "Workind Duration > " . $WrkHour . "<br>";

    if ($LunchDur <> "")
    {
      $tmptm1 = date("Y-m-d", strtotime($WrkDate)) . date("H:i:s", strtotime($LunchDur));
      $tmptm1 = date_create($tmptm1);
      $tmptm2 = date("Y-m-d", strtotime($WrkDate)) . date("H:i:s", strtotime($WrkHour));
      $tmptm2 = date_create($tmptm2);

      $dur = date_diff($tmptm1, $tmptm2);
      $WrkHour = $dur->format("%H:%I:%S");

      //-------------------------------------------------------
      # Over Time Duration
      $OTStr_ = "";


    }
    //-------------------------------------------------------

    $sql2 =
    "INSERT
    INTO `TimeSheet`
    (`TagID`, `StaffID`, `WrkDate`, `DB_OT_IN`, `DB_OT_OUT`, `DB_OT_Dur`, `TimeIn`, `TimeOut`,
      `WrkHour`, `OT_IN`, `OT_OUT`, `OT_Dur`, `LunchStr`, `LunchEnd`, `LunchDur`, `BreakStr`,
      `BreakEnd`, `BreakDur`)
      VALUES ('$TagID', '$StaffID', '$WrkDate', '$DB_OT_IN', '$DB_OT_OUT', '$DB_OT_Dur', '$TimeIn', '$TimeOut',
        '$WrkHour', '$OT_IN', '$OT_OUT', '$OT_Dur', '$LunchStr', '$LunchEnd', '$LunchDur', '$BreakStr',
        '$BreakEnd', '$BreakDur');";
        // echo $sql2;
        //execute the SQL query and return records
        if ($conn->query($sql2) === TRUE)
        {
          $count = $count + 1;
          echo "Recorded Added - " . $count . "<br>";
        }
        else
        {
          echo "error!<br>" . $conn->error . "<br>";
        }

        $LunchDur = "";
        $WrkHour = "";

        return $count;
      }

      //-------------------------------------------------------

      function getShfDt($conn, $curID, $curTag)
      {
        $sql3 =
        "SELECT *
        FROM `shiftPar`
        WHERE SH_No =
        (SELECT ShfNo FROM StfShfGrp WHERE TagId = $curID)";
        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();

        $shfDur = $row3["SH_WrkHour"];
        $shMaxLen = $row3["SH_MaxLen"];
        $shfGrc = $row3["SH_Grc"];
        $lchDur = $row3["SH_LchDur"];
        $lchGrc = $row3["SH_LchGrc"];
        $curDay = date("l", $curTag);
        // echo "Current Tag > " . date("Y-m-d H:i:s l", $curTag) . "<br>";
        // echo $curDay . "<br>";

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
        //-------------------------------------------------------
        # Start of Day
        $dayStr = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfStr)) ;
        $dayStr = strtotime($dayStr);
        $dayStr = date("Y-m-d H:i:s", strtotime("-2 hours", $dayStr));
        // $dayStr = strtotime($dayStr);
        // echo "Day Start > " . $dayStr . "<br>";

        # End of Day
        $dayEnd = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfStr)) ;
        $dayEnd = strtotime($dayEnd);
        $dayEnd = date("Y-m-d H:i:s", strtotime("+18 hours", $dayEnd));
        // echo "Day End > " . $dayEnd . "<br><br>";

        #Time In End
        $min_ = "";
        $hh = date("H", strtotime($shfGrc));
        $mm = date("i", strtotime($shfGrc));
        $min_  = $min_ + ($hh * 60) + $mm;
        $min_  = "+" . $min_ . "minutes";

        $TimeIn_End = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfStr));
        $TimeIn_End = strtotime($TimeIn_End);

        if ($TimeIn_End < strtotime($dayStr))
        {
          $TimeIn_End = date("Y-m-d H:i:s", strtotime("+1 days", $TimeIn_End));
          $TimeIn_End = strtotime($TimeIn_End);
        }

        $TimeIn_End = date("Y-m-d H:i:s", strtotime($min_, $TimeIn_End));
        // echo "Time In End > " . $TimeIn_End . "<br>";

        # Lunch Out Start
        $LchOut_Str = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchStr));
        $LchOut_Str = strtotime($LchOut_Str);

        if ($LchOut_Str < strtotime($dayStr))
        {
          $LchOut_Str = date("Y-m-d H:i:s", strtotime("+1 days", $LchOut_Str));
          $LchOut_Str = strtotime($LchOut_Str);
        }

        $min_ = "";
        $hh = date("H", strtotime($lchGrc));
        $mm = date("i", strtotime($lchGrc));
        $min_  = $min_ + ($hh * 60) + $mm;
        $min_  = "-" . $min_ . "minutes";;

        $LchOut_Str = date("Y-m-d H:i:s", strtotime($min_, $LchOut_Str));
        // echo "Lunch Out Start > " . $LchOut_Str . "<br>";

        # Lunch Out End




        # Lunch In Start
        $tmptm1 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchStr));
        $tmptm1 = date_create($tmptm1);
        $tmptm2 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchEnd));
        $tmptm2 = date_create($tmptm2);

        $dur = date_diff($tmptm1, $tmptm2);
        $dur_ = $dur->format("%H:%I:%S");
        $hh = date("H", strtotime($dur_));
        $mm = date("i", strtotime($dur_));
        $min_ = "";
        $min_  = ceil(($min_ + ($hh * 60) + $mm) / 2);
        $min_  = "-" . $min_ . "minutes";

        $LchIn_Str = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchEnd));
        $LchIn_Str = strtotime($LchIn_Str);
        $LchIn_Str = date("Y-m-d H:i:s", strtotime($min_, $LchIn_Str));

        if (strtotime($LchIn_Str) < strtotime($dayStr))
        {
          $LchIn_Str = strtotime($LchIn_Str);
          $LchIn_Str = date("Y-m-d H:i:s", strtotime("+1 days", $LchIn_Str));
          // echo "Lunch In Start > " . $LchIn_Str . "<br>";
        }


        # Lunch In End
        $LchIn_End = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchEnd));
        $LchIn_End = strtotime($LchIn_End);

        if ($LchIn_End < strtotime($dayStr))
        {
          $LchIn_End = date("Y-m-d H:i:s", strtotime("+1 days", $LchIn_End));
          $LchIn_End = strtotime($LchIn_End);
        }

        $min_ = "";
        $hh = date("H", strtotime($lchGrc));
        $mm = date("i", strtotime($lchGrc));
        $min_  = $min_ + ($hh * 60) + $mm;
        $min_  = "+" . $min_ . "minutes";

        $LchIn_End = date("Y-m-d H:i:s", strtotime($min_, $LchIn_End));
        // echo "Lunch In End > " . $LchIn_End . "<br>";

        # Time Out
        $TimeOut = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfEnd));
        $TimeOut = strtotime($TimeOut);

        if ($TimeOut < strtotime($dayStr))
        {
          $TimeOut = date("Y-m-d H:i:s", strtotime("+1 days", $TimeOut));
          $TimeOut = strtotime($TimeOut);
        }

        # Over Time Start
        $OTStr_ = strtotime($TimeOut);
        $OTStr_ = date("Y-m-d H:i:s", strtotime("+30 minutes", $OTStr_));

        //-------------------------------------------------------
        return
        array('dayStr' => $dayStr,
        'dayEnd' => $dayEnd,
        'TimeIn_End' => $TimeIn_End,
        'LchOut_Str' => $LchOut_Str,
        'LchIn_Str' => $LchIn_Str,
        'LchIn_End' => $LchIn_End,
        'TimeOut' => $TimeOut);
      }

      $conn->close();
      ?>

    </body>
    </html>
